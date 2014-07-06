<?php

namespace Vacancy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vacancy\Entity;
use Zend\Mail;

/**
 * Class VacancyController
 * @package Vacancy\Controller
 */
class VacancyController extends AbstractActionController
{
    /**
     * Page with vacancies and filters
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $lang = $request->getQuery('lang', 'en');
        $department = $request->getQuery('department', '');
        $limit = 10;
        $offset = $request->getQuery('p', 1);
        $from = (($offset * $limit)) - $limit;

        $rep = $objectManager->getRepository('\Vacancy\Entity\Localization');
        $builder = $rep->createQueryBuilder('loc')
            ->join('loc.vacancy', 'v')
            ->join('v.department', 'd')
            ->join('loc.language', 'lng');

        if ($department) {
            $builder->andWhere('d.id = ?2')
                ->setParameter(2, $department);
        }

        $builderTwo = clone $builder;
        $builder->andWhere('lng.name = \'en\'');

        $total_count = $builder->select('COUNT(loc)')->getQuery()->getSingleResult();
        $builder->setFirstResult($from)->setMaxResults($limit);
        $vacancies = $builder->select('loc')->getQuery()->getResult();
        if ($lang != 'en') {
            $vacancies = $this->checkLanguage($builderTwo, $vacancies, $lang, $from, $limit);
        }

        $totalPages = (int)ceil($total_count[1] / $limit);

        $filters = $this->getFilters($objectManager);

        $view = new ViewModel(array(
            'vacancies' => $vacancies,
            'filters' => $filters,
            'paramLang' => $lang,
            'paramDep' => $department,
            'totalPages' => $totalPages,
            'p' => $offset
        ));

        return $view;
    }

    /**
     * View vacancy
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->flashMessenger()->addErrorMessage('Vacancy id doesn\'t set');
            return $this->redirect()->toRoute('vacancy');
        }
        $request = $this->getRequest();
        $lang = $request->getQuery('lang', 'en');

        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $rep = $objectManager->getRepository('\Vacancy\Entity\Localization');
        $builder = $rep->createQueryBuilder('loc')
            ->join('loc.vacancy', 'v')
            ->join('v.department', 'd')
            ->join('loc.language', 'lng')
            ->andWhere('lng.name = ?1')
            ->andWhere('v.id = ?2')
            ->setParameter(1, $lang)
            ->setParameter(2, $id);
        $vacancy = $builder->select('loc')->getQuery()->getSingleResult();

        if (!$vacancy) {
            $this->flashMessenger()->addErrorMessage(sprintf('Vacancy with id %s doesn\'t exists', $id));
            return $this->redirect()->toRoute('vacancy');
        }

        $view = new ViewModel(array(
            'vacancy' =>  $vacancy
        ));

        return $view;
    }

    /**
     * Get filters for vacancies
     *
     * @param $objectManager
     *
     * @return array
     */
    protected function getFilters($objectManager)
    {
        $filters = array('department' => '', 'lang' => '');
        $filters['departments'] = $objectManager
            ->getRepository('\Vacancy\Entity\Department')
            ->findBy(array(), array('name' => 'ASC'));
        $filters['lang'] = $objectManager
            ->getRepository('\Vacancy\Entity\Language')
            ->findBy(array(), array('name' => 'ASC'));
        return $filters;
    }

    /**
     * Check description vacancy on other languages
     * and if not exist then description on english
     *
     * @param $builder
     * @param $defaultVacancies
     * @param $lang
     * @param $from
     * @param $limit
     *
     * @return array
     */
    private function checkLanguage($builder, $defaultVacancies, $lang, $from, $limit)
    {
        $result = array();
        $builder->andWhere('lng.name = ?1')
            ->setParameter(1, $lang);
        $builder->setFirstResult($from)->setMaxResults($limit);
        $vacancies = $builder->select('loc')->getQuery()->getResult();
        $count = count($vacancies);
        foreach ($defaultVacancies as $defaultVacancy) {
            $i = 0;
            foreach ($vacancies as $vacancy) {
                if ($vacancy->getVacancy()->getId() == $defaultVacancy->getVacancy()->getId()) {
                    $result[] = $vacancy;
                    break;
                } else {
                    $i++;
                }
            }
            if ($i == $count) {
                $result[] = $defaultVacancy;
            }
        }

        return $result;
    }

}

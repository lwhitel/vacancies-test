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
     * @return ViewModel
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
            ->join('loc.language', 'lng')
            ->where('lng.name = ?1')
            ->setParameter(1, $lang);
        if ($department) {
            $builder->andWhere('d.name = ?2')
                ->setParameter(2, $department);
        }

        $total_count = $builder->select('COUNT(loc)')->getQuery()->getSingleResult();
        $builder->setFirstResult($from)->setMaxResults($limit);
        $vacancies = $builder->select('loc')->getQuery()->getResult();

        $totalPages = (int)ceil($total_count[1] / $limit);

        $view = new ViewModel(array(
            'vacancies' => $vacancies,
        ));

        return $view;
    }

}

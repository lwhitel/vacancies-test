<?php

namespace Vacancy\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vacancy\Entity;
use Zend\Mail;

/**
 * Class MoneyController
 * @package Vacancy\Controller
 */
class VacancyController extends AbstractActionController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

}

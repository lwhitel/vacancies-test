<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Vacancy\Controller\Vacancy' => 'Vacancy\Controller\VacancyController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'vacancy' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/vacancies[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Vacancy\Controller\Vacancy',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'showMessages' => 'Vacancy\View\Helper\ShowMessages',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'money' => __DIR__ . '/../view',
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            'vacancy_driver' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Vacancy/Entity'),
                'cache' => 'array',
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Vacancy\Entity' => 'vacancy_driver',
                )
            )
        )
    ),

    'strategies' => array(
        'ZfcTwigViewStrategy',
    ),

);
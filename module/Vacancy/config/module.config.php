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
            'money_driver' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Vacancy/Entity'),
                'cache' => 'array',
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Vacancy\Entity' => 'money_driver',
                )
            )
        )
    ),

    'strategies' => array(
        'ZfcTwigViewStrategy',
    ),

    'view_manager' => array(
//        'display_not_found_reason' => true,
//        'display_exceptions'       => true,
//        'doctype'                  => 'HTML5',
//        'not_found_template'       => 'error/404',
//        'exception_template'       => 'error/index',
//        'template_map' => array(
//            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
//            'money/money/index' => __DIR__ . '/../view/money/money/index.twig',
//            'error/404'               => __DIR__ . '/../view/error/404.twig',
//            'error/index'             => __DIR__ . '/../view/error/index.twig',
//        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ZfcTwigViewStrategy',
        ),
    ),
);
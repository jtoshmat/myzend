<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Contactus\Controller\Contactus' => 'Contactus\Controller\ContactusController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'contactus' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/contactus[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Contactus\Controller\Contactus',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),


    'view_manager' => array(
        'template_path_stack' => array(
            'contactus' => __DIR__ . '/../view',
        ),
    ),
);
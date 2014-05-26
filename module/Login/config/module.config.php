<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Login\Controller\Login' => 'Login\Controller\LoginController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'login' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/login[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Login\Controller\Login',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),



    'view_manager' => array(
        'template_path_stack' => array(
            'login' => __DIR__ . '/../view' ,
        ),
        'template_map' => array(
            'login/header'           => getcwd() . '/module/Login/view/login/login/header.phtml',
            'login/footer'           => getcwd() . '/module/Login/view/login/login/footer.phtml',
        ),

    ),
);


<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Newsletter\Controller\Newsletter' => 'Newsletter\Controller\NewsletterController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'newsletter' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/newsletter[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Newsletter\Controller\Newsletter',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),



    'view_manager' => array(
        'template_path_stack' => array(
            'newsletter' => __DIR__ . '/../view' ,
        ),
        'template_map' => array(
            'newsletter/header'           => getcwd() . '/module/Newsletter/view/newsletter/newsletter/header.phtml',
            'newsletter/footer'           => getcwd() . '/module/Newsletter/view/newsletter/newsletter/footer.phtml',
        ),

    ),
);


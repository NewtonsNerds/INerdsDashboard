<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index'
                    )
                ),
            ),
            'project' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/project',
                    'defaults' => [
                        'controller' => 'Application\Controller\Project',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'task' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:projectId]/task',
                            'defaults' => [
                                'controller' => 'Application\Controller\Task',
                                'action' => 'index'
                            ]
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'action' => 'add'
                                    ]
                                ]
                            ],
                            'update' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/update/[:taskId]',
                                    'constraints' => array(
                                        'taskId' => '[0-9]+'
                                    ),
                                    'defaults' => [
                                        'action' => 'update'
                                    ]
                                ]
                            ],
                            'delete' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/delete/[:taskId]',
                                    'constraints' => array(
                                        'taskId' => '[0-9]+'
                                    ),
                                    'defaults' => [
                                        'action' => 'delete'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'update' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/update/[:projectId]',
                            'constraints' => array(
                                'projectId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'update'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete/[:projectId]',
                            'constraints' => array(
                                'projectId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            'task' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/task',
                    'defaults' => [
                        'controller' => 'Application\Controller\Task',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'update' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/update/[:taskId]',
                            'constraints' => array(
                                'taskId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'update'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete/[:taskId]',
                            'constraints' => array(
                                'taskId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            'calendar' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/calendar',
                    'defaults' => [
                        'controller' => 'Application\Controller\Calendar',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'switchUserCalendar' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/switch/[:userId]',
                            'constraints' => array(
                                'userId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'switchUserCalendar'
                            ]
                        ]
                    ],
                ]
            ],
            'calendarWorkItem' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/calendar-work-item',
                    'defaults' => [
                        'controller' => 'Application\Controller\CalendarWorkItem',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'get' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/get[/:calendarWorkItemId]',
                            'constraints' => array(
                                'calendarWorkItemId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'get'
                            ]
                        ]
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'update' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/update',
                            'defaults' => [
                                'action' => 'update'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/delete',
                            'defaults' => [
                                'action' => 'delete'
                            ]
                        ]
                    ],
                ]
            ],
            'attendance' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/attendance',
                    'defaults' => [
                        'controller' => 'Application\Controller\Attendance',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'punchIn' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/in',
                            'defaults' => [
                                'action' => 'punchIn'
                            ]
                        ]
                    ],
                    'punchOut' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/out',
                            'defaults' => [
                                'action' => 'punchOut'
                            ]
                        ]
                    ],
                ]
            ],
            'tag' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/tag',
                    'defaults' => [
                        'controller' => 'Application\Controller\Tag',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'update' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/update/[:tagId]',
                            'constraints' => array(
                                'tagId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'update'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete/[:tagId]',
                            'constraints' => array(
                                'tagId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            'calendar-work-item' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/calendar-work-item',
                    'defaults' => [
                        'controller' => 'Application\Controller\CalendarWorkItem',
                        'action' => 'index'
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add'
                            ]
                        ]
                    ],
                    'update' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/update/[:calendarWorkItemId]',
                            'constraints' => array(
                                'tagId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'update'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete/[:calendarWorkItemId]',
                            'constraints' => array(
                                'tagId' => '[0-9]+'
                            ),
                            'defaults' => [
                                'action' => 'delete'
                            ]
                        ]
                    ]
                ]
            ],
            'dashboard' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/dashboard',
                            'defaults' => array(
                                    'controller' => 'Application\Controller\Index',
                                'action' => 'dashboard'
                            )
                        )
                    ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'invokables' => [
            'Gedmo\Blameable\BlameableListener' => 'INerdsBase\DoctrineExtension\Blameable\BlameableListener',
            '\Gedmo\Uploadable\UploadableListener' => 'Gedmo\Uploadable\UploadableListener',
            '\INerdsBase\Listener\EmailScheduleEventListener' => '\INerdsBase\Listener\EmailScheduleEventListener'
        ],
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Project' => 'Application\Controller\ProjectController',
            'Application\Controller\Task' => 'Application\Controller\TaskController',
            'Application\Controller\Tag' => 'Application\Controller\TagController',
            'Application\Controller\Attendance' => 'Application\Controller\AttendanceController',
            'Application\Controller\Calendar' => 'Application\Controller\CalendarController',
            'Application\Controller\CalendarWorkItem' => 'Application\Controller\CalendarWorkItemController',
        ),
    ),
    
    'module_layouts' => [
        'ZfcUser' => [
            'default' => 'layout/login'
        ],
        'GoalioForgotPassword' => [
            'default' => 'layout/login'
        ]
    ],
    
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'layout/css' => __DIR__ . '/../view/layout/blocks/css.phtml',
            'layout/js' => __DIR__ . '/../view/layout/blocks/js.phtml',
            'MetronicInputField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicInputField.phtml',
            'MetronicSelectField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicSelectField.phtml',
            'MetronicSplitMultiSelectField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicSplitMultiSelectField.phtml',
            'MetronicCheckboxField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicCheckboxField.phtml',
            'MetronicDateField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicDateField.phtml',
            'MetronicDatetimeField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicDatetimeField.phtml',
            'MetronicMDInputField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicMDInputField.phtml',
            'MetronicButtonField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicButtonField.phtml',
            'MetronicHiddenField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicHiddenField.phtml',
            'MetronicTextareaField' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicTextareaField.phtml',
            'MetronicFileFieldWithPreview' => __DIR__ . '/../view/layout/_partials/Form/Field/MetronicFileFieldWithPreview.phtml',
            'layout/partial/breadcrumb' => __DIR__ . '/../view/layout/_partials/breadcrumb.phtml',
            'layout/partial/navigation' => __DIR__ . '/../view/layout/_partials/navigation.phtml',
            'layout/partial/flash-messenger' => __DIR__ . '/../view/layout/_partials/alert.phtml',
            'layout/login' => __DIR__ . '/../view/layout/login.phtml',
            'zfc-user/user/login' => __DIR__ . '/../view/zfc-user/user/login.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
            'zfc-user' => __DIR__ . '/../view'
        ),
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
    //////////////////////////////////////////////////////////////////////////////////////////
    'zfcuser' => [
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false
    ],
    'bjyauthorize' => [
        // Using the authentication identity provider, which basically
        // reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
    
        'role_providers' => [
            // using an object repository (entity repository] to
            // load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Application\Entity\Role'
            ]
        ]
    ],
    'doctrine' => [
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
    
                    // pick any listeners you need
                    'Gedmo\Tree\TreeListener',
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\Sluggable\SluggableListener',
                    'Gedmo\Loggable\LoggableListener',
                    'Gedmo\Sortable\SortableListener',
                    'Gedmo\SoftDeleteable\SoftDeleteableListener',
                    'Gedmo\Blameable\BlameableListener',
                    'Gedmo\Uploadable\UploadableListener'
                ]
            ]
        ],
    
        'driver' => [
            'Application_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../Application/src/Application/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Application\Entity' => 'Application_driver'
                ]
            ]
        ],
    
        'configuration' => [
            'orm_default' => [
                'filters' => [
                    'soft-deleteable' => 'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter'
                ],
                'datetime_functions' => [
                    'date' => 'Luxifer\DQL\Datetime\Date',
                    'datediff' => 'Luxifer\DQL\Datetime\DateDiff',
                    'dateformat' => 'Luxifer\DQL\Datetime\DateFormat'
                ]
            ]
        ]
    ],
);

<?php

return array(
    'bjyauthorize' => array(

        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',
        // UnauthorizedStrategy or RedirectionStrategy
        'unauthorized_strategy' => 'BjyAuthorize\View\RedirectionStrategy',
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'adminNavigation' => array('view'),
                //'file' => array('remove', 'download', 'read', 'upload'),
            ),
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('guest', 'admin'), 'adminNavigation', 'view'),
                ),

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                    //array(array('guest', 'user'), 'homepage', 'see')
                ),
            ),
        ),

        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => [
            'BjyAuthorize\Guard\Controller' => [
                array('controller' => 'Application\Controller\Index', 'roles' => array('developer', 'technician')),
                array('controller' => 'Application\Controller\Task', 'roles' => array('developer', 'technician')),
                array('controller' => 'Application\Controller\Project', 'roles' => array('developer', 'technician')),
                array('controller' => 'Application\Controller\Tag', 'roles' => array('developer', 'technician')),
                
                array('controller' => 'goalioforgotpassword_forgot', 'roles' => array()),
                array('controller' => 'zfcuser', 'roles' => array()),
                array('controller' => 'HumusPHPUnitController', 'roles' => array()),
            ],
        ],

            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            /*'BjyAuthorize\Guard\Route' => array(
                array('route' => 'zfcuser', 'roles' => array('user')),
                array('route' => 'zfcuser/logout', 'roles' => array('user')),
                array('route' => 'zfcuser/login', 'roles' => array('guest')),
                array('route' => 'zfcuser/register', 'roles' => array('guest')),
                // Below is the default index action used by the ZendSkeletonApplication
                array('route' => 'home', 'roles' => array('guest', 'user')),
            ),*/
        ),
    
);

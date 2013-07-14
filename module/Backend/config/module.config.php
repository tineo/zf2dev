<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backend;

return array (
		'router' => array (
				'routes' => array (
						// The following is a route to simplify getting started
						// creating
						// new controllers and actions without needing to create
						// a new
						// module. Simply drop new controllers in, and you can
						// access them
						// using the path /application/:controller/:action
						
						'backend' => array (
								'type' => 'Literal',
								'options' => array (
										'route' => '/backend',
										'defaults' => array (
												'__NAMESPACE__' => 'Backend\Controller',
												'controller' => 'Index',
												'action' => 'index' 
										) 
								),
								'may_terminate' => true,
								'child_routes' => array (
										
										'default' => array (
												'type' => 'Segment',
												'options' => array (
														'route' => '/[:controller[/:action[/:type/:id]]]',
														'constraints' => array (
																'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
																'action' => '[a-zA-Z][a-zA-Z0-9_-]*' 
														),
														'defaults' => array () 
												) 
										) 
								) 
						) ,
						'install' => array (
								'type' => 'Literal',
								'options' => array (
										'route' => '/install',
										'defaults' => array (
												'__NAMESPACE__' => 'Backend\Controller',
												'controller' => 'Backend\Controller\Index',
												'action' => 'install'
										)
								)
						),
				) 
		),
		/*'service_manager' => array (
				'factories' => array (
						'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory' 
				) 
		),*/
		/*'translator' => array (
				'locale' => 'es_ES',
				'translation_file_patterns' => array (
						array (
								'type' => 'gettext',
								'base_dir' => __DIR__ . '/../language',
								'pattern' => '%s.mo' 
						) 
				) 
		),*/
		'controllers' => array (
				'invokables' => array (
						'Backend\Controller\Index' => 'Backend\Controller\IndexController',
						'Backend\Controller\Section' => 'Backend\Controller\SectionController',
						
				) 
		),
		'view_manager' => array (
				/*'display_not_found_reason' => true,
				'display_exceptions' => true,
				'doctype' => 'HTML5',
				'not_found_template' => 'error/404',
				'exception_template' => 'error/index',
				*/'template_map' => array (
						'layout/backend' => __DIR__ . '/../view/layout/layout.phtml',
						'backend/index/index' => __DIR__ . '/../view/backend/index/index.phtml',
				//		'error/404' => __DIR__ . '/../view/error/404.phtml',
				//		'error/index' => __DIR__ . '/../view/error/index.phtml' 
				),
				'template_path_stack' => array (
						__DIR__ . '/../view' 
				),
				'strategies' => array (
						'ViewJsonStrategy' 
				) 
		), 
);

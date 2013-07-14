<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Backend;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\Router\Http;
use Zend\Mvc\Router\Http\Part;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\RoutePluginManager;
use Zend\Session\Container;
use Zend\I18n\Translator\Translator;

class Module {
	public function onBootstrap($e) {
		$e->getApplication ()->getEventManager ()->getSharedManager ()->attach ( 'Zend\Mvc\Controller\AbstractActionController', 'dispatch', function ($e) {
			$controller = $e->getTarget ();
			$controllerClass = get_class ( $controller );
			$moduleNamespace = substr ( $controllerClass, 0, strpos ( $controllerClass, '\\' ) );
			$config = $e->getApplication ()->getServiceManager ()->get ( 'config' );
			if (isset ( $config ['module_layouts'] [$moduleNamespace] )) {
				$controller->layout ( $config ['module_layouts'] [$moduleNamespace] );
			}
		}, 100 );
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__ 
						) 
				) 
		);
	}
}

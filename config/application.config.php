<?php

return array (
		'modules' => array (
				'Application',
				//'Backend',
				'DoctrineModule',
				'DoctrineORMModule',
				'ZfcBase',
				'ZfcUser',
				'ZfcUserDoctrineORM',
				'BjyAuthorize',
				'MakiUser',
				//'SamUser',
				'ZendDeveloperTools',
				'BjyProfiler'
		),
		'module_listener_options' => array (
				'config_glob_paths' => array (
						'config/autoload/{,*.}{global,local}.php' 
				),
				'module_paths' => array (
						'./module',
						'./vendor' 
				) 
		),
		
);

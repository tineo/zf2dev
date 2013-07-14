<?php
return array (
	'doctrine' => array (
		'connection' => array (
			'orm_default' => array (
				'driverClass' => 'Doctrine\DBAL\Driver\PDOSqlite\Driver',
				'params' => array (
				'path' => ''.getcwd().'/data/apoyo.db' 
				)
			),
			/*'orm_default'=> array (
				'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
					'params' => array(
						'host'     => 'localhost',
						'port'     => '3306',
						'user'     => 'root',
						'password' => '12077752',
						'dbname'   => 'test1'
				)
			),*/
		),
		'driver' => array (
			'Backend_driver' => array (
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array (
					__DIR__ . '/../../module/Backend/src/Backend/Entity' 
				) 
			),
			'zfcuser_entity' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				//'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../../module/MakiUser/src/MakiUser/Entity'
                ),
            ),

			'orm_default' => array (
				'drivers' => array (
					'Backend\Entity' => 'Backend_driver',
					'MakiUser\Entity' => 'zfcuser_entity',				
				) 
			) 
		) 
	),


	'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'MakiUser\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
    ),


);

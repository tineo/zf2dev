<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overridding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */


/*Profiling*/
$dbParams = array(
    'database'  => 'test1',
    'username'  => 'root',
    'password'  => '12077752',
    'hostname'  => 'localhost'
);

return array(
    'db' => array(
            'driver'    => 'pdo',
            'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
            'database'  => $dbParams['database'],
            'username'  => $dbParams['username'],
            'password'  => $dbParams['password'],
            'hostname'  => $dbParams['hostname'],
    ) 
    
);

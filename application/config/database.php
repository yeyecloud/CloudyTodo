<?php
return array
(
    'default' => array
    (
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'USERNAME',
            'password'   => 'PASSWORD',
            'persistent' => false,
            'database'   => 'DATABASE_NAME',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => Kohana::$environment === 'development',
    ),
    /*'remote' => array(
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => '55.55.55.55',
            'username'   => 'remote_user',
            'password'   => 'mypassword',
            'persistent' => FALSE,
            'database'   => 'my_remote_db_name',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
    ),*/
);

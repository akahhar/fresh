<?php
$config['default_database'] = 'db_saas_module';
$config['database_hostname'] = 'localhost';
$config['database_username'] = 'root';
$config['database_password'] = 'root';
$config['default_url'] = 'http://localhost/ZiscoERP/';
$config['installed'] = '';

$config['config_db'] = array(
    'hostname' => $config['database_hostname'], 'username' => $config['database_username'], 'password' => $config['database_password'],
    'database' => '', /* this will be changed "on the fly" in controler */
    'dbdriver' => 'mysqli', 'dbprefix' => '',
    'pconnect' => FALSE, 'db_debug' => TRUE, 'cache_on' => FALSE
);
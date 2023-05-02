<?php
$config['default_database'] = '%DATABASE%';
$config['database_hostname'] = '%HOSTNAME%';
$config['database_username'] = '%USERNAME%';
$config['database_password'] = '%PASSWORD%';
$config['default_url'] = '%DOMAIN%';
$config['installed'] = '%installed%';

$config['config_db'] = array(
    'hostname' => $config['database_hostname'], 'username' => $config['database_username'], 'password' => $config['database_password'],
    'database' => '', /* this will be changed "on the fly" in controler */
    'dbdriver' => 'mysqli', 'dbprefix' => '',
    'pconnect' => FALSE, 'db_debug' => TRUE, 'cache_on' => FALSE
);
<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

define('CFG_DB_DSN', 'mysql://root@localhost/db_doctrine_test');

define('LIB_DIR',  dirname(__FILE__).'/../lib/');
define('CFG_DIR',  dirname(__FILE__).'/');
define('WEB_DIR',  dirname(__FILE__).'/../web/');
define('HTML_DIR', dirname(__FILE__).'/../html/');

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=zf2db;host=localhost',
        'driver_options' => array(
            'PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'module_layouts' => array(
        'Application' => 'layout/layout.phtml',
        'Social' => 'layout/social.phtml',
    ),
);

<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

switch ($_SERVER['SERVER_NAME']) {
    case 'www.utpadakse.com':
    case 'utpadakse.com':
    case 'https://www.utpadakse.com':
    case 'https://utpadakse.com':
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'densehwm_demo',
            'password' => 'Densetek@2018',
            'database' => 'densehwm_utpadak_se',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
    case 'www.densetek.gq':
    case 'densetek.gq':
    case 'https://www.densetek.gq':
    case 'https://densetek.gq':
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'densehwm_demo',
            'password' => 'Densetek@2018',
            'database' => 'densehwm_utpadak_se',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
    
    default:
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'utpadak_se',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
}
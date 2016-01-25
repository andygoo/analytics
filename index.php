<?php

$application = __DIR__;
$modules = __DIR__.'/../kohana/modules';
$system = __DIR__.'/../kohana/system';

define('DOCROOT', realpath(__DIR__).DIRECTORY_SEPARATOR);
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR); 
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);
unset($application, $modules, $system);

require SYSPATH.'classes/Kohana.php';

date_default_timezone_set('Asia/Shanghai');
setlocale(LC_ALL,"chs");

spl_autoload_register(array('Kohana', 'auto_load'));
ini_set('unserialize_callback_func', 'spl_autoload_call');

error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', TRUE);

Kohana::init(array(
	'base_url' => '/',
	'index_file' => false,
	'profile'    => false,
));

Kohana::modules(array(
	'database'   => MODPATH.'database',
	'helper'     => MODPATH.'helper',
));

Route::set('a_gif', '1.gif')->defaults(array('controller'=>'ma','action' => 'gif'));
Route::set('catch_all', '<path>', array('path' => '.+'))->defaults(array('controller' => 'Error','action' => '404'));

echo Request::instance()->execute();
//try {echo Request::instance()->execute();} catch(Exception $e) {}

<?php

require(dirname(__DIR__).'/vendor/autoload.php');
define('DEBUG',true);
define('URL_PREFIX','willer/');
define('REQUEST_URI',$_SERVER['REQUEST_URI']);
define('ROOT_PATH',__DIR__);
define('DATABASE_PATH',ROOT_PATH.'/Config/database.json');
define('DATABASE', 'development');

new Core\System();
<?php

define('DEBUG',true);
define('URL_PREFIX','/');
define('REQUEST_URI','/');
define('ROOT_PATH',dirname(__DIR__).'/src');
define('DATABASE_PATH',dirname(ROOT_PATH).'/tests/database.json');
define('DATABASE','default');

require(ROOT_PATH.'/Core/Exception/WF_Exception.php');
require(ROOT_PATH.'/Core/Util.php');
require(ROOT_PATH.'/Core/Controller.php');
require(ROOT_PATH.'/Core/DAO/Transaction.php');
require(ROOT_PATH.'/Application/Restaurant/Controller/Home.php');
require(ROOT_PATH.'/Core/DAO/DataManipulationLanguage.php');
require(ROOT_PATH.'/Core/Model.php');
require(ROOT_PATH.'/Application/Restaurant/Model/Restaurant.php');
require(ROOT_PATH.'/Application/Restaurant/Model/Waiter.php');
require(ROOT_PATH.'/Application/Restaurant/Model/Place.php');

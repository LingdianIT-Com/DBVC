<?php

$loader = require 'vendor/autoload.php';

define('OUT_FOLDER',dirname(dirname(__FILE__)).'/db/VCFiles/');
$env = getenv("DEPLOY_ENV");
if (empty($env)) {
    $env = "local";
}
$env = strtolower($env);
$appConfig = require dirname(dirname(__FILE__)).'/app/Conf/'.$env."/config.php";
$transferDb = array(
    "host" => $appConfig['DB_HOST'],
	"user" => $appConfig['DB_USER'],
	"pwd" =>  $appConfig['DB_PWD'],
	"dbName" => $appConfig['DB_NAME']
);
define('DB_CONFIG', $transferDb);
$loadPath = dirname(dirname(__FILE__)).'/db/VCFiles/';
$loader->addPsr4('VCFiles\\', $loadPath);

if (empty($_GET)) {
    include 'view/list.php';
}
if (isset($_GET['c']) && isset($_GET['f'])) {
    $controllerName = "\\Controller\\{$_GET['c']}Controller";
    $controller = new $controllerName();
    $funName = trim($_GET['f']);
    call_user_func(array($controller,$funName));
}


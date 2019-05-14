<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Core\Engine\Components\Helper;
use Core\Engine\Components\Router;

$requestUri = Helper::requestUri();
$requestMethod = Helper::requestMethod();

Router::load('../core/routes.php')->direct($requestUri, $requestMethod);
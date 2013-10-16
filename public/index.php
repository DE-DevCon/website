<?php
$appDir = dirname(__DIR__);
require_once "{$appDir}/vendor/autoload.php";

$twigView = new \Slim\Views\Twig();
$twigView->parserOptions = ['autoescape' => false];

$app = new \Slim\Slim(['view' => $twigView, 'templates.path' => "{$appDir}/src/templates"]);

$view = $app->view();
$view->parserExtensions = [new \Slim\Views\TwigExtension()];

$routes = require "{$appDir}/src/routes.php";
$routes($app);

$app->run();

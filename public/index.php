<?php
$appDir = dirname(__DIR__);
require_once "{$appDir}/vendor/autoload.php";

$mailgunApiKey = getenv('MAILGUN_API_KEY') ?: die('Missing MAILGUN_API_KEY environment variable');

$twigView = new \Slim\Views\Twig();
$twigView->parserOptions = ['autoescape' => false];

$app = new \Slim\Slim(['view' => $twigView, 'templates.path' => "{$appDir}/src/templates"]);

$view = $app->view();
$view->parserExtensions = [new \Slim\Views\TwigExtension()];

$routes = require "{$appDir}/src/routes.php";
$routes($app);

$app->run();

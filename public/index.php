<?php
$appDir = dirname(__DIR__);
require_once "{$appDir}/vendor/autoload.php";

$cookieSecretKey = getenv('COOKIE_SECRET_KEY') ?: die('Missing COOKIE_SECRET_KEY environment variable');

$twigView = new \Slim\Views\Twig();
$twigView->parserOptions = ['autoescape' => false];

$app = new \Slim\Slim([
    'cookies.lifetime' => '1 month',
    'cookies.secret_key' => $cookieSecretKey,
    'view' => $twigView,
    'templates.path' => "{$appDir}/src/templates"
]);
$app->add(new \Slim\Middleware\SessionCookie(['secret' => $cookieSecretKey, 'name' => 'session']));

$app->container->singleton('mailgunDomain', function() {
   return getenv('MAILGUN_DOMAIN') ?: die('Missing MAILGUN_DOMAIN environment variable');
});

$app->container->singleton('mailgun', function() {
    $mailgunApiKey = getenv('MAILGUN_API_KEY') ?: die('Missing MAILGUN_API_KEY environment variable');
    return new \Mailgun\Mailgun($mailgunApiKey);
});

$app->container->singleton('cfpEmail', function() {
   return getenv('CFP_EMAIL') ?: die('Missing CFP_EMAIL environment variable');
});

$view = $app->view();
$view->parserExtensions = [new \Slim\Views\TwigExtension()];

$routes = require "{$appDir}/src/routes.php";
$routes($app);

$app->run();

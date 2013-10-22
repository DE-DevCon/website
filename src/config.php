<?php
return function($app) {
    $twigView = new \Slim\Views\Twig();
    $twigView->parserOptions = ['autoescape' => false];

    $app->config('templates.path', __DIR__ . '/templates');
    $view = $app->view($twigView);
    $view->parserExtensions = [new \Slim\Views\TwigExtension()];

    $app->container->singleton('mailgunDomain', function() {
        $mailgunDomain = getenv('MAILGUN_DOMAIN');
        if (!$mailgunDomain) {
            throw new Exception('Missing MAILGUN_DOMAIN environment variable');
        }

        return $mailgunDomain;
    });

    $app->container->singleton('mailgun', function() {
        $mailgunApiKey = getenv('MAILGUN_API_KEY');
        if (!$mailgunApiKey) {
            throw new Exception('Missing MAILGUN_API_KEY environment variable');
        }

        return new \Mailgun\Mailgun($mailgunApiKey);
    });

    $app->container->singleton('cfpEmail', function() {
        $cfpEmail = getenv('CFP_EMAIL');
        if (!$cfpEmail) {
            throw new Exception('Missing CFP_EMAIL environment variable');
        }

        return $cfpEmail;
    });
};

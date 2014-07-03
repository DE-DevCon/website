<?php
return function(\Slim\Slim $app) {
    $conference = require 'routes/conference.php';

    $app->get('/', function() use($app) {
        $app->redirect($app->urlFor('2014-home'));
    });

    $app->group('/2014', function() use($app, $conference) {
        $conference($app, ['year' => 2014, 'callForPapers' => true, 'faq' => true]);
    });
};

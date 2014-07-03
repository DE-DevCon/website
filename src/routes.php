<?php
return function(\Slim\Slim $app) {
    $conference = require 'routes/conference.php';

    $app->get('/', function() use($app) {
        $app->redirect('/2014/');
    });

    $app->group('/2014', function() use($app, $conference) {
        $conference($app, ['callForPapers' => true, 'faq' => true]);
    });
};

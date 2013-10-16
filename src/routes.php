<?php
return function(\Slim\Slim $app) {
    $app->get('/', function() use($app) {
        $app->render('home.html', ['page' => 'home']);
    })->name('home');

    $app->get('/cfp', function() use($app) {
        $app->render('cfp.html', ['page' => 'cfp']);
    })->name('cfp');
};

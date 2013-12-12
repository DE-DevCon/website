<?php
return function(\Slim\Slim $app) {
    $app->get('/', function() use($app) {
        $app->render('home.html', ['page' => 'home']);
    })->name('home');

    $app->get('/topics', function() use($app) {
        $app->render('topics.html', ['page' => 'topics']);
    })->name('topics');

    $app->get('/people', function() use($app) {
        $app->render('people.html', ['page' => 'people']);
    })->name('people');

    $app->get('/faq', function() use($app) {
        $app->render('faq.html', ['page' => 'faq']);
    })->name('faq');

    $app->get('/schedule', function() use($app) {
        $app->render('schedule.html', ['page' => 'schedule']);
    })->name('schedule');

    $app->get('/survey', function() use($app) {
        $app->render('survey.html', ['page' => 'survey']);
    })->name('survey');
};

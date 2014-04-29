<?php
return function(\Slim\Slim $app) {
    $app->get('/', function() use($app) {
        $app->render('home.html', ['page' => 'home']);
    })->name('home');

    $app->get('/cfp', function() use($app) {
        $app->render('cfp.html', ['page' => 'topics']);
    })->name('cfp');

    $app->post('/cfp', function() use($app) {
        $req = $app->request();
        try {
            $app->mailgun->sendMessage(
                $app->mailgunDomain,
                [
                    'from' => "{$req->post('name')} <{$req->post('email')}>",
                    'to' => $app->cfpEmail,
                    'subject' => 'Call For Papers',
                    'text' => $req->post('summary'),
                ]
            );

            $app->flashNow('success', 'Your proposal has been received.  Thanks for submitting!');
        } catch (\Exception $e) {
            $app->flashNow('error', 'There was an error saving your proposal.  Please verify your information and try again.');
        }

        $app->render('cfp.html', ['page' => 'cfp']);
    });

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

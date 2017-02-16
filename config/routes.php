<?php

$routes->get('/', function() {
    EtusivuController::index();
});


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login', function() {
    UserController::login();
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    UserController::logout();
});

$routes->get('/treenit', function() {
    TreeniController::index();
});

$routes->get('/treeni', function() {
    TreeniController::index();
});

$routes->post('/treeni', function() {
    TreeniController::store();
});


$routes->get('/treeni/new', function() {
    TreeniController::create();
});

$routes->get('/treeni/:id', function($id) {
    if ($id > 0) {
        TreeniController::show($id);
    } else {
        TreeniController::index();
    }
});

$routes->get('/treeni/:id/edit', function($id) {
    TreeniController::edit($id);
});
$routes->post('/treeni/:id/edit', function($id) {
    TreeniController::update($id);
});

$routes->post('/treeni/:id/destroy', function($id) {
    TreeniController::destroy($id);
});

$routes->get('/liike', function() {
    LiikeController::index();
});


$routes->get('/esittely', function() {
    VoimalajitController::index();
});

$routes->get('/rekisterointi', function() {
    RekisterointiController::index();
});

$routes->get('/voimalajit', function() {
    VoimalajitController::index();
});

$routes->get('/voimalajit/:id', function($id) {
    if ($id == 1) {
        VoimalajitController::nopeus($id);
    } elseif ($id == 2) {
        VoimalajitController::kesto($id);
    } elseif ($id == 3) {
        VoimalajitController::maksi($id);
    } else {
        VoimalajitController::index();
    }
});

$routes->get('/etusivu', function() {
    EtusivuController::index();
});







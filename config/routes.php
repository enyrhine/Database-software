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

$routes->get('/show_all', function() {
    UserController::index();
});

$routes->get('/user/:id', function($id) {
    UserController::show($id);
});

$routes->get('/user/:id/edit', function($id) {
    UserController::edit($id);
});

$routes->post('/user/:id/edit', function($id) {
    UserController::update($id);
});

$routes->get('/user/rekisterointi', function() {
    RekisterointiController::show();
});

$routes->post('/user/rekisterointi', function() {
    UserController::save();
});

$routes->post('/user/:id/destroy', function($id) {
    UserController::destroy($id);
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

$routes->get('/search', function() {
    TreeniController::search();
});

$routes->post('/search', function() {
    TreeniController::searchName();
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
    VoimalajiController::index();
});

$routes->get('/rekisterointi', function() {
    RekisterointiController::show();
});

$routes->get('/voimalaji', function() {
    VoimalajiController::index();
});

$routes->get('/voimalaji/:id', function($id) {
        VoimalajiController::show($id);
    
});

$routes->get('/voimalaji/:id/edit', function($id) {
    VoimalajiController::edit($id);
});
$routes->post('/voimalaji/:id/edit', function($id) {
    VoimalajiController::update($id);
});

$routes->get('/etusivu', function() {
    EtusivuController::index();
});







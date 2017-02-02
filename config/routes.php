<?php

  $routes->get('/', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
    LoginController::index();
  });
  
  $routes->get('/lisays', function() {
    AddController::index();
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
  
  $routes->get('/liike', function() {
    LiikeController::index();
  });
  
   $routes->get('/etusivu', function() {
    EtusivuController::index();
  });
  
  $routes->get('/esittely', function() {
    VoimalajitController::index();
  });
  
  $routes->get('/rekisterointi', function() {
    RekisterointiController::index();
  });
  
  $routes->get('/voimalajit', function() {
    VoimalajitController::other();
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
  
  
  
  

  
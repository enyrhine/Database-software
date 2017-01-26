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
  
  $routes->get('/liike', function() {
    LiikeController::index();
  });
  
   $routes->get('/etusivu', function() {
    EtusivuController::index();
  });
  
  $routes->get('/esittely', function() {
    EsittelyController::index();
  });
  
  $routes->get('/rekisterointi', function() {
    RekisterointiController::index();
  });

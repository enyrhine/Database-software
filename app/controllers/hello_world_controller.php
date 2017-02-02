<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      $crossfit = Treeni::findName(1);
      $treenit = Treeni::all();
      Kint::dump($treenit);
      Kint::dump($crossfit);
    }
    
  }

<?php

  class EsittelyController extends BaseController{

    

    public static function index(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/esittely.html');
    }
   
    public static function redirect(){
      // Testaa koodiasi täällä
      Redirect::to('/esittely');
    }
  }


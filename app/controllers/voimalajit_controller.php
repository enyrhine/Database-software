<?php

  class VoimalajitController extends BaseController{

    

    public static function index(){
      $voimalajit = Voimalaji::all();
      View::make('suunnitelmat/esittely.html', array('voimalajit' => $voimalajit));
    }
    
    public static function other(){
      $voimalajit = Voimalaji::all();
      View::make('suunnitelmat/voimalajit.html');
    }
    
    public static function nopeus($id){
      View::make('voimalajit/nopeusvoima.html');
    }
    
    public static function kesto($id){
      View::make('voimalajit/kestovoima.html');
    }
    
    public static function maksi($id){
      View::make('voimalajit/maksimivoima.html');
    }
    
  }


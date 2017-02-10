<?php

  class LiikeController extends BaseController{

    

    public static function index() {
        $liikkeet = Liike::all();
        View::make('suunnitelmat/liike.html', array('liikkeet' => $liikkeet));
    }
    
  }


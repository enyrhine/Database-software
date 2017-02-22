<?php

class VoimalajiController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $voimalajit = Voimalaji::all();
        View::make('suunnitelmat/esittely.html', array('voimalajit' => $voimalajit));
    }

    public static function other() {
        self::check_logged_in();
        $voimalajit = Voimalaji::all();
        View::make('suunnitelmat/voimalajit.html');
    }

     public static function show($id) {
        self::check_logged_in();
        $voimalaji = Voimalaji::findId($id);
        $treenit = $voimalaji->getTreenit();
        View::make('voimalaji/voimalaji.html', array('voimalaji' => $voimalaji, 'treenit' => $treenit));
    }
    
    public static function edit($id) {
        self::check_logged_in();
        $voimalaji = Voimalaji::findId($id);
        $treenit = Treeni::all();
        View::make('voimalaji/edit.html', array('attributes' => $voimalaji, 'treenit' => $treenit));
    }

    

}

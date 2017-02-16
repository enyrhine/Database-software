<?php

class VoimalajitController extends BaseController {

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

    public static function nopeus($id) {
        self::check_logged_in();
        View::make('voimalajit/nopeusvoima.html');
    }

    public static function kesto($id) {
        self::check_logged_in();
        View::make('voimalajit/kestovoima.html');
    }

    public static function maksi($id) {
        self::check_logged_in();
        View::make('voimalajit/maksimivoima.html');
    }

}

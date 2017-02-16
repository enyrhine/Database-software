<?php

class EsittelyController extends BaseController {

    public static function index() {
        self::check_logged_in();
        View::make('suunnitelmat/esittely.html');
    }

    public static function redirect() {
        self::check_logged_in();
        Redirect::to('/esittely');
    }

}

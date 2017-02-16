<?php

class LiikeController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $liikkeet = Liike::all();
        View::make('suunnitelmat/liike.html', array('liikkeet' => $liikkeet));
    }

}

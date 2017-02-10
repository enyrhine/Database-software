<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        $testi = New Treeni(array(
            'name' => 'mo',
            'kesto' => '60min',
            'soveltuvuus' => 'kaikille',
            'kuvaus' => 'ihan ok treeni'
        ));
        $errors = $testi->errors();
        Kint::dump($errors);
        
    }

}

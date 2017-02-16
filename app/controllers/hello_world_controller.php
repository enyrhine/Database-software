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
        $user = New Kayttaja(array(
            'name' => 'Elsamoi',
            'email' => 'elsa@joku.fi',
            'password' => '12345',
            'rooli' => 'ei ole'
            
        ));
       
        echo $user -> getName();
        
    }

}

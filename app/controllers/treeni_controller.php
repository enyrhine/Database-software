<?php

class TreeniController extends BaseController {

    public static function index() {
        View::make('treeni/treeni.html');
    }
    
    public static function show($id) {
        View::make('treeni/treeni.html');
        $treeni = Treeni::findId($id);
    }

    public static function create() {
        View::make('treeni/new.html');
        
    }

    public static function store() {
        $params = $_POST;
        $treeni = new Treeni(array(
            'name' => $params['name'],
            'kesto' => $params['kesto'],
            'soveltuvuus' => $params['soveltuvuus'],
            'kuvaus' => $params['kuvaus']
        ));

        $treeni->save();

        // Ohjataan käyttäjä lisäyksen jälkeen treenin esittelysivulle
        Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeni on lisätty arkistoon!'));
    }

}

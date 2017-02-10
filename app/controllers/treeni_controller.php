<?php

class TreeniController extends BaseController {

    public static function index() {
        $treenit = Treeni::all();
        View::make('treeni/treeni.html', array('treenit' => $treenit));
    }

    public static function show($id) {
        $treeni = Treeni::findId($id);
        View::make('treeni/treeni.html', array('treeni' => $treeni));
    }

    public static function create() {
        View::make('treeni/new.html');
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
            'kesto' => $params['kesto'],
            'soveltuvuus' => $params['soveltuvuus'],
            'kuvaus' => $params['kuvaus']
        );

        $treeni = new Treeni($attributes);
        $errors = $treeni->errors();
        
        if (count($errors) == 0) {
            $treeni->save();
            Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeni on lisätty arkistoon!'));
        } else {
            View::make('treeni/new.html', array('errors' => $errors, 'params' => $params));
        }
        
            
        
    }

    public static function edit($id) {
        $treeni = Treeni::findId($id);
        View::make('treeni/edit.html', array('attributes' => $treeni));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'kesto' => $params['kesto'],
            'soveltuvuus' => $params['soveltuvuus'],
            'kuvaus' => $params['kuvaus']
        );

        $treeni = new Treeni($attributes);
        //$errors = $treeni->errors();
        //if (count($errors) > 0) {
          //  View::make('treeni/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        //} else {
            $treeni->update();
            Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeniä on muokattu onnistuneesti!'));
        //}
    }

    public static function destroy($id) {
        $treeni = new Treeni(array('id' => $id));
        $treeni->destroy();

        Redirect::to('/esittely', array('message' => 'Peli on poistettu onnistuneesti!'));
    }

}

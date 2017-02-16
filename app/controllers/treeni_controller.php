<?php

class TreeniController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $treenit = Treeni::all();
        View::make('treeni/treenit.html', array('treenit' => $treenit));
    }

    public static function show($id) {
        self::check_logged_in();
        $treeni = Treeni::findId($id);
        View::make('treeni/treeni.html', array('treeni' => $treeni));
    }

    public static function create() {
        self::check_logged_in();
        View::make('treeni/new.html');
    }

    public static function store() {
        self::check_logged_in();
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
        self::check_logged_in();
        $treeni = Treeni::findId($id);
        View::make('treeni/edit.html', array('attributes' => $treeni));
    }

    public static function update($id) {
        self::check_logged_in();
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
        //View::make('treeni/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        //} else {
        $treeni->update();
        Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeniä on muokattu onnistuneesti!'));
        //}
    }

    public static function destroy($id) {
        self::check_logged_in();

        $treeni = new Treeni(array('id' => $id));
        $treeni->delete();

        Redirect::to('/treenit', array('message' => 'Peli on poistettu onnistuneesti!'));
    }

}

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
        if ($treeni != null) {
            $voimalajit = $treeni->getVoimalajit();
        }
        $soveltuvuus = json_decode($treeni->soveltuvuus);

        View::make('treeni/treeni.html', array('treeni' => $treeni, 'voimalajit' => $voimalajit, 'soveltuvuus' => $soveltuvuus));
    }

    public static function create() {
        self::check_logged_in();
        $voimalajit = Voimalaji::all();

        //Kint::dump($voimalajit);
        View::make('treeni/new.html', array('voimalajit' => $voimalajit));
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
        $voimalajit = Voimalaji::all();
        $errors = $treeni->errors();
        if (count($errors) == 0) {
            $treeni->save();
            if (empty($_POST["voimalajit"])) {
                Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeni on lisätty arkistoon!'));
            } else {
                $voimalaji_idt = $_POST["voimalajit"];
                $N = count($voimalaji_idt);
                for ($i = 0; $i < $N; $i++) {
                    $v = $voimalaji_idt[$i];
                    $treeni->addVoimalaji($v);
                }
                Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeni on lisätty arkistoon!'));
            }
        } else {
            View::make('treeni/new.html', array('errors' => $errors, 'params' => $params, 'voimalajit' => $voimalajit));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $treeni = Treeni::findId($id);
        $voimalajit = Voimalaji::all();
        $soveltuvuus = json_decode($treeni->soveltuvuus);
        View::make('treeni/edit.html', array('attributes' => $treeni, 'voimalajit' => $voimalajit, 'soveltuvuus' => $soveltuvuus));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        
        $soveltuvuus = null;
        if (array_key_exists('soveltuvuus', $params)) {
           $soveltuvuus = $params['soveltuvuus'];
        }
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'kesto' => $params['kesto'],
            'soveltuvuus' => $soveltuvuus
        );

        $treeni = new Treeni($attributes);
        if (!empty($_POST["voimalajit"])) {
            $voimalaji_idt = $_POST["voimalajit"];
        }
        //$voimalaji_deletet = $_POST["voimalajitD"];
        $nameError = $treeni->validate_name();
        $soveltuvuusError = $treeni->validate_soveltuvuus();
        Kint::dump($nameError);
        Kint::dump($soveltuvuusError);
        $errors = array_merge($nameError, $soveltuvuusError);


        if (count($errors) > 0) {
            View::make('treeni/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            if (!empty($_POST["voimalajit"])) {
                $treeni->update($voimalaji_idt);
            } else {
                $voimalaji_idt = null;
                $treeni->update($voimalaji_idt);
            }

            Redirect::to('/treeni/' . $treeni->id, array('message' => 'Treeniä on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        self::check_logged_in();

        $treeni = new Treeni(array('id' => $id));
        $treeni->delete();

        Redirect::to('/treenit', array('message' => 'Peli on poistettu onnistuneesti!'));
    }

    public static function search() {
        self::check_logged_in();
        View::make('suunnitelmat/search.html');
    }

    public static function searchName() {
        self::check_logged_in();
        //$search = htmlspecialchars($_POST["search"]);
        $search = $_POST["search"];
        $treenit = Treeni::findName($search);
        //Kint::dump($treenit);

        $message = "Sopivia hakuja ei löytynyt.";
        if ($treenit == null) {
            View::make('suunnitelmat/search.html', array('treenit' => $treenit, 'message' => $message));
        } else {
            View::make('suunnitelmat/search.html', array('treenit' => $treenit, 'message' => 'Löytyi'));
        }
    }

}

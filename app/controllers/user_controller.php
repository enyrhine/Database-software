<?php

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }
    
    public static function index() {
        self::check_logged_in();
        $user = self::get_user_logged_in();
        
        $users = User::findAll();
        if ($user->checkRooli($user->id)) {
            View::make('user/show_all.html', array('users' => $users));
        } else {
            View::make('suunnitelmat/etusivu.html');
        }
        
    }

    public static function save() {
        $params = $_POST;
        $rooli = 0;
        $password1 = $params['password'];
        $password2 = $params['passwordagain'];
        if ($password1 == $password2) {
            $user = new User(array('name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'rooli' => $rooli
        ));
        } else {
            View::make('user/rekisterointi.html', array('message' => "Syötä sama salanasa."));
        }
        
        
        $nameErrors = $user->validate_name();
        $passwordErrors = $user->validate_password();
        $emailErrors = $user->validate_email();
        
        $errors = array_merge($nameErrors, $passwordErrors, $emailErrors);
        
        if (count($errors) > 0) {
            View::make('user/rekisterointi.html', array('errors' => $errors, 'user' => $user));
        } else {
            $user->save();
            UserController::handle_login();
        }
        
    }

    public static function show($id) {
        self::check_logged_in();
        $user = User::find($id);
        $uservalid = self::get_user_logged_in();
        if ($uservalid->rooli) {
            View::make('user/user.html', array('user' => $user));
        }
        if ($uservalid == $user) {
            View::make('user/user.html', array('user' => $user));
        } else {
            Redirect::to('/esittely', array('message' => 'Ei käyttöoikeutta.'));
        }
    }

    public static function edit($id) {
        self::check_logged_in();
        $user = User::find($id);
        $admin = User::checkRooli($id);
        View::make('user/edit.html', array('attributes' => $user, 'admin' => $admin));
    }

    public static function update($id) {
        self::check_logged_in();
        $params = $_POST;
        $pw1 = $params['password'];
        $pw2 = $params['passwordagain'];

        $rooli = null;
        if (array_key_exists('rooli', $params)) {
            $rooli = $params['rooli'];
        } else {
            $rooli = 0;
        }

        $attributes = array('id' => $id,
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'rooli' => $rooli
        );

        $user = new User($attributes);
        $nameErrors = $user->validate_name();
        $passwordErrors = $user->validate_password();
        $passwordAgain = $user->validate_same_password($pw1, $pw2);
        $errors = array_merge($nameErrors, $passwordErrors, $passwordAgain);

        if (count($errors) > 0) {
            View::make('user/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $user->update($id);
            //$_SESSION['user'] = $user->id;
            Redirect::to('/user/' . $user->id, array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['name'], $params['password']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/esittely', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function destroy($id) {
        self::check_logged_in();

        $user = new User(array('id' => $id));
        $user->delete();
        $_SESSION['user'] = null;
        Redirect::to('/etusivu', array('message' => 'Käyttäjäsi on poistettu onnistuneesti!'));
    }

}

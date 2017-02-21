<?php

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['name'], $params['password']);

        if (!$user) {
            View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/esittely', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }
    
    

}

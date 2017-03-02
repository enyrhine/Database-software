<?php

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/login.html');
    }
    
    public static function show($id) {
        self::check_logged_in();
        $user = User::find($id);
        
        View::make('user/user.html', array('user' => $user));
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
        
        $rooli = null;
        if (array_key_exists('rooli', $params)) {
           $rooli = $params['rooli'];
        } else {
            $rooli = 0;
        }
        
        $attributes = array('id'=> $id,
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'rooli' => $rooli
            );
        
        $user = new User($attributes);
        $nameErrors = $user->validate_name();
        $passwordErrors = $user->validate_password();   
        $errors = array_merge($nameErrors, $passwordErrors);
        
        if(count($errors) > 0) {
            View::make('user/edit.html', array('errors' => $errors, 'user' => $user));
        } else {
            $user->update($id);
            $_SESSION['user'] = $user->id;
             Redirect::to('/user/' . $user->id, array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
        
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

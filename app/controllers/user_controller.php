<?php
class UserController extends BaseController{
 
    
  public static function login(){
      View::make('suunnitelmat/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['name'], $params['password']);

    if(!$user){
        echo 'moi';
      View::make('suunnitelmat/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
      
    }else{
        echo 'hei';
      $_SESSION['user'] = $user->user_id;
      Redirect::to('/esittely', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
      
    }
  }
  
  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
}

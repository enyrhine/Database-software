<?php

class User extends BaseModel {
    
    public $user_id, $name, $email, $rooli, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function authenticate($name, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE name = :name AND password = :password LIMIT 1');
        $query->execute(array('name' => $name, 'password' => $password));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'rooli' => $row['rooli'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }
}

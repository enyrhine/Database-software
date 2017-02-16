<?php

class User extends BaseModel {
    
    public $user_id, $name, $email, $password, $rooli;
    
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
                'password' => $row['password'],
                'rooli' => $row['rooli']
                
            ));
            return $user;
        }
        return null;
    }
}

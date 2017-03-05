<?php

class User extends BaseModel {

    public $id, $name, $email, $password, $rooli;

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

    public static function checkRooli($id) {
        $query = DB::connection()->prepare("SELECT * FROM Kayttaja WHERE rooli = 't' AND id = :id LIMIT 1");
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password'],
                'rooli' => $row['rooli']
            ));
            return $user->rooli;
        }
        return null;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
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
    
    public static function findAll() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $users = array();

        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => $row['password'],
                'rooli' => $row['rooli']
            ));
        }
        return $users;
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET (name, email, password, rooli) = (:name, :email, :password, :rooli) WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'rooli' => $this->rooli));
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->name) < 3) {
            $errors[] = 'Nimen tulee olla vähintään kolme merkkiä!';
        }
        return $errors;
    }
    
    public function validate_email() {
        $errors = array();
        if ($this->email == '' || $this->email == null) {
            $errors[] = 'Email ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        if (strlen($this->password) < 6) {
            $errors[] = 'Salasanan tulee olla vähintään 6 merkkiä pitkä.';
        }
        return $errors;
    }
    
    public function validate_same_password($pw1, $pw2) {
        $errors = array();
        if ($pw1 != $pw2) {
            $errors[] = 'Tarkista, että salasanat on syötetty oikein!';
        } 
        return $errors;
    }

    public function delete() {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (name, email, password, rooli) VALUES
			(:name, :email, :password, :rooli) RETURNING id');
        $query->execute(array('name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'rooli' => $this->rooli
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}

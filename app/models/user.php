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
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
		$query->execute(array('id'=>$id));
		$row = $query->fetch();
		if($row) {
			$rooli = new User(array(
				'rooli' => $row['rooli']
				));
			return $rooli;
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

}

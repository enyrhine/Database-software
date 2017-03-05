<?php

class Voimalaji extends BaseModel {

    public $id, $name, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_string_length');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Voimalaji');
        $query->execute();
        $rows = $query->fetchAll();
        $voimalajit = array();

        foreach ($rows as $row) {
            $voimalajit[] = new Voimalaji(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $voimalajit;
    }

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Voimalaji WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $voimalaji = new Voimalaji(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'kuvaus' => $row['kuvaus']
            ));
            return $voimalaji;
        }
        return null;
    }
    
    public function addTreeni($treeni_id) {
        $query = DB::connection()->prepare('INSERT INTO VoimaTreeni (voimalaji_id, treeni_id) VALUES (:voimalaji_id, :treeni_id)');
        $query->execute(array('voimalaji_id' => $this->id, 'treeni_id' => $treeni_id));
        
    }
    
    public function getTreenit() {
        $query = DB::connection()->prepare('SELECT * FROM VoimaTreeni INNER JOIN Treeni ON VoimaTreeni.treeni_id = Treeni.id WHERE VoimaTreeni.voimalaji_id = :id');
        $query->execute(array('id' => $this->id));
        $rows = $query->fetchAll();
        $treenit = array();

        foreach ($rows as $row) {
            $treenit[] = new Treeni(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'kesto' => $row['kesto'],
                'soveltuvuus' => $row['soveltuvuus'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $treenit;
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Voimalaji SET (name, kuvaus) = (:name, :kuvaus) WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'kuvaus' => $this->kuvaus));
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


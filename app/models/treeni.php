<?php

class Treeni extends BaseModel {

    public $id, $name, $kesto, $soveltuvuus, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_string_length');
        //$this->soveltuvuus = array();
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Treeni');
        $query->execute();
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

    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Treeni WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $treeni = new Treeni(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'kesto' => $row['kesto'],
                'soveltuvuus' => $row['soveltuvuus'],
                'kuvaus' => $row['kuvaus']
            ));
            return $treeni;
        }
        return null;
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
    
    
    
    public function validate_soveltuvuus() {
        $errors = array();
        if ($this->soveltuvuus == null) {
            $errors[] = 'Soveltuvuus ei saa olla tyhjä!';
        }
        return $errors;
    }
    

    public static function findName($name) {
        $name = '%' . strtolower($name) . '%';
        $query = DB::connection()->prepare('SELECT * FROM Treeni WHERE LOWER(name) LIKE :name');
        $query->execute(array('name' => $name));
        $rows = $query->fetchAll();
        $treenit = array();
        if ($rows == null) {
            return NULL;
        }

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

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Treeni (name, kesto, soveltuvuus, kuvaus) VALUES (:name, :kesto, :soveltuvuus, :kuvaus) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('name' => $this->name, 'kesto' => $this->kesto, 'soveltuvuus' => json_encode($this->soveltuvuus), 'kuvaus' => $this->kuvaus));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

    public function update($voimalaji_idt) {
        $this->deleteVoimalaji();
        if ($voimalaji_idt != null) {
            foreach ($voimalaji_idt as $voimalaji_id) {
                $this->addVoimalaji($voimalaji_id);

                //$query = DB::connection()->prepare('UPDATE VoimaTreeni SET (voimalaji_id, treeni_id) = (:voimalaji_id, :treeni_id) WHERE treeni_id = :id');
                //$query->execute(array('voimalaji_id' => $voimalaji_id, 'treeni_id' => $this->id)); 
            }
        }
        $query1 = DB::connection()->prepare('UPDATE Treeni SET (name, kesto, soveltuvuus, kuvaus) = (:name, :kesto, :soveltuvuus, :kuvaus) WHERE id = :id');
        $query1->execute(array('id' => $this->id, 'name' => $this->name, 'kesto' => $this->kesto, 'soveltuvuus' => json_encode($this->soveltuvuus), 'kuvaus' => $this->kuvaus));
    }

    public function delete() {
        $query2 = DB::connection()->prepare('DELETE FROM VoimaTreeni WHERE treeni_id = :id');
        $query2->execute(array('id' => $this->id));
        $query1 = DB::connection()->prepare('DELETE FROM Treeni WHERE id = :id');
        $query1->execute(array('id' => $this->id));

        //$query3 = DB::connection()->prepare('DELETE FROM Voimalaji WHERE id = :id');
        //$query3->execute(array('id' => $this->id));
    }

    public function deleteVoimalaji() {
        $query2 = DB::connection()->prepare('DELETE FROM VoimaTreeni WHERE treeni_id = :id');
        $query2->execute(array('id' => $this->id));
    }

    public function addVoimalaji($voimalaji_id) {
        $query = DB::connection()->prepare('INSERT INTO VoimaTreeni (voimalaji_id, treeni_id) VALUES (:voimalaji_id, :treeni_id)');
        $query->execute(array('voimalaji_id' => $voimalaji_id, 'treeni_id' => $this->id));
    }

    public function getVoimalajit() {
        $query = DB::connection()->prepare('SELECT * FROM VoimaTreeni INNER JOIN Voimalaji ON VoimaTreeni.voimalaji_id = Voimalaji.id WHERE VoimaTreeni.treeni_id = :id');
        $query->execute(array('id' => $this->id));
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

    public function getSoveltuvuus() {
        foreach ($this->soveltuvuus as $row) {
            echo $row;
        }
    }
}

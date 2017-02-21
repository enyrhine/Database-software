<?php

class Liike extends BaseModel {

    public $id, $name, $soveltuvuus, $kuvaus, $voimalaji_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_string_length');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Liike');
        $query->execute();
        $rows = $query->fetchAll();
        $liikkeet = array();

        foreach ($rows as $row) {
            $liikkeet[] = new Treeni(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'soveltuvuus' => $row['soveltuvuus'],
                'kuvaus' => $row['kuvaus'],
                'voimalaji_id' => $row['voimalaji_id']
            ));
        }
        return $liikkeet;
    }
    
    public static function findId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Liike WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $liike = new Liike(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'soveltuvuus' => $row['soveltuvuus'],
                'kuvaus' => $row['kuvaus'],
                'voimalaji_id' => $row['voimalaji_id']
            ));
            return $liike;
        }
        return null;
    }

//jatka tästä -> ei vielä muokattu
    public static function findName($name) {
        $query = DB::connection()->prepare('SELECT * FROM Treeni WHERE name = :name');
        $query->execute(array('name' => $name));
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

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Treeni (name, kesto, soveltuvuus, kuvaus) VALUES (:name, :kesto, :soveltuvuus, :kuvaus) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('name' => $this->name, 'kesto' => $this->kesto, 'soveltuvuus' => $this->soveltuvuus, 'kuvaus' => $this->kuvaus));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }
    
    public function update() {
        $query = DB::connection()->prepare('UPDATE Treeni SET (name, kesto, soveltuvuus, kuvaus) = (:name, :kesto, :soveltuvuus, :kuvaus) WHERE id = :id');
        $query->execute(array('id' => $this->id, 'name' => $this->name, 'kesto' => $this->kesto, 'soveltuvuus' => $this->soveltuvuus, 'kuvaus' => $this->kuvaus));
    }
    
    public function delete() {
        $query = DB::connection()->prepare('DELETE FROM Treeni WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

}

<?php

class Treeni extends BaseModel {

    public $id, $name, $kesto, $soveltuvuus, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
        $query = DB::connection()->prepare('SELECT * FROM Treeni WHERE id = :id LIMIT1');
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

}

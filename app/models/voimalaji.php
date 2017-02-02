<?php

class Voimalaji extends BaseModel {

    public $id, $name, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
    
    
}


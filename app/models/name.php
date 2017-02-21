<?php

class Name extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function getName() {
        $query = DB::connection()->prepare('SELECT * FROM name ORDER BY random() LIMIT 1');
        $query->execute();
        $row = $query->fetch();
        if ($row) {
            $name = new Name(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $name;
        }
        return null;
    }

    public static function getNames() {
        $query = DB::connection()->prepare('SELECT * FROM name');
        $query->execute();
        $rows = $query->fetchAll();
        $names = array();
        foreach ($rows as $row) {
            $names[] = new Name(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $names;
    }

}

<?php

class Test{

    public $test;

    public function getAll(PDO $bdd, String $table, String $name){
        if ($name == NULL) {
            $query = 'SELECT * FROM ' . $table ;
            $params = array();
        } else {
            $query = 'SELECT * FROM ' . $table . ' WHERE username LIKE ?';
            $params = array("%" . $name . "%");
        }
        $statement = $bdd->prepare($query);
        $statement->execute($params);
        $return = $statement->fetchAll();
        return $return;
    }

}
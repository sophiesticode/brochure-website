<?php

namespace App\Models;

class Categorie extends Model {
    protected $table = 'categories';

    public function getOuvrages(){
        return $this->query(
            "SELECT o.* FROM ouvrages o
            INNER JOIN ouvrage_categorie oc ON oc.ouvrage_id = o.id
            WHERE oc.categorie_id = ?;", [$this->id]);
        ;
    }

}
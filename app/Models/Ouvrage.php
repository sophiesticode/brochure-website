<?php

namespace App\Models;

class Ouvrage extends Model {
    protected $table = 'ouvrages';

    public function getCategories() {
        return $this->query(
            "SELECT c.* FROM categories c
            INNER JOIN ouvrage_categorie oc ON oc.categorie_id = c.id
            WHERE oc.ouvrage_id = ?",
            [$this->id]);
    }

    public function getTheme() {
        return $this->query(
            "SELECT t.* FROM themes t
            INNER JOIN ouvrages o ON o.theme_id = t.id
            WHERE o.id = ?;",
            [$this->id], true);
    }

    public function getItems() {
        return $this->query(
            "SELECT i.* FROM items i
            WHERE i.ouvrage_id = ?",
            [$this->id]);
    }

    public function add(array $data, ?array $relations = null, array $files, array $new_labels){
        parent::create($data, $relations);
        
        $id = $this->getLastInsertId();

        $itemOuvrage = new ItemOuvrage($this->getDB());
        $itemOuvrage->addItems($id, $files, $new_labels);

        foreach($relations as $categorieId){         
            $stmt = $this->db->getPDO()->prepare("INSERT INTO ouvrage_categorie (ouvrage_id, categorie_id) VALUES (?, ?)");
            $stmt->execute([$id, $categorieId]);
        }
        return true;
    }

    public function getLastInsertId(){
        return $this->db->getPDO()->lastInsertId();
    }

    public function update(int $id, array $data, ?array $relations = null){
        try {
            parent::update($id, $data);
            $stmt = $this->db->getPDO()->prepare("DELETE FROM ouvrage_categorie WHERE ouvrage_id = ?");
            $result = $stmt->execute([$id]);
           
            foreach($relations as $categorieId){         
                $stmt = $this->db->getPDO()->prepare("INSERT INTO ouvrage_categorie (ouvrage_id, categorie_id) VALUES (?, ?)");
                $stmt->execute([$id, $categorieId]);
            }
            if($result){
                return true;
            }
        } catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function hasCategorie(int $id){
        foreach ($this->getCategories() as $categorie) {
            if ($categorie->id === $id) {
                return true;
            }
        }
    }

    public function findByCategorie(string $categorie) {
        return $this->query(
            "SELECT o.* FROM ouvrages o
            INNER JOIN ouvrage_categorie oc ON oc.ouvrage_id = o.id
            INNER JOIN categories c ON oc.categorie_id = c.id
            WHERE o.visible = true AND c.nom LIKE ?;", [$categorie]);
        ;
    }

    public function findByThemeActivated(int $id_theme) {
        return $this->query(
            "SELECT o.* FROM ouvrages o
            WHERE o.theme_id = ?;", [$id_theme]);
        ;
    }
}
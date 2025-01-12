<?php

namespace App\Models;

class Theme extends Model {
    protected $table = 'themes';

    public function getThemeActivated(): Model {
        return $this->query(
            "SELECT * FROM {$this->table}
            WHERE {$this->table}.actif = ?;", [1], true);
        ;
    }

    public function updateTheme(int $id){
        $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET actif = ?");
        $result = $stmt->execute([0]);
                
        $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET actif = ? WHERE id = ?");
        $stmt->execute([1, $id]);

        if($result){
            return true;
        }
    }

    public function addTheme(array $data){
        if($data['actif']){
            $stmt = $this->db->getPDO()->prepare("UPDATE {$this->table} SET actif = ?");
            $stmt->execute([0]);
        }
        $stmt = $this->db->getPDO()->prepare("INSERT INTO {$this->table} (nom, actif) VALUES (?, ?)");
        $stmt->execute([$data['nom'], $data['actif']]);
        return true;
    }

    public function deleteTheme(int $id){
        $stmt = $this->db->getPDO()->prepare("UPDATE ouvrages SET theme_id = 0 WHERE theme_id = ?");
        $stmt->execute([$id]);

        $stmt = $this->db->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    }
}
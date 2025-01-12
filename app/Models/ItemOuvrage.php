<?php

namespace App\Models;

class ItemOuvrage extends Model {
    protected $table = 'items';

    public function addItems(int $id, array $files, ?array $new_labels){
        
        foreach ($files as $key => $file) {

            if ($file['name'] !== '') {
                $stmt = $this->db->getPDO()->prepare("INSERT INTO {$this->table} (label, img, ouvrage_id) VALUES (?,?,?)");
                $result = $stmt->execute([((isset($new_labels)) && (isset($new_labels[$key])) ? $new_labels[$key]:''), $file['name'], $id]);
            }
        }
    }

    public function updateLabels(int $id, array $labels){
        $stmt = $this->db->getPDO()->prepare("DELETE FROM {$this->table} WHERE ouvrage_id = ?");
        $result = $stmt->execute([$id]);

        foreach ($labels as $key=>$label) {
            if($label[1] !== null){
                $stmt = $this->db->getPDO()->prepare("INSERT INTO {$this->table} (label, img, ouvrage_id) VALUES (?,?,?)");
                $result = $stmt->execute([$label[0], $label[1], $id]);
            }
        }
    }

}
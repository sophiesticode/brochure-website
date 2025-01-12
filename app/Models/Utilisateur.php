<?php

namespace App\models;

use App\Models\Model;

class Utilisateur extends Model{
    protected $table = 'utilisateurs';

    public function getByUsername(string $username): Utilisateur{
        return $this->query("SELECT * FROM {$this->table} WHERE nom = ?;", [$username], true);
    }

    public function updateMdp(int $id, string $mdp){
        return $this->query("UPDATE {$this->table} SET mdp = ? WHERE id = ?;", [$mdp, $id]);
    }
    
}
<?php

namespace App\Models;
use Database\DBConnection;
use stdClass;
use PDO;
use ErrorException;

abstract class Model {
    protected $db;
    protected $table;

    public function __construct(DBConnection $db){
        $this->db = $db;
    }

    public function getDB() {
        return $this->db;
    }

    public function all(): array {
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function findById(int $id): Model {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function create(array $data, ?array $relations = null){

        $firstParenthesis = "";
        $secondParenthesis = "";
        $i = 1;

        foreach($data as $key => $value){
            if ((string)(int)$data[$key] === $data[$key]) {
                $data[$key] = (int)$data[$key];
            }
            $comma = ($i === count($data)) ? ' ' : ', ';
            $firstParenthesis .= "{$key}{$comma}";
            $secondParenthesis .= ":{$key}{$comma}";
            $i++;
        }
        return $this->query("INSERT INTO {$this->table} ($firstParenthesis) VALUES ($secondParenthesis);", $data);
    }

    public function update(int $id, array $data, ?array $relations = null){
        $sqlRequestPart = "";
        $i = 1;
        foreach($data as $key => $value){
            if ((string)(int)$data[$key] === $data[$key]) {
                $data[$key] = (int)$data[$key];
            }
            $comma = ($i === count($data)) ? ' ' : ', ';
            $sqlRequestPart .= "{$key} = :{$key}{$comma}";
            $i++;
        }
        $data['id'] = $id;
        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id = :id;", $data);
    }

    public function destroy(int $id): bool{
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function query(string $sql, array $param = null, bool $single = null) {
        $method = is_null($param) ? 'query' : 'prepare';

        if(
            (strpos($sql, 'DELETE') === 0) 
            || (strpos($sql, 'UPDATE') === 0) 
            || (strpos($sql, 'CREATE') === 0)) {
            try {
                $stmt = $this->db->getPDO()->$method($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
                return $stmt->execute($param);
            } catch(\Exception $e){
                echo $e->getMessage();
            }
            
        }

        $fetch = is_null($single) ? 'fetchAll' : 'fetch';

        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);

        if($method === 'query'){
            return $stmt->$fetch();
        } else {
            $stmt->execute($param);
            return $stmt->$fetch();
        }
    }

   
}
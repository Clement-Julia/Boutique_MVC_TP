<?php

class BDD {
    private $host = 'localhost';
    private $port = 3307;
    private $database = 'project_mvc_boutique';
    private $user = 'root';
    private $pwd = '';

    protected $co = false;

    public function __construct() {
        if(!$this->co){
            try {
                $this->co = new PDO('mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->database.';charset=UTF8', $this->user, $this->pwd);
                $this->co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

    public function getCo()
    {
        return $this->co;
    }

    private function showColumnTable($table)
    {
        $sql = 'SHOW COLUMNS FROM '.$table;
        $query = $this->co->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function all($table)
    {
        try {
            $sql = 'SELECT * FROM '.$table;
            $select = $this->co->prepare($sql);
            $select->execute();
    
            return $select->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function one($table, $id)
    {
        $sql = 'SELECT * FROM '.$table.' WHERE id = ?';
        $select = $this->co->prepare($sql);
        $select->execute([$id]);

        return $select->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAll($table, $table_join = null, $table_parent = null, $id_join = null, $method = NULL)
    {
        $sql = 'SELECT '.$table.'.*';

        if($table_join){
            $sql .= ', count('.$table_join.'.id) nb FROM ' . $table . ' LEFT JOIN ' . $table_join . ' on ' .$table.'.id = ' . $table_join.'.'.$table;
        }elseif($table_parent){
            $sql .= ', '. $table_parent .'.nom '.$table_parent.' FROM ' . $table . ' LEFT JOIN ' . $table_parent . ' on ' .$table_parent.'.id = ' . $table.'.'.$table_parent;
        }

        if($id_join){
            $sql .= ' WHERE ' .$table_parent. '= ? GROUP BY '.$table.'.id';
        }else{
            $sql .= ' GROUP BY '.$table.'.id ORDER BY '.$table.'.id';
        }

        $select = $this->co->prepare($sql);
        $select->execute([($id_join) ? $id_join : null]);

        if($method){
            $result =  $select->fetchAll($method);
        }else{
            $result =  $select->fetchAll(PDO::FETCH_OBJ);
        }

        return $result;
    }

    public function add($table, $array)
    {
        $columns = $this->showColumnTable($table);

        try {
            $sql = 'INSERT INTO '.$table.'(';
            $value = ') VALUES(';
            foreach($columns as $column){
                if($column->Field != 'id'){
                    $sql .= $column->Field.',';
                    $value .= '?,';
                }
            }
            $sql = rtrim($sql, ',');
            $value = rtrim($value, ',');
            $sql .= $value.')';
            
            $select = $this->co->prepare($sql);
            $select->execute($array);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($table, $array)
    {
        $columns = $this->showColumnTable($table);

        try {
            $sql = 'UPDATE '.$table.' SET ';
            foreach($columns as $column){
                if($column->Field != 'id'){
                    $sql .= $column->Field.' = ?, ';
                }
            }
            $sql = rtrim($sql, ' ,');
            $sql .= ' WHERE id = ?';

            $select = $this->co->prepare($sql);
            $select->execute($array);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($table, $id)
    {
        try {
            $sql = 'DELETE FROM '.$table.' WHERE id = ?';
            $select = $this->co->prepare($sql);
            $select->execute([$id]);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
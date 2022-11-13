<?php

class CategorieManager extends BDD {

    public function findAll()
    {
        return parent::all('categorie');
    }

    public function findOneByID($id)
    {
        return parent::one('categorie', $id);
    }
    
    public function findOneByName($nom)
    {
        $sql = 'SELECT * FROM categorie WHERE nom = ?';
        $select = $this->co->prepare($sql);
        $select->execute([$nom]);

        return $select->fetchAll(PDO::FETCH_OBJ);
    }

    public function countByName($nom)
    {
        $sql = 'SELECT * FROM categorie WHERE nom = ?';
        $select = $this->co->prepare($sql);
        $select->execute([$nom]);

        return $select->rowCount();
    }

    public function addCategorie($array)
    {
        return parent::add('categorie', $array);
    }

    public function updateCategorie($array)
    {
        return parent::update('categorie', $array);
    }

    public function deleteCategorie($id)
    {
        return parent::delete('categorie', $id);
    }
}
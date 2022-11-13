<?php

class ProduitManager extends BDD {
    
    public function findAll()
    {
        return parent::all('produit');
    }

    public function findAllJoin()
    {
        return parent::getAll('produit', NULL, 'categorie');
    }

    public function findOneByID($id)
    {
        return parent::one('produit', $id);
    }

    public function findByCategorie($id)
    {
        try {
            $sql = 'SELECT produit.*, categorie.nom categorie FROM produit INNER JOIN categorie on produit.categorie = categorie.id where categorie = ?';
            $select = $this->co->prepare($sql);
            $select->execute([$id]);
    
            return $select->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function addProduit($array)
    {
        return parent::add('produit', $array);
    }

    public function updateProduit($array)
    {
        return parent::update('produit', $array);
    }

    public function deleteProduit($id)
    {
        return parent::delete('produit', $id);
    }
}
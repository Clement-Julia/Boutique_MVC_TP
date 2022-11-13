<?php

class UtilisateurManager extends BDD
{

    public function findAll()
    {
        return parent::all('utilisateur');
    }

    public function findAllJoin()
    {
        return parent::getAll('utilisateur', NULL, 'role');
    }

    public function findOneByID($id)
    {
        return parent::one('utilisateur', $id);
    }

    public function findOneByName($nom)
    {
        $sql = 'SELECT * FROM utilisateur WHERE pseudo = ?';
        $select = $this->co->prepare($sql);
        $select->execute([$nom]);

        return $select->fetchAll(PDO::FETCH_OBJ);
    }

    public function findExist($email, $id)
    {
        try{
            $sql = 'SELECT * FROM utilisateur WHERE email = ? and id != ?';
            $select = $this->co->prepare($sql);
            $select->execute([$email, $id]);
            
            return $select->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findOneByCondition($field, $value)
    {
        try{
            $sql = 'SELECT * FROM utilisateur WHERE '.$field.' = :v';
            $select = $this->co->prepare($sql);
            $select->execute(["v" => $value]);
            
            return $select->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRole()
    {
        try{
            $sql = 'SELECT * FROM role';
            $select = $this->co->prepare($sql);
            $select->execute();
            
            return $select->fetchAll(PDO::FETCH_OBJ);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function countByName($nom)
    {
        $sql = 'SELECT * FROM utilisateur WHERE nom = ?';
        $select = $this->co->prepare($sql);
        $select->execute([$nom]);

        return $select->rowCount();
    }

    public function addUtilisateur($array)
    {
        $sql = 'INSERT INTO utilisateur(pseudo, email, motdepasse, role) VALUES(:pseudo,:email,:mdp, 1)';
        $select = $this->co->prepare($sql);
        $select->execute($array);

        return true;
    }

    public function updateUtilisateur($array, $same)
    {
        $sql = 'update utilisateur set pseudo = :pseudo, email = :email, role = :role WHERE id = :id';
        if($same){
            $sql = 'update utilisateur set pseudo = :pseudo, role = :role WHERE id = :id';
        }
        $select = $this->co->prepare($sql);
        $select->execute($array);

        return true;
    }

    public function deleteUtilisateur($id)
    {
        return parent::delete('utilisateur', $id);
    }
}

<?php

class ProduitController extends ProduitManager{
    private $id;
    private $nom;

    public function getProduit()
    {
        ob_start();
        $model = $this->findAll();

        require 'views/produit/index.php';

        $page = ob_get_clean();
        
        return $page;
    }

    public function getProduitsByCategorie($id)
    {
        $produits = $this->findByCategorie($id);

        require 'views/produit/list_by_categorie.php';

        $vue = ob_get_clean();
        return $vue;
    }

    public function vueIndex($id = null)
    {
        ob_start();
        
        if($id){
            $produits = $this->findByCategorie($id);
        }else{
            $produits = $this->findAllJoin();
        }

        if(isset($_SESSION['user']->result)){
            $result = $_SESSION['user']->result;
            $message = $_SESSION['user']->message;
            Inventory::resetSessionParam();
        }

        $admin = false;
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            $admin = true;
        }


        require 'views/produit/index.php';
        $page = ob_get_clean();
        
        return $page;
    }

    public function vueAdd($array = null)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            ob_start();
            if($array){
                $result = $this->addProduit($array);
                if($result == true){
                    Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(4));
                    header('Location: index.php?page=produit');
                }else{
                    Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                    header('Location: index.php?page=produit');
                }
            }else{
                $Categorie = new CategorieManager();
                $categories = $Categorie->findAll();

                $result = 2;
                $message = '';

                require 'views/produit/add.php';
            }
            $page = ob_get_clean();
        }else{
            require 'views/components/error.php';
        }
        return $page;
    }

    public function vueUpdate($array = null, $id = null)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            ob_start();

            if($array){
                $result = $this->updateProduit($array);
                if($result){
                    Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(5));
                    header('Location: index.php?page=produit');
                }else{
                    Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                    header('Location: index.php?page=produit');
                }
            }else{
                $produit = $this->findOneByID($id);
                $produit = reset($produit);

                $Categorie = new CategorieManager();
                $categories = $Categorie->findAll();

                $result = 2;
                $message = '';

                require 'views/produit/edit.php';
            }
            $page = ob_get_clean();
        }else{
            require 'views/components/error.php';
        }
        return $page;
    }

    public function deleteOneProduit($id)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            $result = $this->deleteProduit($id);
            if($result){
                Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(6));
                header('Location: index.php?page=produit');
            }else{
                Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                header('Location: index.php?page=produit');
            }
        }else{
            require 'views/components/error.php';
        }
    }
}
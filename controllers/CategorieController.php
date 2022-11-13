<?php

use Inventory as Inventory;

class CategorieController extends CategorieManager
{
    private $id;
    private $nom;

    /**
     * Get the value of all categories
     */
    public function vueIndex()
    {
        ob_start();

        $categories = $this->findAll();

        $admin = false;
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            $admin = true;
        }

        $result = 2;
        $message = '';
        if(isset($_SESSION['user']->result)){
            $result = $_SESSION['user']->result;
            $message = $_SESSION['user']->message;
            Inventory::resetSessionParam();
        }
        
        require 'views/categorie/index.php';
        $page = ob_get_clean();

        return $page;
    }

    public function vueAdd($array = null)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            ob_start();
            if ($array) {
                $categories = $this->countByName(reset($array));
                if ($categories > 0) {
                    $result = 0;
                    $message = Inventory::getMessageFromError(7);
                    require 'views/categorie/add.php';
                } else {
                    $result = $this->addCategorie($array);
                    if ($result) {
                        header('Location: index.php?page=categorie&status=success');
                    } else {
                        header('Location: index.php?page=categorie&status=error');
                    }
                }
            } else {
                $result = 2;
                $message = '';
                require 'views/categorie/add.php';
            }
            $page = ob_get_clean();
        } else {
            require 'views/components/error.php';
        }
        return $page;
    }

    public function vueUpdate($array = null, $id = null)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            ob_start();
            if ($array) {
                $categorie = $this->countByName(reset($array));
                if ($categorie > 0) {
                    $categorie = $this->findOneByName(reset($array));
                    $categorie = reset($categorie);
                    $result = 0;
                    $message = Inventory::getMessageFromError(7);
                    require 'views/categorie/edit.php';
                } else {
                    $result = $this->updateCategorie($array);
                    if ($result) {
                        Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(2));
                        header('Location: index.php?page=categorie');
                    } else {
                        Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                        header('Location: index.php?page=categorie');
                    }
                }
            } else {
                $categorie = $this->findOneByID($id);
                $categorie = reset($categorie);
                
                $result = 2;
                $message = '';

                require 'views/categorie/edit.php';
            }
            $page = ob_get_clean();
        } else {
            require 'views/components/error.php';
        }

        return $page;
    }

    public function deleteOneCategorie($id)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            $result = $this->deleteCategorie($id);
            if ($result) {
                Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(3));
                header('Location: index.php?page=categorie');
            } else {
                Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                header('Location: index.php?page=categorie');
            }
        } else {
            require 'views/components/error.php';
        }
    }
}

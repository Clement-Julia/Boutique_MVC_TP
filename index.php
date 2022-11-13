<?php

require_once 'services/Autoload.php';
Autoload::load();
session_start();

require_once 'views/components/header.php';
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'categorie':
            $ctrl = new CategorieController();
            if (isset($_GET['view']) && !empty($_GET['view'])) {
                switch ($_GET['view']) {
                    case 'add':
                        echo $ctrl->vueAdd(array_values($_POST));
                        break;
                    case 'edit':
                        echo $ctrl->vueUpdate(array_values($_POST), ($_GET['id']) ? $_GET['id'] : null);
                        break;
                    case 'delete':
                        $ctrl->deleteOneCategorie((isset($_POST['id'])) ? $_POST['id'] : null);
                        break;
                    default:
                        echo $ctrl->vueIndex();
                        break;
                }
            } else {
                echo $ctrl->vueIndex();
            }
            break;
        case 'produit':
            $ctrl = new ProduitController();
            if (isset($_GET['view']) && !empty($_GET['view'])) {
                switch ($_GET['view']) {
                    case 'add':
                        echo $ctrl->vueAdd(array_values($_POST));
                        break;
                    case 'edit':
                        echo $ctrl->vueUpdate(array_values($_POST), ($_GET['id']) ? $_GET['id'] : null);
                        break;
                    case 'delete':
                        $ctrl->deleteOneProduit((isset($_POST['id'])) ? $_POST['id'] : null);
                        break;
                    default:
                        echo $ctrl->vueIndex((isset($_GET['categorie'])) ? $_GET['categorie'] : null);
                        break;
                }
            } else {
                echo $ctrl->vueIndex((isset($_GET['categorie'])) ? $_GET['categorie'] : null);
            }
            break;
        case 'utilisateur':
            $ctrl = new UtilisateurController();
            if (isset($_GET['view']) && !empty($_GET['view'])) {
                switch ($_GET['view']) {
                    case 'index':
                        echo $ctrl->vueIndex();
                        break;
                    case 'edit':
                        echo $ctrl->vueUpdate($_POST, ($_GET['id']) ? $_GET['id'] : null);
                        break;
                    case 'inscription':
                        echo $ctrl->vueInscription($_POST);
                        break;
                    case 'connexion':
                        echo $ctrl->vueConnexion($_POST);
                        break;
                    case 'deconnexion':
                        echo $ctrl->deconnexion();
                        break;
                        break;
                    case 'delete':
                        $ctrl->deleteOneUtilisateur((isset($_POST['id'])) ? $_POST['id'] : null);
                        break;
                    default:
                        require_once 'views/components/footer.php';
                        break;
                }
            } else {
                echo $ctrl->vueIndex();
                break;
            }
            break;
        case 'accueil':
            $ctrl = new DefaultController();
            echo $ctrl->vueIndex();
            break;
        default:
            require_once 'views/components/error.php';
            break;
    }
} else {
    $ctrl = new DefaultController();
    echo $ctrl->vueIndex();
}
require_once 'views/components/footer.php';
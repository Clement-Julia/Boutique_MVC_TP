<?php

use Inventory as Inventory;

class UtilisateurController extends UtilisateurManager
{
    private $id;
    private $pseudo;
    private $email;
    private $motdepasse;

    const User = 1;
    const Admin = 2;

    public function vueIndex()
    {
        ob_start();

        $utilisateurs = $this->findAllJoin();

        $result = 2;
        $message = '';
        if (isset($_SESSION['user']->result)) {
            $result = $_SESSION['user']->result;
            $message = $_SESSION['user']->message;
            Inventory::resetSessionParam();
        }

        require 'views/utilisateur/index.php';
        $page = ob_get_clean();

        return $page;
    }

    public function vueUpdate($array = null, $id = null)
    {
        ob_start();
        if ($array) {
            $user = $this->findExist($array["email"], $array["id"]);
            $user = reset($user);
            if ($user > 0) {
                $utilisateur = $this->findOneByID($array["id"]);
                $utilisateur = reset($utilisateur);
                $roles = $this->getRole();
                $result = 0;
                $message = Inventory::getMessageFromError(6);
                require 'views/utilisateur/edit.php';
            } else {
                $utilisateur = $this->findOneByID($array["id"]);
                $utilisateur = reset($utilisateur);
                $same = false;
                if ($utilisateur->email == $array["email"]) {
                    unset($array["email"]);
                    $same = true;
                }
                $result = $this->updateUtilisateur($array, $same);
                if ($result) {
                    Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(8));
                    header('Location: index.php?page=utilisateur');
                } else {
                    Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                    header('Location: index.php?page=utilisateur');
                }
            }
        } else {
            $utilisateur = $this->findOneByID($id);
            $utilisateur = reset($utilisateur);
            $roles = $this->getRole();

            $result = 2;
            $message = '';

            require 'views/utilisateur/edit.php';
        }
        $page = ob_get_clean();

        return $page;
    }

    public function vueInscription($array = null)
    {
        if (!isset($_SESSION['user']->id) || $_SESSION['user']->role == UtilisateurController::Admin) {
            ob_start();
            if ($array) {
                $user = $this->findOneByCondition('email', $array["email"]);
                $user = reset($user);
                if ($user) {
                    $result = 0;
                    $message = Inventory::getMessageFromError(5);
                    require 'views/utilisateur/inscription.php';
                } else {
                    $errMdp = Inventory::check_mdp_format($array["mdp"]);
                    if ($errMdp == 0) {
                        if ($array["mdp"] == $array["mdpVerif"]) {
                            $array["mdp"] = password_hash($array["mdp"], PASSWORD_BCRYPT);
                            unset($array["mdpVerif"]);
                            $result = $this->addUtilisateur($array);
                            if ($result) {
                                Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(7));
                                header('Location: index.php?page=utilisateur&view=connexion');
                            } else {
                                $result = 0;
                                $message = Inventory::getMessageFromError(0);
                                require 'views/utilisateur/inscription.php';
                            }
                        }else{
                            $result = 0;
                            $message = Inventory::getMessageFromError(2);
                            require 'views/utilisateur/inscription.php';
                        }
                    } else {
                        $result = 0;
                        $message = Inventory::getMessageFromError(1);
                        require 'views/utilisateur/inscription.php';
                    }
                }
            } else {
                $result = 2;
                $message = '';
                if (isset($_SESSION['user']->result)) {
                    $result = $_SESSION['user']->result;
                    $message = $_SESSION['user']->message;
                    Inventory::resetSessionParam();
                }
                require 'views/utilisateur/inscription.php';
            }
            $page = ob_get_clean();
            return $page;
        } else {
            Inventory::setSessionParam(0, Inventory::getMessageFromError(4));
            header('Location: index.php?page=categorie');
        }
    }

    public function vueConnexion($array = null)
    {
        if (!isset($_SESSION['user']->id)) {
            ob_start();
            if ($array) {
                $user = $this->findOneByCondition('email', $array["email"]);
                $user = reset($user);
                if (!$user) {
                    $result = 0;
                    $message = Inventory::getMessageFromError(6);
                    require 'views/utilisateur/connexion.php';
                } else {
                    if (password_verify($array["mdp"], $user->motdepasse)) {
                        $_SESSION["user"] = $user;
                        Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(0));
                        header('Location: index.php?page=categorie');
                    } else {
                        $result = 0;
                        $message = Inventory::getMessageFromError(3);
                        require 'views/utilisateur/connexion.php';
                    }
                }
            } else {
                $result = 2;
                $message = '';
                if (isset($_SESSION['user']->result)) {
                    $result = $_SESSION['user']->result;
                    $message = $_SESSION['user']->message;
                    Inventory::resetSessionParam();
                }
                require 'views/utilisateur/connexion.php';
            }
            $page = ob_get_clean();

            return $page;
        } else {
            Inventory::setSessionParam(0, Inventory::getMessageFromError(4));
            header('Location: index.php?page=categorie');
        }
    }

    public function deconnexion()
    {
        session_destroy();
        session_start();
        $_SESSION['user'] = new stdClass();
        Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(0));
        header('Location: ?page=utilisateur&view=connexion');
    }

    public function deleteOneUtilisateur($id)
    {
        if (!empty($_SESSION["user"]->role) && $_SESSION["user"]->role == UtilisateurController::Admin) {
            $result = $this->deleteUtilisateur($id);
            if ($result) {
                Inventory::setSessionParam(1, Inventory::getMessageFromSuccess(9));
                header('Location: index.php?page=utilisateur');
            } else {
                Inventory::setSessionParam(0, Inventory::getMessageFromError(0));
                header('Location: index.php?page=utilisateur');
            }
        } else {
            ob_start();
            require 'views/components/error.php';
            $page = ob_get_clean();
            return $page;
        }
    }
}

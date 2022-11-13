<?php

trait Inventory {

    static public function setSessionParam($result, $message)
    {
        $_SESSION['user']->result = $result;
        $_SESSION['user']->message = $message;
    }

    static public function resetSessionParam()
    {
        unset($_SESSION['user']->result);
        unset($_SESSION['user']->message);
    }

    static public function dd($var)
    {
        var_dump($var);
        die;
    }

    static public function check_mdp_format($mdp){
        $erreursMdp = [];
        $minuscule = preg_match("/[a-z]/", $mdp);
        $majuscule = preg_match("/[A-Z]/", $mdp);
        $chiffre = preg_match("/[0-9]/", $mdp);
        $caractereSpecial = preg_match("/[^a-zA-Z0-9]/", $mdp);
        $str = strlen($mdp);
    
        if(!$minuscule){
            $erreursMdp[] = 4;
        }
        if(!$majuscule){
            $erreursMdp[] = 5;
        }
        if(!$chiffre){
            $erreursMdp[] = 6;
        }
        if(!$caractereSpecial){
            $erreursMdp[] = 7;
        }
        if($str < 8){
            $erreursMdp[] = 8;
        }
    
        return $erreursMdp;
    }

    static public function getMessageFromSuccess($successID)
    {
        $messages = [
            0 => "Succès",
            1 => "La catégorie a bien été rajoutée",
            2 => "La catégorie a bien été modifiée",
            3 => "La catégorie a bien été supprimée",
            4 => "Le produit a bien été rajouté",
            5 => "Le produit a bien été modifié",
            6 => "Le produit a bien été supprimé",
            7 => "L'utilisateur a bien été créé",
            8 => "L'utilisateur a bien été modifié",
            9 => "L'utilisateur a bien été supprimé"
        ];

        return $messages[$successID];
    }

    static public function getMessageFromError($errorID)
    {
        $messages = [
            0 => "Une erreur est survenue",
            1 => "Le mot de passe n'est pas conforme au format demandé",
            2 => "Les deux mots de passe ne sont pas identique",
            3 => "Les identifiants de connexion ne sont pas valides",
            4 => "Vous être déjà connecté",
            5 => "Cet utilisateur existe déjà !",
            6 => "Cet utilisateur n'existe pas !",
            7 => "Cette catégorie existe déjà !"
        ];

        return $messages[$errorID];
    }
}
<?php

use Inventory as Inventory;

class DefaultController {
    
    public function vueIndex()
    {
        ob_start();
        
        require 'views/accueil/index.php';
        $page = ob_get_clean();

        return $page;
    }

}
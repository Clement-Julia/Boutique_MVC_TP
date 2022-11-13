<?php
/*
if(!empty($_SESSION["try"]) && $_SESSION["try"]["essai"] != 3){
    $now = new DateTime('NOW');
    if($now->diff($_SESSION["try"]["last-try"])->i >= 10){
        $_SESSION["try"]["essai"]++;
    }
};

if(!empty($_GET["erreur"]) && $_GET["erreur"] == "login" || !empty($_GET["erreur"]) && $_GET["erreur"] == "login2"){
    ?>
    <div class="container alert alert-warning mt-2">
        L'email ou le mot de passe est incorrect
    </div>
    <?php
}
if(!empty($_GET["erreur"]) && $_GET["erreur"] == "unauthorize"){
    ?>
    <div class="container alert alert-warning mt-2">
        L'adresse IP de ce compte n'est pas connue, veuillez contacter un administrateur de la base de données.
    </div>
    <?php
}
if(!empty($_GET["erreur"]) && $_GET["erreur"] == "exceed"){
    ?>
    <div class="container alert alert-warning mt-2">
        Nombre de tentative dépassée<br>
        Réessayez dans 10 minutes
    </div>
    <?php
}
*/
?>
<link rel="stylesheet" href="assets/css/connexion.css">
<div class="container mt-5 d-flex flex-column align-items-center">
    <h1>Connexion</h1>
    <form method="POST" class="needs-validation form-control-spe" novalidate>

        <div class="form-group my-4">
            <input type="email" class="form-input <?=(!empty($_GET["erreur"]) && ($_GET["erreur"] == "all" || $_GET["erreur"] == "login")) ? "is-invalid" : ""?>" name="email" id="email" placeholder="Email">

            <div class="valid-feedback">Ok !</div>
            <div class="invalid-feedback">Email invalide</div>
        </div>

        <div class="form-group my-4">
            <input type="password" class="form-input <?=(!empty($_GET["erreur"]) && ($_GET["erreur"] == "all" || $_GET["erreur"] == "login")) ? "is-invalid" : ""?>" name="mdp" id="mdp" placeholder="Mot-de-passe">

            <div class="valid-feedback">Ok !</div>
            <div class="invalid-feedback">Mot-de-passe invalide</div>
        </div>

        <div class="form-group text-center mt-4">
            <button type="submit" class="btn form-btn return">Connexion</button>
        </div>
    </form>
</div>

<script>

    document.addEventListener("DOMContentLoaded", function (){
        setTimeout(() =>{
            document.getElementById("mdp").value = "";
            document.getElementById("email").value = "";
        }, 550);

        var result = <?= $result ?>;
        if (result != 2) {
            <?= (isset($message)) ? 'var message ="'.$message.'"' : '' ?>;
            if (result == true) {
                toastr.success(message);
            }else if(result == false){
                toastr.error(message)
            }
        };
    });


</script>
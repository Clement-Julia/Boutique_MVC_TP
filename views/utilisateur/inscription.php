<link rel="stylesheet" href="assets/css/inscription.css">

<div class="container mt-3 d-flex flex-column align-items-center" id="container">
    <h1>Inscription :</h1>
    <form method="POST" class="needs-validation" novalidate>

        <div class="form-group my-3">
            <input type="text" class="form-input <?= (!empty($_GET["erreur"]) && ($_GET["erreur"] == "all" || $_GET["erreur"] == "mdp")) ? "is-invalid" : "" ?>"" name="pseudo" id="pseudo" placeholder="Pseudo" value="" required>

            <div class="valid-feedback">Ok !</div>
            <div class="invalid-feedback">Nom incorrect</div>
        </div>

        <div class="form-group my-3">
            <input type="password" class="form-input <?= (!empty($_GET["erreur"]) && ($_GET["erreur"] == "all" || $_GET["erreur"] == "mdp")) ? "is-invalid" : "" ?>" name="mdp" id="mdp" placeholder="Mot de passe" required>
            <button type="button" class="popup-info errspan text-white" data-bs-toggle="tooltip" data-bs-html="true" title="<u>Doit contenir</u> :<br>-12 caractères<br>-Une majuscule<br>-Une minuscule<br>-Un chiffre<br>-Un caractère spécial">
                <i class="bi bi-info-circle"></i>
            </button>

            <div class="valid-feedback">Ok !</div>
            <div class="invalid-feedback">Votre mot-de-passe ne remplit pas les conditions</div>
        </div>

        <div class="form-group my-3">
            <input type="password" class="form-input <?= (!empty($_GET["erreur"]) && $_GET["erreur"] == "all") ? "is-invalid" : "" ?>" name="mdpVerif" id="mdpVerif" placeholder="Vérification du mot de passe" required>

            <div class="valid-feedback">Ok !</div>
            <div class="invalid-feedback">Les mots-de-passe ne sont pas similaire</div>
        </div>

        <div class="form-group my-3">
            <input type="email" class="form-input <?= (!empty($_GET["erreur"]) && ($_GET["erreur"] == "all" || $_GET["erreur"] == "email")) ? "is-invalid" : "" ?>" name="email" id="email" placeholder="Email" required>

            <div class="valid-feedback">Ok !</div>
            <?= (!empty($_GET["erreur"]) && $_GET["erreur"] == "email") ? "<div class='invalid-feedback'>Cet email existe déjà</div>" : "<div class='invalid-feedback'>Email incorrect</div>" ?>
        </div>

        <div class="form-group mt-4 row justify-content-center">
            <button type="submit" class="btn form-btn return col-8">Inscription</button>
        </div>

    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        setTimeout(() => {
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
    })
</script>

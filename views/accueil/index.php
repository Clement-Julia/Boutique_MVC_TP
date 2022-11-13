<?php if (empty($_SESSION["user"]->role)) { ?>
    <div class="d-flex justify-content-center">
        <div class="card text-bg-dark mb-3" style="max-width: 20rem;">
            <div class="card-header h3">Accueil</div>
            <div class="card-body">
                <h5 class="card-title">Connectez-vous pour avoir accès au site dans son entièreté.</h5>
                <p class="card-text">
                    <a class="btn btn-outline-success" href="?page=utilisateur&view=inscription">S'inscrire</a>
                    <a class="btn btn-outline-primary" href="?page=utilisateur&view=connexion">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="d-flex justify-content-center">
        <div class="card text-bg-dark mb-3" style="max-width: 25rem;">
            <div class="card-header h3">Accueil</div>
            <div class="card-body">
                <h5 class="card-title mb-5">Profitez bien du site !</h5>
                <p class="card-text">
                    <a class="btn btn-outline-secondary" href="?page=categorie">Toutes les catégories</a>
                    <a class="btn btn-outline-light" href="?page=produit">Tous les produits</a>
                </p>
            </div>
        </div>
    </div>
<?php } ?>
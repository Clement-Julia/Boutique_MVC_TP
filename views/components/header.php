<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/toastr.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Boutique</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=accueil">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (!empty($_SESSION["user"]->role)) {
                        if ($_SESSION["user"]->role == UtilisateurController::Admin) { ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Catégorie
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?page=categorie">Liste des catégories</a></li>
                                    <li><a class="dropdown-item" href="?page=categorie&view=add">Ajouter une catégorie</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Produit
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?page=produit">Liste des produits</a></li>
                                    <li><a class="dropdown-item" href="?page=produit&view=add">Ajouter un Produit</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Utilisateur
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="?page=utilisateur">Liste des utilisateurs</a></li>
                                    <li><a class="dropdown-item" href="?page=utilisateur&view=inscription">Ajouter un utilisateur</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="?page=categorie">Catégorie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?page=produit">Produit</a>
                            </li>
                    <?php }
                    } ?>
                </ul>
                <ul class="navbar-nav d-flex align-items-center">
                    <?php if (empty($_SESSION["user"]->id)) { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="?page=utilisateur&view=inscription">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="?page=utilisateur&view=connexion">Connexion</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item me-3">
                            <span class="nav-link"><?= $_SESSION["user"]->pseudo ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger" aria-current="page" href="?page=utilisateur&view=deconnexion">Déconnexion</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
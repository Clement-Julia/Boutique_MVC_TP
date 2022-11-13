<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Marque</th>
                <?php if ($admin) { ?>
                    <th scope="col">Action</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($produits as $produit) {
            ?>
                <tr>
                    <th scope="row"><?= $produit->id ?></th>
                    <td scope="row"><?= $produit->nom ?></td>
                    <td scope="row"><?= $produit->prix ?>€</td>
                    <td scope="row"><?= $produit->categorie ?></td>
                    <?php if ($admin) { ?>
                        <td scope="row">
                            <a href="?page=produit&view=edit&id=<?= $produit->id ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal<?= $produit->id ?>"><i class="bi bi-trash"></i></button>
                        </td>
                    <?php } ?>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
if ($admin) {
    foreach ($produits as $produit) {
?>
        <div id="myModal<?= $produit->id ?>" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column">
                        <div class="icon-box">
                            <i class="bi bi-x-lg"></i>
                        </div>
                        <h4 class="modal-title w-100">Êtes-vous sûr ?</h4>
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Vous êtes sur le point de supprimer définitivement un modèle.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                        <form method="post" action="?page=produit&view=delete">
                            <input type="hidden" name="id" value="<?= $produit->id ?>">
                            <button type="submit" class="btn btn-danger btn-sm" name="method" value="delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>

<script>
    window.addEventListener('load', function() {
        var result = <?= $result ?>;
        if (result != 2) {
            <?= (isset($message)) ? 'var message ="' . $message . '"' : '' ?>;
            if (result == true) {
                toastr.success(message);
            } else if (result == false) {
                toastr.error(message)
            }
        };
    })
</script>
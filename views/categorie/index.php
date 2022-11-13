<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <?php if ($admin) : ?>
                    <th scope="col">Action</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $categorie) {
            ?>
                <tr>
                    <th scope="row"><?= $categorie->id ?></th>
                    <td scope="row"><a href="?page=produit&categorie=<?= $categorie->id ?>" class="btn"><?= $categorie->nom ?></a></td>

                    <?php if ($admin) { ?>
                        <td scope="row">
                            <a href="?page=categorie&view=edit&id=<?= $categorie->id ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal<?= $categorie->id ?>"><i class="bi bi-trash"></i></button>
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
    foreach ($categories as $categorie) {
        ?>
        <div id="myModal<?= $categorie->id ?>" class="modal fade">
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
                        <p>Vous êtes sur le point de supprimer définitivement une categorie.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                        <form method="post" action="?page=categorie&view=delete">
                            <input type="hidden" name="id" value="<?= $categorie->id ?>">
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
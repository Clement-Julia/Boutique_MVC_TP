<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($utilisateurs as $utilisateur) {
            ?>
                <tr>
                    <th scope="row"><?= $utilisateur->id ?></th>
                    <td scope="row"><?= $utilisateur->pseudo ?></td>
                    <td scope="row"><?= $utilisateur->email ?></td>
                    <td scope="row"><?= $utilisateur->role ?></td>
                    <td scope="row">
                        <a href="?page=utilisateur&view=edit&id=<?= $utilisateur->id ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal<?= $utilisateur->id ?>"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
foreach ($utilisateurs as $utilisateur) {
?>
    <div id="myModal<?= $utilisateur->id ?>" class="modal fade">
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
                    <p>Vous êtes sur le point de supprimer définitivement un utilisateur.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                    <form method="post" action="?page=utilisateur&view=delete">
                        <input type="hidden" name="id" value="<?= $utilisateur->id ?>">
                        <button type="submit" class="btn btn-danger btn-sm" name="method" value="delete">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
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
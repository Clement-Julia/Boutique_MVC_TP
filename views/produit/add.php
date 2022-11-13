<form class="row g-3 needs-validation d-flex justify-content-center mb-3" method="POST" novalidate>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Rentrer un nom valide..." required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Description du produit</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Rentrer une description valide..."></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix du produit</label>
            <input type="number" class="form-control" id="prix" name="prix" placeholder="Rentrer un prix valide..." required>
        </div>
        <div class="mb-3">
            <label for="qte" class="form-label">Quantité du produit</label>
            <input type="number" class="form-control" id="qte" name="qte" placeholder="Rentrer une quantité valide..." required>
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie du produit</label>
            <select name="categorie" id="categorie" class="form-control">
                <?php
                    foreach($categories as $categorie){
                        ?>
                            <option value="<?= $categorie->id ?>"><?= $categorie->nom ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div class="valid-feedback">
            ok!
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Ajouter</button>
    </div>
</form>

<script type="text/javascript">
    window.addEventListener('load', function() {
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
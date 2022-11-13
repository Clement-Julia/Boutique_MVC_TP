<form class="row g-3 needs-validation" method="POST" novalidate>
  <div class="col-md-4">
    <label for="nom" class="form-label">Nom de la categorie</label>
    <input type="text" class="form-control" id="nom" name="nom" placeholder="Rentrer un nom valide..." required>
    <div class="valid-feedback">
      ok!
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Ajouter</button>
  </div>
</form>

<script type="text/javascript">
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
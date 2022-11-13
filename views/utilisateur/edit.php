<form class="row g-3 needs-validation d-flex justify-content-center mb-3" method="POST" novalidate>
  <div class="col-md-4">
    <div class="mb-3">
      <label for="pseudo" class="form-label">Nom de l'utilisateur</label>
      <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Rentrer un nom valide..." value="<?= $utilisateur->pseudo ?>" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email de l'utilisateur</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Rentrer un email valide..." value="<?= $utilisateur->email ?>" required>
    </div>
    <div class="mb-3">
      <label for="role" class="form-label">Role de l'utilisateur</label>
      <select name="role" id="role" class="form-control">
        <?php
        foreach ($roles as $role) {
        ?>
          <option value="<?= $role->id ?>" <?= ($role->id == $utilisateur->role) ? "selected" : "" ?>><?= $role->nom ?></option>
        <?php
        }
        ?>
      </select>
    </div>
    <input type="hidden" name="id" value="<?= $utilisateur->id ?>">
    <div class="valid-feedback">
      ok!
    </div>
  </div>
  <div class="col-12 d-flex justify-content-center">
    <button class="btn btn-warning" type="submit">Modifier</button>
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
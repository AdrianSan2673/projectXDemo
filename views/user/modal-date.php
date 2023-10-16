<div class="modal fade"  id="modal-date">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" id="dias-inhabiles-form">
      <div class="modal-header">
        <h5 class="modal-title">Dia festivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="date" class="form-control" name="date" id="date" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
</form>
  </div>
</div>
<script src="<?= base_url ?>app/diasfestivos.js?v=<?= rand() ?>"></script>


<script>
let festivos = new Diasfestivos();
document.querySelector('#modal-date').addEventListener('submit', e => {
  e.preventDefault();
  festivos.save();
});
</script>

<div class="modal fade" id="modal_soi">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Certificar SOI</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="Estatus">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-success" value="Enviar">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('#soi-card .btn-warning').addEventListener('click', e => {
        e.preventDefault();
        document.querySelectorAll('#modal_soi input')[0].value = folio;
        document.querySelectorAll('#modal_soi input')[1].value = 1;
        document.querySelector('#modal_soi p').textContent = '¿Estás segura de que deseas autorizar el certificado SOI?';
        document.querySelector('#modal_soi .modal-header').classList.add('bg-success');
        $('#modal_soi').modal({backdrop: 'static', keyboard: false});
    })
    document.querySelector('#soi-card .btn-danger').addEventListener('click', e => {
        e.preventDefault();
        document.querySelectorAll('#modal_soi input')[0].value = folio;
        document.querySelectorAll('#modal_soi input')[1].value = 0;
        document.querySelector('#modal_soi p').textContent = '¿Estás segura de que deseas denegar el certificado SOI?';
        document.querySelector('#modal_soi .modal-header').classList.add('bg-danger');
        $('#modal_soi').modal({backdrop: 'static', keyboard: false});
    })
</script>
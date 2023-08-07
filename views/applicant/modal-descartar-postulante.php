<div class="modal fade" id="modal_descartar_postulante">
    <div class="modal-dialog  modal-lg" style="max-width:  600px!important;">
        <div class="modal-content">
            <form method="post" id="descartar-postulante-form">
                <div class="modal-header">
                    <h4 class="modal-title" id="titulo" >   </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Por favor, escribe el motivo del rechazo:</label>
                        <textarea type="text" class="form-control" rows="7" id="comments_modal" name="comments_modal" required> </textarea>
                    </div>
                </div>

                <input type="hidden" id="id_candidate_modal" name="id_candidate_modal" >
                <input type="hidden" id="id_vacancy_modal" name="id_vacancy_modal" >
                <input type="hidden" id="id_status_modal" name="id_status_modal" >
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Descartar">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.querySelector('#descartar-postulante-form').addEventListener('submit', e => {
        e.preventDefault();
        let candidate = new Candidate();
        candidate.descartar();
    });
</script>
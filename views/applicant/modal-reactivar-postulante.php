<div class="modal fade" id="modal_reactivar_postulante">
    <div class="modal-dialog  modal-xl" style="max-width:  600px!important;">
        <div class="modal-content">
            <form method="post" id="reactivar-postulante-form">
                <div class="modal-header">
                    <h4 class="modal-title"  > Reactivar  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <label >¿Desea reactivar al postulante:<span class="text-bold h6">  <label id="nombre_reactivar"> </label></span>?</label>                  
                </div>

                <input type="hidden" id="id_candidate_reactivar" name="id_candidate_reactivar" >
                <input type="hidden" id="id_vacancy_reactivar" name="id_vacancy_reactivar" >
                <input type="hidden" id="id_status_reactivar" name="id_status_reactivar" >
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="reactivar">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.querySelector('#reactivar-postulante-form').addEventListener('submit', e => {
        e.preventDefault();
        let candidate = new Candidate();
        candidate.reactivar();
    });
</script>
<div class="modal fade" id="modal_eliminar_postulante">
    <div class="modal-dialog  modal-xl" style="max-width:  600px!important;">
        <div class="modal-content">
            <form method="post" id="eliminar-postulante-form">
                <div class="modal-header">
                    <h4 class="modal-title"  > Eliminar Postulante  </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <label >¿Desea ELIMINAR al postulante:<font size="2" color="black" >  <label id="nombre_eliminar"> </label></font>?</label>                  
                </div>

                <input type="hidden" id="id_candidate_eliminar" name="id_candidate_eliminar" >
                <input type="hidden" id="id_vacancy_eliminar" name="id_vacancy_eliminar" >
                <input type="hidden" id="id_status_eliminar" name="id_status_eliminar" >
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="eliminar">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.querySelector('#eliminar-postulante-form').addEventListener('submit', e => {
        e.preventDefault();
        let candidate = new Candidate();
        candidate.eliminar();
    });
</script>
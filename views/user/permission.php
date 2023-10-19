<div class="modal fade" id="modal_permission">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Permisos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_user" id="id_user">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre">Nombre</label>
                        <input type="text" name="title" id="Nombre" class="form-control" maxlength="250" value="" required readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Puesto">Puesto</label>
                        <input type="text" name="title" id="Puesto" class="form-control" maxlength="250" value="" required readonly>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sección</th>
                                <!-- <th>Control total</th> -->
                                <th scope="col">Crear</th>
                                <th scope="col">Ver</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Borrar</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('#modal_permission table tbody').addEventListener('change', e => {
        if (e.target.checked) {
            console.log(e.target);
        }
    })
    document.querySelector('#modal_permission').addEventListener('submit', e => {
        e.preventDefault();
        var form = document.querySelector("#modal_permission form");
		var formData = new FormData(form);
        //form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Usuario/updatePermissions');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                  	if (json_app.status == 1) {
						utils.showToast('Permisos actualizados exitosamente', 'success');
						$('#modal_permission').modal('hide');
					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					}
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
    })

</script>
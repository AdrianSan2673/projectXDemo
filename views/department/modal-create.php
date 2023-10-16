<div class="modal fade" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo Departamento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="department">Nombre del Departamento</label>
                        <input type="text" class="form-control" name="department" id="department" maxlength="100">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    window.onload = function() {
        document.querySelector('#btn_new_department').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_create form').reset();
            $('#modal_create').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        document.querySelector('#modal_create form').onsubmit = function(e) {
            e.preventDefault();


            var form = document.querySelector("#modal_create form");
            var formData = new FormData(form);
            form.querySelectorAll('.btn')[1].disabled = true;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../departamento/save');
            xhr.send(formData);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        if (r == 0) {
                            utils.showToast('Omitiste algún dato', 'warning');
                        } else {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 2) {
                                utils.showToast('Hubo un error al guardar, intenta de nuevo.', 'error');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            } else if (json_app.status == 1) {
                                form.querySelectorAll('.btn')[1].disabled = true;
                                let departamentos = '';
                                json_app.departamentos.forEach(element => {
                                    departamentos += `
                                    <div class="col-md-4 ">
                                      <div class="small-box bg-info">
                                        <button class="btn text-white btn-delete" value="${element.id}" ${element.no_employees==0||element.no_positions==0?'':'hidden'}>X</button>
                                        <div class="inner">
                                          <h4>${element.department}</h4>
                                          <div class="row">
                                            <div class="col-6">
                                              <p style="font-size: small;">${element.no_employees} empleados</p>
                                            </div>
                                            <div class="col-6">
                                              <p style="font-size: small;">${element.no_positions} puestos</p>
                                            </div>
                                          </div>
                                        </div>
                                        <a class="small-box-footer" href="${element.modified_at}">
                                          Ver
                                          <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                      </div>
                                    </div>
                                    `
                                });
                                document.querySelector('#all_departments').innerHTML = departamentos;
                                utils.showToast('Se agregó el departamento', 'success');
                                $('#modal_create').modal('hide');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            } else {
                                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            }
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }

                }
            }
        }

    }
</script>
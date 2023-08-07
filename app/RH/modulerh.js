class ModuleRH {

    save() {
        const form = document.querySelector("#modal_RH form");
        const submitBtn = form.querySelector('[name="submit"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../RecursosHumanos/save', {
                method: 'POST',
                /* headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                }, */
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                console.log(r);
                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        utils.showToast('Se activo con exito', 'success');

                        let clientes = '';
                        json_app.clientes.forEach(element => {

                            clientes += `
                          <tr>
                                  <td class="text-left align-middle" ${element.hidden}> ${element.Id_cliente} </td> 
                                  <td class="text-left align-middle" ${element.hidden}>${element.ID_Empresa}</td>
                                  <td>${element.Fecha_Registro}</td>
                                  <td class="text-left align-middle">${element.Empresa}</td>
                                  <td class="text-left align-middle ">${element.Nombre_Cliente}</td>
                                  <td class="text-center align-middle">${element.Centro_Costos}</td>
                                  <td class="text-center align-middle">${element.Servicios}</td>
                                  <td class="text-center align-middle">${element.Paquete==''  || element.Paquete==null? 'Sin paquete':element.Paquete}</td>
                                  <td class="text-center align-middle">${element.Modulo_RH==0?'<small class="badge badge-danger"><i class="fas fa-times-circle"></i>Desactivado</small>':'<small class="badge badge-success"><i class="fas fa-check-circle"></i>Activo</small>'}</td>
                                  <td class="text-center align-middle">${element.Fecha_cancelacion== '' ? 'Sin cancelacion' : element.Fecha_cancelacion}</td>
          
                                  <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm" >
                                      <a href="${element.url}" class="btn btn-success mr-1">
                                        <i class="fas fa-eye"></i> Ver
                                      </a>
                                      <button class="btn btn-orange" value="${element.Cliente}">
                                        <i class="fas fa-users-cog"></i>
                                      </button>
                                      <button class="btn btn-secondary" value="${element.Cliente}">
                                      <i class="fas fa-user-alt-slash"></i>
                                    </button>
                                    </div>
                                  </td>
                          </tr>
                                    `
                        });

                        document.querySelector('#tb_customers tbody').innerHTML = clientes;
                        submitBtn.disabled = false;
                        $('#modal_RH').modal('hide');
                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 3) {
                        utils.showToast('No tienes permiso para registrar', 'error');
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                submitBtn.disabled = false;
            });
    }



}
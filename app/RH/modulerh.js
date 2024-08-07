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
                // try {
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
                                  <td class="text-center align-middle">${element.Paquete == '' || element.Paquete == null ? 'Sin paquete' : element.Paquete}</td>
                                  <td class="text-center align-middle">${element.Modulo_RH == 0 ? '<small class="badge badge-danger"><i class="fas fa-times-circle"></i>Desactivado</small>' : '<small class="badge badge-success"><i class="fas fa-check-circle"></i>Activo</small>'}</td>
                                  <td class="text-center align-middle">${element.Fecha_cancelacion == '' ? 'Sin cancelacion' : element.Fecha_cancelacion}</td>
          
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
                // } catch (error) {
                //     utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                //     submitBtn.disabled = false;
                // }
            })
        // .catch(error => {
        //     utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
        //     submitBtn.disabled = false;
        // });
    }


    save_type() {
        const form = document.querySelector("#add-type-form");
        const submitBtn = form.querySelector('[name="guardar"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../ConfiguracionesRH/save_type', {
            method: 'POST',
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


                        let types = '';
                        var cont = json_app.types.length;
                        json_app.types.forEach(type => {

                            types += `
                            <tr>
                            <td class="text-center align-middle"><b>${cont}</b></td>
                            <td class="text-center align-middle">${type.name}</td>

                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a data-id="${type.id}" data-type='${type.name}' class="btn btn-success btn-sm mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-1" data-type='${type.name}' data-id="${type.id}">
                                        <i class="fas  fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                                    `
                            cont--;
                        });
                        document.querySelector('#add-type-form #type').value = '';
                        document.querySelector('#add-type-form #flag').value = 1;
                        utils.showToast('Información guardada correctamente', 'success');
                        document.querySelector('#table_types tbody').innerHTML = types;
                        submitBtn.disabled = false;
                        $('#modal-add-type').modal('hide');
                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');
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

    delete_type(id_type) {


        const formData = new FormData();
        formData.append('id_type', id_type);


        fetch('../ConfiguracionesRH/delete_type', {
            method: 'POST',
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
                    } else if (json_app.status === 1) {


                        let types = '';
                        var cont = json_app.types.length;
                        json_app.types.forEach(type => {

                            types += `
                            <tr>
                            <td class="text-center align-middle"><b>${cont}</b></td>
                            <td class="text-center align-middle">${type.name}</td>

                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a data-id="${type.id}" data-type='${type.name}' class="btn btn-success btn-sm mr-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-1" data-type='${type.name}' data-id="${type.id}">
                                        <i class="fas  fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                                    `
                            cont--;
                        });

                        utils.showToast('Tipo eliminado correctamente', 'success');
                        document.querySelector('#table_types tbody').innerHTML = types;

                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                submitBtn.disabled = false;
            });
    }




    //gabo 23 oct
    save_template() {
        const form = document.querySelector("#add-template-form");
        const submitBtn = form.querySelector('[name="guardar"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../ConfiguracionesRH/save_template', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //   console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app.templates);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        utils.showToast('Plantilla creada correctamente', 'success');
                        submitBtn.disabled = false;
                        this.format_templates(json_app);
                        $('#modal-add-template').modal('hide');


                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');
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


    //gabo 13 oct



    save_holiday() {
        const form = document.querySelector("#add-holiday-form");
        const submitBtn = form.querySelector('[name="guardar"]');
        // submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../ConfiguracionesRH/save_holiday', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        utils.showToast('Fecha creada correctamente', 'success');

                        this.format_holidays(json_app);

                        submitBtn.disabled = false;
                        form.reset()
                        $('#modal-add-holiday').modal('hide');

                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 3) {
                        utils.showToast('No se puede agregar por que ya se realizó una solicitud con esta plantilla', 'error');
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






    activate_template(id_template) {

        const formData = new FormData();
        formData.append('id_template', id_template);

        fetch('../ConfiguracionesRH/activate_template', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');

                    } else if (json_app.status === 1) {
                        utils.showToast('Plantilla activada correctamente', 'success');

                        this.format_templates(json_app);

                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');

                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

            });



    }


    format_templates(json_app) {

        console.log(json_app);
        var cont = json_app.templates.length;
        let templates = '';
        json_app.templates.forEach(template => {
            let color = template.status != 1 ? 'card-secondary' : 'card-success';
            let usado = template.usado != 0 || template.status == 1 ? 'disabled' : '';
            let title = template.usado != 0 ? 'No puedes realizar esta acción, ya  existen solicitudes registradas con esta plantilla' : '';


            templates += `
       
        <div class="col-md-12">
        <div class="card ${color} collapsed-card">
            <div class="card-header">
                <h3 class="card-title">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">${template.name} </font>
                    </font>
                </h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool delete-template"
                data-id="${template.id_encrypted}"><i
                    data-id="${template.id_encrypted}"
                    class="fas fa-trash delete-template "></i>
            </button>
                    <button type="button" class="btn btn-tool"  data-card-widget="collapse"><i
                            class="fas fa-plus"></i>
                    </button>
                </div>

            </div>

            <div class="card-body">
                <div class="table-respsonsive" style="width: 100%;">
                <section class="content-header">
                <div class="row" style="justify-content:right">

                    <div class="col-sm-3" style="justify-content:right;text-align:right">
                        <button title="${title}" id='' ${usado} class="btn btn-warning agregar" data-toggle="modal"
                            data-id="${template.id_encrypted}"> 
                            Agregar dia </button>
                    </div>

                </div>
            </section>
              
                    <table id="table_holidays${template.id}"
                        class="table table-responsive-lg table-striped  table-condensed">
                        <thead>
                            <tr>
                            <th class="text-center" style="width: 20%;">#</th>
                            <th class="text-center" style="width: 30%;">Nombre</th>
                            <th class="text-center" style="width: 30%;">Fecha</th>
                            <th class="text-center" style="width: 20%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody> `;

            let fechas = '';
            let cont = 1;
            json_app.dates.forEach(date => {


                if (date.id_template == template.id) {
                    templates += `   <tr>
                 
                            <td class="text-center align-middle"><b>${cont}</b>
                            </td>
                            <td class="text-center align-middle">
                               ${date.name}</td>
                            <td class="text-center align-middle">
                            ${date.day} de ${date.converted_month}</td>
                            <td class="text-center py-0 align-middle">
                            <div class="btn-group btn-group-sm  " >
                                <button title="${title}" data-id="${date.id_encrypted}" ${usado}  data-id_template="${template.id_encrypted}" data-name="${date.name}" data-month="${date.month}" data-day="${date.day}"  class="btn btn-success btn-sm mr-1 editar ">
                                <i class="fas fa-edit  "></i>
                            </button>
                            <button title="${title}" class="btn btn-danger btn-sm mr-1 borrar" ${usado} data-id="${date.id_encrypted}" data-id_template="${template.id_encrypted}" data-name="${date.name}">
                                <i class="fas  fa-trash  "></i>
                            </button>
</div>


                            </td>
                        </tr>`;
                    cont++;
                }
            })



            templates += `    </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center" style="width: 60%;">fecha</th>
                                <th class="text-center">Acciones</th>

                            </tr>
                        </tfoot>
                    </table>`;

            let disabled = 'disabled';
            if (template.status != 1 && cont > 1) {
                disabled = '';
            }
            templates += ` <section class="content-header">
                        <div class="row" style="justify-content:center">

                            <div class="col-sm-3" style="justify-content:center;text-align:center">
                                <button ${disabled} id='activar${template.id}' class="btn btn-success activar" data-toggle="modal"
                                    data-id="${template.id_encrypted}">
                                    Activar plantilla</button>
                            </div>

                        </div>
                    </section> `;



            templates += ` 
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
                `;

        })

        document.querySelector('#div_table_templates').innerHTML = templates;

    }


    delete_holiday(id, id_template) {

        const formData = new FormData();
        formData.append('id_template', id_template);
        formData.append('id', id);

        fetch('../ConfiguracionesRH/delete_holiday', {
            method: 'POST',
            body: formData
        })

            .then(response => {
                //console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })

            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');

                    } else if (json_app.status === 1) {
                        utils.showToast('Fecha eliminada correctamente', 'success');


                        this.format_holidays(json_app);


                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');

                    } else if (json_app.status === 3) {
                        utils.showToast('No se puede agregar por que ya se realizó una solicitud con esta plantilla', 'error');

                    }

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

            });



    }


    format_holidays(json_app) {
        var fechas = '';
        var cont = json_app.dates.length;
        var templates = '';
        json_app.dates.forEach(date => {


            templates += ` <tr>
                
            <td class="text-center align-middle"><b>${cont}</b>
            </td>
            <td class="text-center align-middle">
               ${date.name}</td>
            <td class="text-center align-middle">
            ${date.day} de ${date.converted_month}</td>
            <td class="text-center py-0 align-middle">
                <div class="btn-group btn-group-sm ">
                <a data-id="${date.id_encrypted}"  data-id_template="${json_app.id_template_encrypted}" data-name="${date.name}" data-month="${date.month}" data-day="${date.day}" class="btn btn-success btn-sm mr-1 editar">
                <i class="fas fa-edit  "></i>
            </a>
            <a class="btn btn-danger btn-sm mr-1 borrar" data-id="${date.id_encrypted}" data-id_template="${json_app.id_template_encrypted}" data-name="${date.name}">
                <i class="fas  fa-trash  "></i>
            </a>
</div>
            </td>
        </tr>`;
            cont--;
        })


        document.querySelector('#table_holidays' + json_app.id_template + ' tbody').innerHTML = templates;

        console.log(json_app.active);
        if (json_app.active == false) {
            if (json_app.dates.length > 0) {
                document.querySelector('#activar' + json_app.id_template).disabled = false;
            } else {
                document.querySelector('#activar' + json_app.id_template).disabled = true;
            }
        }


    }






    delete_template(id_template) {

        const formData = new FormData();
        formData.append('id_template', id_template)

        fetch('../ConfiguracionesRH/delete_template', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //  console.log(response.json())
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {
                        utils.showToast('Plantilla eliminada correctamente', 'success');
                        this.format_templates(json_app);
                    } else if (json_app.status === 2) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 3) {
                        utils.showToast('Esta plantilla se encuentra activa y no puede ser eliminada, active otra plantilla si desea eliminar esta.', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });



    }



}
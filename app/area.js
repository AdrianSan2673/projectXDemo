class Area {

    save() {
        var form = document.querySelector("#agregar-area-form");
        var formData = new FormData(form);
        document.querySelector('#agregar-area-form [name="guardar"]').disabled = true;

        fetch('../Areas/saveArea', {
            method: 'POST',
            body: formData
        })
            .then(response => {
                //   console.log(response.json());
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
                    if (json_app.status == 1) {

                        let areas = '';
                        let cont = json_app.areas.length;
                        json_app.areas.forEach(area => {

                            areas += `
                                    <tr>
                                        <td class="text-center text-bold"> ${cont}</td>
                                        <td class="text-center align-middle">${area.area}</td>
                                        <td class="text-center py-0 align-middle"> 
                                         <div class="btn-group btn-group-sm">
                                         <a data-id="${area.id}" title="Ver Subareas"
                                       class="btn btn-success btn-sm mr-1">
                                       <i class="fas fa-eye"></i>
                                   </a>
                                        <a class="btn btn-danger btn-sm mr-1" title="ocultar"
                                            data-id="${area.id}">
                                            <i class="fas fa-eye-slash"></i>
                                        </a>
                                    </div></td>
                                    </tr>
                                `;
                            cont--;
                        });

                        utils.destruir_datatable('#table_areas', '#table_areas tbody', areas);
                        utils.showToast('Los datos han sido guardados correctamente', 'success');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                        $('#modal-agregar-area').modal('hide');
                        document.getElementById("agregar-area-form").reset();

                    } else if (json_app.status == 0) {
                        utils.showToast('No se pudo consultar la informacion dentro', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo consultar la informacion fuera', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    } else {
                        utils.showToast('Esa area ya esta registrada ', 'error');
                        document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector('#agregar-area-form [name="guardar"]').disabled = false;
            });
    }

    //===[gabo 31 julio moudlo area]==
    HideArea(id_area) {


        const data = new FormData();
        data.append('id_area', id_area);

        fetch('../Areas/HideArea', {
            method: 'POST',
            body: data
        })
            .then(response => {
                //  console.log(response.json());
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    console.log(json_app)
                    if (json_app.status == 1) {


                        let areas = '';
                        let cont = json_app.areas.length;
                        json_app.areas.forEach(area => {

                            areas += `
                                    <tr>
                                        <td class="text-center text-bold"> ${cont}</td>
                                        <td class="text-center align-middle">${area.area}</td>
                                        <td class="text-center py-0 align-middle"> 
                                         <div class="btn-group btn-group-sm">
                                         <a data-id="${area.id}" title="Ver Subareas"
                                       class="btn btn-success btn-sm mr-1">
                                       <i class="fas fa-eye"></i>
                                   </a>
                                        <a class="btn btn-danger btn-sm mr-1" title="ocultar"
                                            data-id="${area.id}">
                                            <i class="fas fa-eye-slash"></i>
                                        </a>
                                    </div></td>
                                    </tr>
                                `;
                            cont--;
                        });

                        utils.destruir_datatable('#table_areas', '#table_areas tbody', areas);
                        utils.showToast('Subarea ocultada correctamente ', 'success');


                    } else if (json_app.status == 0) {
                        utils.showToast('No se pudo consultar la informacion ', 'error');
                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo consultar la informacion ', 'error');
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
    //===[gabo 31 julio moudlo area fin]==

}
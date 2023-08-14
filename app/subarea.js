class Subarea {

    constructor() {
        this.id_area = null;
        this.selector = '';
    }

    getSubareasByArea() {
        //this.id_area = document.querySelector('#area').value;
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `area=${this.id_area}`;
        xhr.open('POST', '../subarea/getSubareasByArea');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0) {
                    let json_subareas = JSON.parse(this.responseText);
                    let subareas = '';
                    subareas += `<option value=""></option>`  //gabo 13/03/2023
                    for (let i in json_subareas) {
                        subareas += `<option value="${json_subareas[i].id}">${json_subareas[i].subarea}</option>`
                    }
                    this.s.innerHTML = subareas;
                    //document.querySelector("#subarea").innerHTML = subareas;
                }
            }
        }
    }


    //===[gabo 28 julio modulo area ]===
    save_subarea() {
        var form = document.querySelector("#agregar-subarea-form");
        var formData = new FormData(form);
        document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = true;

        fetch('../Subarea/save_subarea', {
            method: 'POST',
            body: formData
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
                console.log(r);
                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status == 1) {

                        let subareas = '';
                        let cont = json_app.subareas.length;
                        json_app.subareas.forEach(subarea => {


                            subareas += `
                                    <tr>
                                        <td class="text-center text-bold"> ${cont}</td>
                                        <td class="text-center align-middle">${subarea.subarea}</td>
                                        <td class="text-center py-0 align-middle"> 
                                        <div class="btn-group btn-group-sm">
                                        <a class="btn btn-danger btn-sm mr-1" title="ocultar"
                                            data-id="${subarea.id}">
                                            <i class="fas fa-eye-slash"></i>
                                        </a>
                                    </div></td>
                                    </tr>
                                `;
                            cont--;
                        });

                        utils.destruir_datatable('#table_subareas', '#table_subareas tbody', subareas);

                        document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;
                        document.querySelector('#agregar-subarea-form').reset();
                        utils.showToast('Subarea guardada', 'success');
                        $('#modal-agregar-subarea').modal('hide');

                    } else if (json_app.status == 0) {
                        utils.showToast('No se pudo consultar la informacion dentro', 'error');
                        document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;

                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo consultar la informacion fuera', 'error');
                        document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;

                    } else {
                        utils.showToast('Esa subarea ya existe', 'error');
                        document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;

                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector('#agregar-subarea-form [name="guardar"]').disabled = false;

            });
    }


    fillModalSubareas(id_area) {

        const data = new FormData();
        data.append('id_area', id_area);

        fetch('../Subarea/getSubareasByIdArea', {
            method: 'POST',
            body: data
        })
            .then(response => {

                //console.log(response.json());
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {

                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status == 1) {

                        document.getElementById("titulo").textContent = json_app.area.area;

                        let subareas = '';
                        let cont = json_app.subareas.length;
                        json_app.subareas.forEach(subarea => {


                            subareas += `
                                    <tr>
                                        <td class="text-center text-bold"> ${cont}</td>
                                        <td class="text-center align-middle">${subarea.subarea}</td>
                                        <td class="text-center py-0 align-middle"> 
                                        <div class="btn-group btn-group-sm">
                                        <a class="btn btn-danger btn-sm mr-1" title="ocultar"
                                            data-id="${subarea.id}">
                                            <i class="fas fa-eye-slash"></i>
                                        </a>
                                    </div></td>
                                    </tr>
                                `;
                            cont--;
                        });

                        utils.destruir_datatable('#table_subareas', '#table_subareas tbody', subareas);

                        console.log(json_app)
                        document.querySelector('#agregar-subarea-form  [name="id_area"]').value = json_app.area.id;



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


    HideSubarea(id_subarea) {

        console.log("SUBAREA" + id_subarea)
        const data = new FormData();
        data.append('id_subarea', id_subarea);

        fetch('../Subarea/HideSubarea', {
            method: 'POST',
            body: data
        })
            .then(response => {
                //console.log(response.json());
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


                        let subareas = '';
                        let cont = json_app.subareas.length;
                        json_app.subareas.forEach(subarea => {

                            subareas += `
                                    <tr>
                                        <td class="text-center text-bold"> ${cont}</td>
                                        <td class="text-center align-middle">${subarea.subarea}</td>
                                        <td class="text-center py-0 align-middle"> 
                                         <div class="btn-group btn-group-sm">
                                        <a class="btn btn-danger btn-sm mr-1" title="ocultar"
                                            data-id="${subarea.id}">
                                            <i class="fas fa-eye-slash"></i>
                                        </a>
                                    </div></td>
                                    </tr>
                                `;
                            cont--;
                        });

                        utils.destruir_datatable('#table_subareas', '#table_subareas tbody', subareas);
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
    //===[gabo 28 julio modulo area fin]===
}
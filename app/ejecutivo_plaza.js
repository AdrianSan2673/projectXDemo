class Ejecutivo_plaza {

    save() {
        this.id_customer = document.querySelector('#customer').value;
        this.id_recruiter = document.querySelector("#recruiter").value;

        let data = `id_customer=${this.id_customer}&id_recruiter=${this.id_recruiter}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './agregar_cliente_ejecutivoSA');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                //console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue guardado exitosamente', 'success');

                        let tbody_customers = '';
                        json_app.recruiter_customers.forEach(element => {
                            tbody_customers +=
                                `
                                  <tr>
                                    <td>${element.Nombre_Cliente}</td>
                                    <td>${element.Centro_Costos}</td>
                                    <td class="text-center py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                      <button value="${element.ID}" class="btn btn-danger"> <i class="fas fa-times"></i></button>
                                      </div>
                                    </td>
                                  </tr>
                                `
                        })

                        let optionscustomer = '<option disabled selected value="">Selecciona empresa</option>'
                        json_app.unassigned_customers.forEach(element => {
                            optionscustomer +=
                                `
                                <option value="${element.Cliente}">${element.Nombre_Cliente+' - '+element.Centro_Costos}</option>
                                `
                        })

                        document.querySelector('#tbody_customers').innerHTML = tbody_customers;
                        document.querySelector('#customer').innerHTML = optionscustomer;

                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }





    delete(id) {

        let xhr = new XMLHttpRequest();
        let data = `id=${id}`;

        xhr.open('POST', './eliminar_cliente_ejecutivoSA');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                //console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 1) {

                        utils.showToast('Fue eliminado exitosamente', 'success');

                        let tbody_customers = '';
                        json_app.recruiter_customers.forEach(element => {
                            tbody_customers +=
                                `
                                  <tr>
                                    <td>${element.Nombre_Cliente}</td>
                                    <td>${element.Centro_Costos}</td>
                                    <td class="text-center py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                      <button value="${element.ID}" class="btn btn-danger"> <i class="fas fa-times"></i></button>
                                      </div>
                                    </td>
                                  </tr>
                                `
                        })

                        let optionscustomer = '<option disabled selected value="">Selecciona empresa</option>'
                        json_app.unassigned_customers.forEach(element => {
                            optionscustomer +=
                                `
                                <option value="${element.Cliente}">${element.Nombre_Cliente+' - '+element.Centro_Costos}</option>
                                `
                        })

                        document.querySelector('#tbody_customers').innerHTML = tbody_customers;
                        document.querySelector('#customer').innerHTML = optionscustomer;



                    } else if (json_app.status == 2) {
                        utils.showToast('El departamento contiene empleados o puestos.', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ', 'error');
                }

            }
        }
    }


    saveApoyo() {
        this.id_customer = document.querySelector('#customer').value;
        this.id_recruiter = document.querySelector("#recruiter").value;

        let data = `ejecutivo=${this.id_customer}&usuario_Apoyo=${this.id_recruiter}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './agregar_ejecutivoSA');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue guardado exitosamente', 'success');

                        let tbody_customers = '';
                        json_app.executiveJR_cuenta.forEach(element => {
                            tbody_customers +=
                                `
                                <tr>
                                    <td>${element.first_name+' '+element.last_name }</td>
                                    <td class="text-center py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button value="${element.username}" class="btn btn-danger text-bold">X</button>
                                        </div>
                                    </td>
                                </tr>
                                `
                        })

                        document.querySelector('#tbody_customers').innerHTML = tbody_customers;

                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast('Este ejecutivo ya esta asignado', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }

    deleteApoyo(ejecutivo) {
        this.id_customer = ejecutivo
        this.id_recruiter = document.querySelector("#recruiter").value;

        let data = `ejecutivo=${this.id_customer}&usuario_Apoyo=${this.id_recruiter}`;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './eliminar_ejecutivoSA');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue eliminado exitosamente', 'success');

                        let tbody_customers = '';
                        json_app.executiveJR_cuenta.forEach(element => {
                            tbody_customers +=
                                `
                                <tr>
                                    <td>${element.first_name+' '+element.last_name }</td>
                                    <td class="text-center py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button value="${element.username}" class="btn btn-danger text-bold">X</button>
                                        </div>
                                    </td>
                                </tr>
                                `})
                        document.querySelector('#tbody_customers').innerHTML = tbody_customers;
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast('Este ejecutivo ya esta asignado', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }
    
    desactivar_ejecutivoSA(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './desactivar_ejecutivoSA');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id='+id);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('ocurrio un error, recarge la pagina', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue desactivado exitosamente', 'success');

                        let tbody_executives = '';
                        json_app.executives.forEach(element => {
                            tbody_executives +=
                                `
                                <tr>
                                <td class="image text-center"><img class="img-circle img-fluid img-responsive elevation-2" src="${element.avatar}" style="width:60px; height:auto;"></td>
                                <td>${element.username}</td>
                                <td>${element.first_name+' '+element.last_name}</td>
                                <td>${element.email}</td>
                                <td class="text-center py-0 align-middle">
                                  <div class="btn-group btn-group-sm">
                                  <a href="${element.link}" class="btn btn-info">
                                    <i class="far fa-handshake"></i>
                                  </a>
                                    <button class=" btn btn-danger" value="${element.id}">Desactivar</button>
                                  </div>
                                </td>
                              </tr>
                                `})
                        document.querySelector('#tbody_executives').innerHTML = tbody_executives;
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast('Este ejecutivo no puede ser eliminado', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



}
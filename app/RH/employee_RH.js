class Employee_RH {

    responder_solicitud() {

        document.querySelector("#modal_responder [name='submit']").disabled = true
        var form = document.querySelector("#modal_responder form");
        var data = new FormData(form);

        fetch('../Vacaciones/responder_solicitud_rh', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                //   console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {
                console.log(json_app)

                if (json_app.status == 1) {
                    $('#tabla3').DataTable().destroy();
                    var solicitudes = '';
                    var cont = json_app.solicitudes.length;
                    json_app.solicitudes.forEach(solicitud => {

                        (solicitud.comments == '') ? solicitud.comments = '-' : false;
                        solicitudes += ` <tr>
                                        <td class="text-center text-bold">${cont}</td>
                                        <td class="text-center">${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}</td>
                                        <td class="text-center">${solicitud.created_at}</td>
                                        <td class="text-center">${solicitud.start_date + " al " + solicitud.end_date}</td>
                                        <td class="text-center">${solicitud.requested_days}</td>
                                        <td class="text-center">${solicitud.holidays_by_year - solicitud.taken_holidays} </td>
                                        <td class="text-center">${solicitud.comments} </td>
                                        <td class="text-center"> `;
                        if (solicitud.status == 'En revisión') {
                            solicitudes += `  <button data-id="" value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                    <i class="fas fa-check"> Aceptar</i>
                                                </button>
                                                <a data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                    <i class="fas fa-ban"> Denegar</i>
                                                </a> `;
                        }
                        if (solicitud['status'] == 'Aceptada') {
                            solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                        }
                        if (solicitud['status'] == 'Declinada') {
                            solicitudes += ` <small class="badge badge-danger"> Declinada</small>`;
                        }

                        solicitudes += ` </td >
                                    </tr > `;

                        cont--;
                    });


                    document.querySelector('#tabla3 tbody').innerHTML = solicitudes;

                    $("#tabla3").DataTable({
                        "searching": true,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });


                    //tabla mobile

                    $('#table-solicitud-pendiente-movil').DataTable().destroy();
                    var solicitudes = '';
                    var cont = json_app.solicitudes.length;
                    json_app.solicitudes.forEach(solicitud => {

                        (solicitud.comments == '') ? solicitud.comments = '-' : false;
                        solicitudes += `     <tr>
                                                    <td class="text-left">
                                                        <div class="card-body">
                                                            <b> # ${cont} </b>
                                                            <hr style="border-color:green; margin-top:0.1rem;">
                                                            <b> Nombre : </b>
                                                            ${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Fecha de la solicitud: </b>
                                                            ${solicitud.created_at}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Periodo de vacaciones :</b>
                                                            ${solicitud.start_date + " al " + solicitud.end_date}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Dias solicitados :</b>
                                                            ${solicitud.days}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Dias disponibles :</b>
                                                            ${solicitud.holidays_by_year - solicitud.taken_holidays}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Comentarios :</b>
                                                            ${solicitud.comments}
                                                            <hr style="margin:0.1rem;opacity:0% ">
                                                            <b> Status :</b> `;
                        if (solicitud.status == 'En revisión') {
                            solicitudes += ` <small class="badge badge-warning"> En revisión</small>`;
                        }
                        if (solicitud.status == 'Aceptada') {
                            solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                        }
                        if (solicitud['status'] == 'Declinada') {
                            solicitudes += ` <small class="badge badge-danger">Declinada</small>`;
                        }
                        solicitudes += ` <hr style="margin:0.1rem;opacity:0% ">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12" style="text-align:center;margin-top:-0.5rem;margin-bottom:1rem">`;
                        if (solicitud['status'] == 'En revisión') {
                            solicitudes += `  <button value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                                        <i class="fas fa-check"> Aceptar</i>
                                                                    </button>
                                                                    <button data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                                        <i class="fas fa-ban"> Declinar</i>
                                                                    </button>`;
                        }
                        solicitudes += `   </div >
                                         </div >
                                    </td >
                                </tr >`;


                        cont--;
                    });


                    document.querySelector('#table-solicitud-pendiente-movil tbody').innerHTML = solicitudes;

                    $("#table-solicitud-pendiente-movil").DataTable({
                        "searching": true,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });
                    //fin tabla mobil 
                    document.querySelector("#modal_responder form").reset();
                    utils.showToast('Solicitud Aceptada exitosamente', 'success');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                    $('#modal_responder').modal('hide');



                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo guardar la información', 'error');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }

    //===[gabo 31 oct
    save_solicitud() {

        document.querySelector("#modal_create_holidays [name='submit']").disabled = true
        var form = document.querySelector("#modal_create_holidays form");
        var data = new FormData(form);

        fetch('../Vacaciones/save_solicitud_rh', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                // console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {
                document.querySelector("#modal_create_holidays [name='submit']").disabled = false
                if (json_app.status == 1) {
                    var solicitudes = '';
                    var cont = json_app.solicitudes.length;
                    json_app.solicitudes.forEach(solicitud => {

                        (solicitud.comments == '') ? solicitud.comments = '-' : false;

                        solicitudes += `
                            <tr>
                                        <td class="text-center text-bold" >${cont}</td>
                                        <td class="text-center" >${solicitud.created_at}</td>
                                        <td class="text-center" >${solicitud.requested_days}</td>
                                        <td class="text-center" >${solicitud.start_date + " Al " + solicitud.end_date}</td>
                                        <td class="text-center" >${solicitud.comments}</td>
                                        <td class="text-center" >`;

                        if (solicitud.status == 'En revisión') {
                            solicitudes += `<small class="badge badge-warning" > En revisión</small> `;
                        }
                        if (solicitud['status'] == 'Aceptada') {
                            solicitudes += `<small class="badge badge-success" > Aceptada</small> `;
                        }
                        if (solicitud['status'] == 'Declinada') {
                            solicitudes += ` <small class="badge badge-danger" > Declinada</small> `;
                        }
                        solicitudes += `  </td>
                                    </tr>
                            `;
                        cont--;
                    });
                    $('#tabla2').DataTable().destroy();
                    document.querySelector('#tabla2 tbody').innerHTML = solicitudes;


                    //===[gabo 21 julio movil-responsive]===
                    var solicitudes_movil = '';
                    var cont = json_app.solicitudes.length;
                    json_app.solicitudes.forEach(solicitud => {

                        (solicitud.comments == '') ? solicitud.comments = '-' : false;
                        solicitudes_movil += `
                            <tr>
                            <td class="text-left">
                                <div class="card-body">
                                    <b> #${cont}</b>
                                    <hr style="border-color:green; margin-top:0.1rem">

                                        <b> Fecha de la solicitud : </b>
                                        ${solicitud.created_at}
                                        <hr style="margin:0.1rem;opacity:0% ">

                                            <b> Dias solicitados :</b> ${solicitud.requested_days}
                                            <hr style="margin:0.1rem;opacity:0% ">
                                                <b> Periodo de vacaciones :</b>
                                                ${solicitud.start_date}  Al  ${solicitud.end_date}
                                                <hr style="margin:0.1rem;opacity:0% ">
                                                    <b> Comentarios :</b>
                                                    ${solicitud.comments}
                                                    <hr style="margin:0.1rem;opacity:0% ">
                                                        <b> Status :</b> `;

                        if (solicitud.status == 'En revisión') {
                            solicitudes_movil += ` <small class="badge badge-warning"> En revisión</small> `;
                        }

                        if (solicitud.status == 'Aceptada') {
                            solicitudes_movil += `<small class="badge badge-success"> Aceptada</small> `;
                        }
                        if (solicitud.status == 'Declinada') {
                            solicitudes_movil += `<small class="badge badge-danger"> Declinada</small> `;
                        }

                        solicitudes_movil += `
                                                    </div>
                                                </td >
                                            </tr>`;

                        cont--;

                    });


                    $('#table-solicitud-movil').DataTable().destroy();
                    document.querySelector('#table-solicitud-movil tbody').innerHTML = solicitudes_movil;

                    $("#table-solicitud-movil").DataTable({
                        "searching": true,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });
                    //fin movil



                    document.querySelector("#modal_create_holidays form").reset();
                    utils.showToast('Solicitud guardada exitosamente', 'success');
                    document.querySelector("#modal_create_holidays [name='submit']").disabled = false
                    $('#modal_create_holidays').modal('hide');

                    $("#tabla2").DataTable({
                        "searching": true,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });



                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo guardar la información', 'error');
                    document.querySelector("#modal_create_holidays [name='submit']").disabled = false
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#modal_create_holidays [name='submit']").disabled = false
                } if (json_app.status === 3) {
                    utils.showToast('Verifica las fechas por favorr', 'error');
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }

    //===[gabo 20 julio  responsive-movil fin]===


    update_password() {

        document.querySelector("#contrasena-form [name='submit']").disabled = true;
        var form = document.querySelector("#contrasena-form");
        var data = new FormData(form);

        fetch('../Usuario/update_password_rh', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                //  console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {
                console.log(json_app)

                if (json_app.status == 1) {

                    document.querySelector("#contrasena-form [name='submit']").disabled = false;
                    document.querySelector("#contrasena-form").reset();
                    utils.showToast('Contraseña Actualizada exitosamente', 'success');

                } else if (json_app.status == 0) {
                    utils.showToast('Revise sus credenciales por favor', 'error');
                    document.querySelector("#contrasena-form [name='submit']").disabled = false;

                } else if (json_app.status == 2) {
                    utils.showToast('Contraseña Incorrecta, introduzca su contraseña actual', 'error');
                    document.querySelector("#contrasena-form [name='submit']").disabled = false;
                } else if (json_app.status == 3) {
                    utils.showToast('Confirme su nueva contraseña', 'error');
                    document.querySelector("#contrasena-form [name='submit']").disabled = false;
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#contrasena-form [name='submit']").disabled = false;
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }

    //rafa
    registrar_asientencia(direccion) {

        document.querySelector("#btn_asistencia").disabled = true;

        const data = new FormData();
        data.append('direccion', direccion);
        var id_type = document.getElementById('type').value;
        data.append('id_type', id_type);

        fetch('../Usuario/registrar_asistencia', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                //   console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {

                if (json_app.status == 1) {
                    var asistencias = '';
                    var cont = json_app.asistencias.length;
                    json_app.asistencias.forEach(asistencia => {

                        asistencias += `
                            <tr>       
                             <td class="text-center text-bold" style="width:10px">${cont}</td>
                             <td class="text-center">${asistencia.created_at}</td>
							 <td class="text-center">${asistencia.name}</td>
                             <td class="text-center">${asistencia.coordenada}</td>
                            </tr >
                            `;
                        cont--;

                    });

                    $('#tabla1').DataTable().destroy();
                    document.querySelector('#tabla1 tbody').innerHTML = asistencias;
                    $("#tabla1").DataTable({
                        "searching": true,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });

                    var total_asistencias = parseInt(document.getElementById('total_asistencias').value);
                    if (total_asistencias < 2) {
                        total_asistencias++;
                        document.getElementById('total_asistencias').value = total_asistencias;
                        document.querySelector("#btn_asistencia").disabled = false;
                        utils.showToast('Asistencia registrada exitosamente', 'success');
                    } else {

                        utils.showToast('Asistencia registrada exitosamente', 'success');

                        setTimeout(function () {
                            utils.showToast('Espere 10 segundos para volver a presionar el boton', 'warning');
                        }, 2000);
                        setTimeout(function () {
                            document.querySelector("#btn_asistencia").disabled = false;
                            document.getElementById('total_asistencias').value = 0;
                        }, 10000);
                    }

                    setTimeout(function () {
                        document.getElementById('total_asistencias').value = 0;
                    }, 60000 * 30);



                } else if (json_app.status == 2) {
                    utils.showToast('Ha ocurrido un error intentelo de nuevo', 'error');
                    document.querySelector("#btn_asistencia").disabled = false;

                }

            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }

    //gabo 31 oct
    responder_solicitud_admin() {
        document.querySelector("#modal_responder [name='submit']").disabled = true
        var form = document.querySelector("#modal_responder form");
        var data = new FormData(form);
        fetch('../Vacaciones/responder_solicitud_admin', {
            method: 'POST',
            body: data
        }).then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error('Network response was not ok.');
            }
        }).then(r => {
            console.log(r);
            try {
                const json_app = JSON.parse(r);
                if (json_app.status == 1) {
                    let employees = '';
                    json_app.employees.forEach(employee => {
                        employees += `
                                            <tr>
                                                <td class="align-middle text-bold"> ${employee.first_name} ${employee.surname} ${employee.last_name}</td>
                                                <td class="text-center align-middle">${employee.start_date}</td>
                                                <td class="text-center align-middle">${employee.years}</td>
                                                <td class="text-center align-middle">${employee.holidays_by_year}</td>
                                                <td class="text-center align-middle">${employee.rest_vacation}</td>
                                                <td class="text-center align-middle">${employee.due_date}</td>
                                            </tr>
                                        `;
                    });
                    utils.destruir_datatable('#tb_employees', '#tb_employees tbody', employees);
                    $('#table3').DataTable().destroy();

                    var solicitudes = '';
                    var cont = json_app.solicitudes.length;
                    json_app.solicitudes.forEach(solicitud => {
                        (solicitud.comments == '') ? solicitud.comments = '-' : false;
                        solicitudes += ` <tr>
                                                <td class="text-center text-bold">${cont}</td>
                                                <td class="text-center">${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}</td>
                                                <td class="text-center">${solicitud.created_at}</td>
                                                <td class="text-center">${solicitud.start_date + " al " + solicitud.end_date}</td>
                                                <td class="text-center">${solicitud.requested_days}</td>
                                                <td class="text-center">${solicitud.comments} </td>
                                                <td class="text-center"> `;
                        //===[gabo 4 agosto fail]===
                        if (solicitud.status == 'En revisión') {
                            solicitudes += `  <button data-id="" value="${solicitud.id}" class="btn btn-success mt-1" id="btn-aceptar">
                                                            <i class="fas fa-check"> Aceptar</i>
                                                        </button>
                                                        <a data-id="${solicitud.id}" class="btn btn-danger mt-1" id="btn-denegar">
                                                            <i class="fas fa-ban"> Denegar</i>
                                                        </a> 
                                                         <button value="${solicitud.id}"
                                                        class="btn btn-warning mt-1" id="btn-borrar">
                                                        <i class="fas fa-ban"> Borrar</i>
                                                    </button>
													`;
                        }
                        if (solicitud.status == 'Aceptada') {
                            solicitudes += ` <small class="badge badge-success"> Aceptada</small>`;
                        }
                        if (solicitud.status == 'Declinada') {
                            solicitudes += ` <small class="badge badge-danger"> Declinada</small>`;
                        }
                        //===[gabo 4 agosto fail]===
                        solicitudes += ` <button value="${solicitud.id}"
                                                    data-name='${solicitud.first_name}  ${solicitud.surname}  ${solicitud.last_name}'
                                                    class="btn btn-info mt-1" id="btn-edit">
                                                    <i class="fas fa-edit"> Editar</i>
                                                </button> </td >
                                            </tr > `;
                        cont--;
                    });

                    document.querySelector('#table3 tbody').innerHTML = solicitudes;
                    $("#table3").DataTable({
                        "searching": true,
                        "pageLength": 50,
                        "aaSorting": [], //Agregar o Quitar segun se necesite desactivar orden
                        "oAria": {
                            "sSortAscending": false,
                            "sSortDescending": true
                        }
                    });

                    document.querySelector("#modal_responder form").reset();
                    utils.showToast('Acción realizada correctamente exitosamente', 'success');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                    $('#modal_responder').modal('hide');
                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo guardar la información', 'error');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#modal_responder [name='submit']").disabled = false
                }
            } catch (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#modal_responder [name='submit']").disabled = false
            }
        })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#modal_responder [name='submit']").disabled = false
                console.log(error);
            });
    }


    Update_UserRH() {

        document.querySelector("#modal-acceso [name='submit']").disabled = false;
        var form = document.querySelector("#modal-acceso form");
        var data = new FormData(form);

        fetch('../Usuario/update_UserRH', {
            method: 'POST',
            body: data
        })
            .then(function (response) {
                //   console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {


                if (json_app.status == 1) {



                    document.querySelector("#usernamep").innerHTML = json_app.usuario.username;
                    document.querySelector("#passwordp").innerHTML = json_app.usuario.password;
                    document.querySelector("#statusp").innerHTML = json_app.usuario.status;

                    document.querySelector("#modal-acceso [name='submit']").disabled = false;
                    utils.showToast('La  informacion ha sido guardada correctamente', 'success');
                    $('#modal-acceso').modal('hide');

                } else if (json_app.status == 0) {
                    utils.showToast('Revise sus credenciales por favor', 'error');
                    document.querySelector("#modal-acceso [name='submit']").disabled = false;

                } else if (json_app.status == 2) {
                    utils.showToast('EL usuario ya se encuentra ocupado', 'error');
                    document.querySelector("#modal-acceso [name='submit']").disabled = false;
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#modal-acceso [name='submit']").disabled = false;
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }





}
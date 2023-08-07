class Administracion_RH {



    getServicio(id) {

        const data = new FormData();
        data.append('id', id);

        fetch('../Administracion_RH/getServicio', {
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
                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones +=
                            `
						<option value="${razon.ID_Razon.trim()}">${razon.Razon}</option>
						`;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';
                    document.querySelector("#Razon_Social_RH").innerHTML = razones;
                    document.querySelector("#id").value = json_app.servicio.id;
                    document.querySelector("#id_cliente").value = json_app.servicio.cliente;
                    document.querySelector("#Cliente").value = json_app.servicio.Nombre_Cliente;
                    document.querySelector("#paquete").value = json_app.servicio.name;
                    document.querySelector("#factura").value = json_app.servicio.factura;

                    $('#modal_editRH').modal('show');

                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                }
            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }



    update_folio() {
        var form = document.querySelector("#edit-rh-form");
        var data = new FormData(form);

        fetch('../Administracion_RH/update_folio', {
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

                if (json_app.status == 1) {
                    console.log(json_app.id);
                    document.getElementById("folio" + json_app.id).textContent = json_app.factura;
                    utils.showToast('La información ha sido actualizada', 'success');
                    $('#modal_editRH').modal('hide');
                } else if (json_app.status == 0) {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                }



            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }



    getFactura(id) {

        const data = new FormData();
        data.append('id', id);

        fetch('../Administracion_RH/getFactura', {
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

                try {
                    if (json_app.status == 1) {
                        console.log(json_app);
                        document.querySelector('#rh-form-factura  [name="Folio_Factura"]').value = json_app.factura_datos.factura;
                        document.querySelector('#rh-form-factura  [name="Folio"]').value = json_app.factura_datos.factura;

                        let razones = '';
                        json_app.razones.forEach(razon => {
                            razones +=
                                `
                         <option value="${razon.ID_Razon.trim()}"  ${json_app.factura_datos.razon == razon.Razon ? 'selected' : ''} >${razon.Razon}</option>
                                `;
                        });
                        razones += '<option value="Pendiente">Pendiente</option>';


                        document.querySelector('#rh-form-factura [name="Razon_Social"]').innerHTML = razones;
                        document.querySelector('#rh-form-factura [name="id"] ').value = json_app.factura_datos.id;
                        document.querySelector('#rh-form-factura [name="emision_Date"] ').value = json_app.factura_datos.emision_date;
                        document.querySelector('#rh-form-factura [name="Cliente"] ').value = json_app.factura_datos.Nombre_Cliente;
                        document.querySelector('#rh-form-factura [name="Estado"] ').value = json_app.factura_datos.status;
                        // document.querySelector('#rh-form-factura [name="Promesa_Pago"] ').value = json_app.factura_datos.Promesa_Pago;
                        document.querySelector('#rh-form-factura [name="Monto"] ').value = json_app.factura_datos.cost;
                        document.querySelector('#rh-form-factura [name="Fecha_de_Pago"] ').value = json_app.factura_datos.payment_date;

                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }


    update_factura() {

        var form = document.querySelector("#rh-form-factura");
        var data = new FormData(form);
        document.querySelector('#submit-factura').disabled = true;

        fetch('../Administracion_RH/UpdateFactura', {
            method: 'POST',
            body: data
        })

            .then(function (response) {
                //     console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {
                console.log(json_app);

                try {
                    if (json_app.status == 1) {

                        let trfactura = document.querySelector('#factura' + json_app.Factura.id);
                        trfactura.children[0].querySelector('b').textContent = json_app.Factura.factura;
                        trfactura.children[1].textContent = json_app.Factura.emision_date;
                        trfactura.children[6].textContent = json_app.Factura.razon;
                        trfactura.children[7].textContent = '$ ' + Number.parseFloat(json_app.Factura.cost).toFixed(2);
                        trfactura.children[8].textContent = json_app.Factura.payment_date;
                        trfactura.children[9].textContent = json_app.Factura.status;
                        trfactura.children[11].textContent = json_app.Factura.Proxima_Gestion;
                        trfactura.children[12].textContent = json_app.Factura.Promesa_Pago;

                        trfactura.classList.add('table-warning');

                        let statusclass = "text-center align-middle ";
                        if (json_app.Factura.status == 'Pagada')
                            trfactura.children[9].className = statusclass + 'bg-success';
                        else if (json_app.Factura.status == 'Pendiente de pago')
                            trfactura.children[9].className = statusclass + 'bg-orange';
                        else
                            trfactura.children[9].className = statusclass + '';

                        utils.showToast('Factura actualizada exitosamente', 'success');

                        $('#modal_factura').modal('hide');
                        document.querySelector('#submit-factura').disabled = false;

                    } else {
                        utils.showToast('Algo salió mal1. Inténtalo de nuevo', 'error');
                        document.querySelector('#submit-factura').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal2. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector('#submit-factura').disabled = false;
                }

            })
            .catch(function (error) {
                utils.showToast('Algo salió mal3. Inténtalo de nuevo ' + error, 'error');
                document.querySelector('#submit-factura').disabled = false;
            });
    }


    getFacturaGestion(id) {

        var data = new FormData();
        data.append('id', id);

        fetch('../Administracion_RH/getFactura', {
            method: 'POST',
            body: data
        })


            .then(function (response) {
                //console.log(response.json());
                if (response.ok) {
                    return response.json();
                } else {
                    throw "Error en la Petición";
                }
            })
            .then(function (json_app) {

                console.log(json_app);
                try {
                    if (json_app.status == 1) {

                        let razones = '';
                        json_app.razones.forEach(razon => {
                            razones +=
                                `
                            <option value="${razon.Razon.trim()}">${razon.Razon}</option>
                            `;
                        });
                        razones += '<option value="Pendiente">Pendiente</option>';


                        document.querySelector('#rh-form-gestion-factura [name="Razon_Social"]').innerHTML = razones;
                        document.querySelector('#rh-form-gestion-factura [name="Folio_Factura"]').value = json_app.factura_datos.factura;
                        document.querySelector('#rh-form-gestion-factura [name="Folio"]').value = json_app.factura_datos.factura;
                        document.querySelector('#rh-form-gestion-factura [name="Razon_Social"]').innerHTML = razones;
                        document.querySelector('#rh-form-gestion-factura [name="id"] ').value = json_app.factura_datos.id;
                        document.querySelector('#rh-form-gestion-factura [name="emision_Date"] ').value = json_app.factura_datos.emision_date;
                        document.querySelector('#rh-form-gestion-factura [name="Cliente"] ').value = json_app.factura_datos.Nombre_Cliente;
                        document.querySelector('#rh-form-gestion-factura [name="Estado"] ').value = json_app.factura_datos.status;
                        document.querySelector('#rh-form-gestion-factura [name="Proxima_Gestion"] ').value = json_app.factura_datos.Proxima_Gestion;

                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            })
            .catch(function (error) {
                utils.showToast('Algo salió mal3. Inténtalo de nuevo ' + error, 'error');

            });

    }




    update_factura_gestion() {
        var form = document.querySelector("#rh-form-gestion-factura");
        var data = new FormData(form);
        document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = true;

        fetch('../administracion_RH/bill_follow_up', {
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

                try {
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                        document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = false;
                    } else if (json_app.status == 1) {
                        console.log(json_app)

                        let trfactura = document.querySelector('#factura' + json_app.Factura.id);
                        trfactura.children[0].querySelector('b').textContent = json_app.Factura.factura;
                        trfactura.children[8].textContent = json_app.Factura.payment_date;
                        trfactura.children[9].textContent = json_app.Factura.status;
                        trfactura.children[10].textContent = json_app.Factura.Fecha_Ultima_Gestion;
                        trfactura.children[11].textContent = json_app.Factura.Proxima_Gestion;
                        trfactura.children[12].textContent = json_app.Factura.Promesa_Pago;
                        trfactura.children[13].textContent = json_app.Factura.Ultima_Gestion;

                        trfactura.classList.add('table-warning');

                        let statusclass = "text-center align-middle ";
                        if (json_app.Factura.status == 'Pagada')
                            trfactura.children[9].className = statusclass + 'bg-success';
                        else if (json_app.Factura.Estado == 'Pendiente de pago')
                            trfactura.children[9].className = statusclass + 'bg-orange';
                        else
                            trfactura.children[9].className = statusclass + '';

                        utils.showToast('Factura gestionada exitosamente', 'success');
                        $('#modal_factura_gestion').modal('hide');
                        document.getElementById('rh-form-gestion-factura').reset();

                        document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = false;
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = false;
                    } else {
                        document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector('#rh-form-gestion-factura [name="submit"]').disabled = false;
                }

            })
            .catch(function (error) {
                utils.showToast('Algo salió mal3. Inténtalo de nuevo ' + error, 'error');

            });

    }
    //===


    //


    editar_factura() {
        var form = document.querySelector("#edit-rh-form");
        var data = new FormData(form);

        fetch('../administracion_RH/UpdateFactura', {
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
                    utils.showToast('Factura actualizada exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = './cobranza';
                    }, 3000);
                } else if (json_app.status == 0) {
                    utils.showToast('Omitiste algún dato', 'error');
                    document.querySelector("#edit-rh-form #submit").disabled = false;
                } else {
                    utils.showToast('No se pudo consultar la informacion', 'error');
                    document.querySelector("#edit-rh-form #submit").disabled = false;
                }


            })
            .catch(function (error) {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }








}
class Cliente {

    getEjecutivosYRazonesPorCliente(Cliente){
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#candidate-form');
        xhr.open('POST', '../ServicioApoyo/getEjecutivosYRazonesPorCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0){
                    let json_app = JSON.parse(r);
                    let ejecutivos = '';
                    json_app.ejecutivos.forEach(ejecutivo => {
                        ejecutivos += 
                        `
                        <option value="${ejecutivo.username}">${ejecutivo.first_name} ${ejecutivo.last_name}</option>
                        `;
                    });

                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones += 
                        `
                        <option value="${razon.Razon.trim()}">${razon.Razon}</option>
                        `;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';
                    
                    form.querySelectorAll('select')[3].innerHTML = ejecutivos;
                    form.querySelectorAll('select')[4].innerHTML = razones;
                    form.querySelectorAll('.form-row')[0].style.display = 'flex';
                }
            }
        }
    }

    getContactosYRazonesPorCliente(Cliente){
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#candidate-form');
        xhr.open('POST', '../ServicioApoyo/getContactosYRazonesPorCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0){
                    let json_app = JSON.parse(r);
                    let contactos = '';
                    json_app.contactos.forEach(contacto => {
                        contactos += 
                        `
                        <option value="${contacto.ID}">${contacto.Nombre}</option>
                        `;
                    });
                    contactos += '<option value="0">No asignado</option>';

                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones += 
                        `
                        <option value="${razon.Razon.trim()}">${razon.Razon}</option>
                        `;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';
                    
                    form.querySelectorAll('select')[5].innerHTML = contactos;
                    form.querySelectorAll('select')[4].innerHTML = razones;
                    form.querySelectorAll('.form-row')[0].style.display = 'flex';
                }
            }
        }
    }

    getEmpresa(Empresa) {
        let xhr = new XMLHttpRequest();
        let data = `Empresa=${Empresa}`;
        let form = document.querySelector('#modal_empresa');
        document.querySelectorAll('#modal_empresa form .btn')[1].disabled = false;
        xhr.open('POST', '../Empresa_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;

                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);

                        form.querySelectorAll('input')[0].value = json_app.Empresa;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Nombre_Empresa;
                        form.querySelectorAll('input')[3].value = json_app.Alias;
                        form.querySelector('textarea').value = json_app.Especificaciones;
                        //===[gabo 7 agosto creado por ]===
                        if ($("#creado_por")) {
                            $("#creado_por").val(json_app.creado_por).trigger('change');
                        }
                        //===[gabo 7 agosto creado por fin===

                    } else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }
    getCliente(Cliente) {
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_cliente');
        document.querySelectorAll('#modal_cliente form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);

                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Empresa;
                        form.querySelectorAll('input')[2].value = json_app.Nombre_Cliente;
                        //===[gabo 8 agosto creado por ]===
                        if ($("#creado_por")) {
                            $("#creado_por").val(json_app.creadopor).trigger('change');
                        }
                        //===[gabo 8 agosto creado por fin===
                    } else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }

    getServicios(Cliente){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_servicios');
        document.querySelectorAll('#modal_servicios form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input[type=checkbox]')[0].checked = json_app.Tiene_IL == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[1].checked = json_app.Tiene_ESE == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[2].checked = json_app.Tiene_SOI == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[3].checked = json_app.Tiene_SMART == 1 ? true : false;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getCondiciones(Cliente){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_condiciones');
        document.querySelectorAll('#modal_condiciones form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                		let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = Math.round(json_app.Validacion_Licencia);
                        form.querySelectorAll('input')[3].value = Math.round(json_app.RAL);
                        form.querySelectorAll('input')[4].value = Math.round(json_app.Investigacion_L);
                        form.querySelectorAll('input')[5].value = Math.round(json_app.ESE);
                        form.querySelectorAll('input')[6].value = Math.round(json_app.SMART);
                        form.querySelectorAll('input')[7].value = Math.round(json_app.ESE_Visita);
                        form.querySelectorAll('input')[8].value = json_app.Paquetes;
                        form.querySelectorAll('input')[9].value = json_app.Plazo_Credito;
                        form.querySelectorAll('select')[0].value = json_app.Dias_Credito;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getFacturacion(Cliente){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_facturacion');
        document.querySelectorAll('#modal_facturacion form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Corte_Servicio;
                        form.querySelectorAll('select')[1].value = json_app.Corte_Servicio;

                        if (json_app.Corte_Servicio == 1) {
                            form.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
                        }else if (json_app.Corte_Servicio == 2){
                            form.querySelectorAll('#cortes_content .form-group')[0].style.display = 'block';
                            form.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
                            form.querySelectorAll('#cortes_content select')[0].value = json_app.Fechas_Especificas;
                        }else if (json_app.Corte_Servicio == 3) {
                            form.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[1].style.display = 'block';
                            form.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
                            form.querySelectorAll('#cortes_content select')[1].value = parseInt(json_app.Fechas_Especificas.split(',')[0]);
                            form.querySelectorAll('#cortes_content select')[2].value = parseInt(json_app.Fechas_Especificas.split(',')[1]);
                        }else if (json_app.Corte_Servicio == 4){
                            form.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[2].style.display = 'block';
                            form.querySelectorAll('#cortes_content select')[3].value = parseInt(json_app.Fechas_Especificas);
                        }else{
                            form.querySelectorAll('#cortes_content .form-group')[0].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[1].style.display = 'none';
                            form.querySelectorAll('#cortes_content .form-group')[2].style.display = 'none';
                        }

                        form.querySelectorAll('input')[2].value = json_app.OC_NP;
                        form.querySelectorAll('input')[3].value = json_app.Recepcion_Facturas;
                        form.querySelectorAll('select')[5].value = json_app.Uso_Portal;
                        form.querySelectorAll('input')[4].value = json_app.Portal_Direccion;
                        form.querySelectorAll('input')[5].value = json_app.Portal_Usuario;
                        form.querySelectorAll('input')[6].value = json_app.Portal_Contraseña;
                        form.querySelectorAll('select')[6].value = json_app.Centro_Costos;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getCuentas(Cliente){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_cuentas');
        document.querySelectorAll('#modal_cuentas form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Cuentas_Contacto;
                        form.querySelectorAll('input')[3].value = json_app.Cuentas_Correo;
                        form.querySelectorAll('input')[4].value = json_app.Cuentas_Telefono;
                        form.querySelectorAll('input')[5].value = json_app.Cuentas_Extension;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getComentario(Cliente){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_comentario');
        document.querySelectorAll('#modal_comentario form .btn')[1].disabled = false;
        xhr.open('POST', '../Cliente_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Cliente;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('textarea')[0].value = json_app.Comentario;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

  
    save_empresa2() {
        var form = document.querySelector("#modal_empresa form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empresa_SA/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('La empresa fue editada exitosamente', 'success');
                        document.querySelectorAll('.info-empresa p')[0].textContent = form.querySelectorAll('input')[2].value;
                        document.querySelectorAll('.info-empresa p')[1].textContent = form.querySelectorAll('input')[3].value;
                        //===[gabo 7 agosto creado por ]===
                        document.querySelectorAll('.info-empresa p')[2].textContent = (form.querySelector('textarea').value != '') ? form.querySelector('textarea').value : 'SIN ESPECIFICACIONES';
                        document.querySelectorAll('.info-empresa p')[3].textContent = form.querySelector('select').value;
                        //===[gabo 7 agosto creado por fin===


                        $('#modal_empresa').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }
    
    getContacto(ID){
        let xhr = new XMLHttpRequest();
        let data = `ID_Contacto=${ID}`;
        let form = document.querySelector('#modal_contacto');
        document.querySelectorAll('#modal_contacto form .btn')[1].disabled = false;
        xhr.open('POST', '../ClienteContacto_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.ID;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Nombre_Contacto;
                        form.querySelectorAll('input')[3].value = json_app.Apellido_Contacto;
                        form.querySelectorAll('input')[4].value = json_app.Puesto;
                        form.querySelectorAll('input')[5].value = json_app.Correo;
                        form.querySelectorAll('input')[6].value = json_app.Telefono;
                        form.querySelectorAll('input')[7].value = json_app.Extension;
                        form.querySelectorAll('input')[8].value = json_app.Celular;
                        let cumple = json_app.Fecha_Cumpleaños.split('/');
                        form.querySelectorAll('select')[0].value = Number(cumple[0]);
                        form.querySelectorAll('select')[1].value = Number(cumple[1]);
                        form.querySelectorAll('input')[9].placeholder = json_app.Usuario;
                        form.querySelectorAll('input')[9].value = json_app.username;
                        form.querySelectorAll('input')[10].placeholder = json_app.Contrasena;
                        form.querySelectorAll('input')[10].value = json_app.password;
                        form.querySelectorAll('input')[11].value = json_app.Empresa;
                        //form.querySelectorAll('input')[12].value = json_app.ID_Cliente;
                        form.querySelectorAll('input')[13].value = json_app.username != null ? 1 : 0;
						form.querySelectorAll('select')[2].value = json_app.tipo_usuario;

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                        form.querySelectorAll('input')[13].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    deleteContacto(ID){
        let xhr = new XMLHttpRequest();
        let data = `ID_Contacto=${ID}`;
        let form = document.querySelector('#modal_delete_contacto');
        document.querySelectorAll('#modal_delete_contacto form .btn')[1].disabled = false;
        xhr.open('POST', '../ClienteContacto_SA/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.ID;
                        form.querySelectorAll('input')[3].value = json_app.username;
                        form.querySelector('p').textContent = "¿Estás seguro de que deseas eliminar el usuario de "+json_app.Nombre_Contacto+" "+json_app.Apellido_Contacto+"?";
                    }else 
                        form.querySelectorAll('input')[0].value = 0;
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getRazonSocial(ID){
        let xhr = new XMLHttpRequest();
        let data = `ID_Razon=${ID}`;
        let form = document.querySelector('#modal_razon');
        document.querySelectorAll('#modal_razon form .btn')[1].disabled = false;
        xhr.open('POST', '../RazonesSociales/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.ID;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Nombre_Empresa;
                        form.querySelectorAll('input')[3].value = json_app.Razon;
                        form.querySelectorAll('input')[4].value = json_app.RFC;
                        form.querySelectorAll('input')[5].value = json_app.Direccion_Fiscal;
                        form.querySelectorAll('select')[0].value = json_app.Forma_Pago;
                        form.querySelectorAll('input')[6].value = json_app.Regimen_Fiscal;
                        form.querySelectorAll('select')[1].value = json_app.Uso_CFDI;

                        form.querySelectorAll('input')[7].value = json_app.Contacto;
                        form.querySelectorAll('input')[8].value = json_app.Otro;
                        form.querySelectorAll('input')[10].value = json_app.Empresa;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    save_contacto(){
        var form = document.querySelector("#modal_contacto form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ClienteContacto_SA/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                                <td>${element.Nombre_Contacto} ${element.Apellido_Contacto}</td>
                                <td>${element.Puesto}</td>
                                <td>${element.Correo}</td>
                                <td>${element.Telefono}</td>
                                <td>${element.Extension}</td>
                                <td>${element.Celular}</td>
                                <td class="text-center">${element.Fecha_Cumpleaños}</td>
                                <td>${element.Usuario}</td>
								 <td>${element.password}</td>
                                <td>${element.nombre_tipo}</td>
                                <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
									
									  <button class="btn btn-warning" data-id="${element.Usuario}" data-nombre="${element.Nombre_Contacto} ${element.Apellido_Contacto}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                               
                                        <button class="btn btn-info" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-danger" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            `
                        });
                        document.querySelector('#tb_contacts tbody').innerHTML = contactos;
                        utils.showToast('El contacto fue registrado exitosamente', 'success');
                        $('#modal_contacto').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else if (json_app.status == 3){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('El usuario o la dirección de correo electrónico ya existe.', 'error');
                    }else if (json_app.status == 4){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }

    }

    delete_contacto(){
        var form = document.querySelector("#modal_delete_contacto form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ClienteContacto_SA/delete');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                                <td>${element.Nombre_Contacto} ${element.Apellido_Contacto}</td>
                                <td>${element.Puesto}</td>
                                <td>${element.Correo}</td>
                                <td>${element.Telefono}</td>
                                <td>${element.Extension}</td>
                                <td>${element.Celular}</td>
                                <td class="text-center">${element.Fecha_Cumpleaños}</td>
                                <td>${element.Usuario}</td>
                                <td>${element.password}</td>
                                <td>${element.nombre_tipo}</td>
                                <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
									
									  <button class="btn btn-warning" data-id="${element.Usuario}" data-nombre="${element.Nombre_Contacto} ${element.Apellido_Contacto}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                               
                                        <button class="btn btn-info" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-danger" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                            </tr>
                            `
                        });
                        document.querySelector('#tb_contacts tbody').innerHTML = contactos;
                        utils.showToast('El contacto fue eliminado exitosamente', 'success');
                        $('#modal_delete_contacto').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else if (json_app.status == 3){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('El usuario o la dirección de correo electrónico ya existe.', 'error');
                    }else if (json_app.status == 4){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }

    }

    save_razon(){
        var form = document.querySelector("#modal_razon form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../RazonesSociales/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let razones = '';
                        json_app.razones.forEach(element => {
                            razones += `
                            <tr>
                                <td>${element.Razon}</td>
                                <td>${element.RFC}</td>
                                <td>${element.Direccion_Fiscal}</td>
                                <td>${element.Contacto}</td>
                                <td>${element.Otro}</td>
                                    <td class="text-center py-0 align-middle">
                                        <button class="btn btn-info" data-id="${element.ID_Razon}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a href="${element.archivo}" target="_blank" class="btn btn-orange">
                                            <i class="fas fa-file-download"></i>
                                        </a>
                                    </td>
                            </tr>
                            `
                        });
                        document.querySelector('#tb_razones tbody').innerHTML = razones;
                        utils.showToast('La razón social fue registrada exitosamente', 'success');
                        $('#modal_razon').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }
    save_nombre_cliente() {
        var form = document.querySelector("#modal_cliente form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Cliente_SA/updateNombreCliente');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app)
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        let content = '';
                        content = `
                        <div class="col-md-6 text-center">
                            <b>Empresa</b>
                            <p>${json_app.cliente.Nombre_Empresa}</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <b>Alias</b>
                            <p>${json_app.cliente.Nombre_Cliente}</p>
                        </div>
                        <div class="col-md-12 text-center">
                            <b>Creado por</b>
                            <p>${json_app.cliente.creadopor}</p>
                        </div>
                        `;
                        document.querySelector('#content-nombre_cliente').innerHTML = content;
                        utils.showToast('El nombre del cliente fue actualizado exitosamente', 'success');
                        $('#modal_cliente').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }


    save_servicios(){
        var form = document.querySelector("#modal_servicios form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/updateServicios');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let content = '';
                        content = `
                        <div class="row">
                            <div class="col text-center">
                                <b>Investigación Laboral</b>
                                <p>${json_app.cliente.Tiene_IL == 1 ? 'Sí' : 'No'}</p>
                            </div>
                            <div class="col text-center">
                                <b>Verificación Domiciliaria</b>
                                <p>${json_app.cliente.Tiene_ESE == 1 ? 'Sí' : 'No'}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>Safe Operator By Ingenia</b>
                                <p>${json_app.cliente.Tiene_SOI == 1 ? 'Sí' : 'No'}</p>
                            </div>
                            <div class="col text-center">
                                <b>Estudio Socioeconómico SMART</b>
                                <p>${json_app.cliente.Tiene_SMART == 1 ? 'Sí' : 'No'}</p>
                            </div>
                        </div>
                        `;
                        document.querySelector('#content-servicios').innerHTML = content;
                        utils.showToast('Los servicios fueron actualizados exitosamente', 'success');
                        $('#modal_servicios').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }


   save_condiciones(){
        var form = document.querySelector("#modal_condiciones form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/updateCondiciones');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let content = '';
                        content = `
                        <div class="row">
                            <div class="col text-center">
                                <b>Validación de Licencia</b>
                                <p>${json_app.cliente.Validacion_Licencia}</p>
                            </div>
                            <div class="col text-center">
                                <b>RAL</b>
                                <p>${json_app.cliente.RAL}</p>
                            </div>
                            <div class="col text-center">
                                <b>Investigación Laboral</b>
                                <p>${json_app.cliente.Investigacion_L}</p>
                            </div>
                            <div class="col text-center">
                                <b>Estudio Socioeconómico</b>
                                <p>${json_app.cliente.ESE}</p>
                            </div>
                            <div class="col text-center">
                                <b>Estudio Socioeconómico + Visita</b>
                                <p>${json_app.cliente.ESE_Visita}</p>
                            </div>
                            <div class="col text-center">
                                <b>Estudio Socioeconómico(SMART)</b>
                                <p>${json_app.cliente.SMART}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>Costos especiales (paquetes)</b>
                                <p>${json_app.cliente.Paquetes}</p>
                            </div>
                            <div class="col text-center">
                                <b>Días de crédito</b>
                                <p>${json_app.cliente.Dias_Credito}</p>
                            </div>
                        </div>
                        `;
                        document.querySelector('#content-condiciones').innerHTML = content;
                        utils.showToast('Las condiciones de venta fueron actualizadas exitosamente', 'success');
                        $('#modal_condiciones').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }

    save_facturacion(){
        var form = document.querySelector("#modal_facturacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/updateFacturacion');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let content = '';
                        content = `
                        <div class="row">
                            <div class="col text-center">
                                <b>Cortes de servicio</b>
                                <p>${json_app.cliente.Corte_Servicio == 1 ? 'Contraentrega' : (json_app.cliente.Corte_Servicio == 2 ? 'Semanal' : (json_app.cliente.Corte_Servicio == 3 ? 'Quincenal' : (json_app.cliente.Corte_Servicio == 4 ? 'Mensual' : 'Sin asignar')))}</p>
                            </div>
                            <div class="col text-center">
                                <b>${json_app.cliente.Corte_Servicio == 1 ? '' : (json_app.cliente.Corte_Servicio == 2 ? 'Corte Semanal:' : (json_app.cliente.Corte_Servicio == 3 ? 'Corte Quincenal: ' : (json_app.cliente.Corte_Servicio == 4 ? 'Corte Mensual:' : '')))}</b>
                                <p>${json_app.cliente.Corte_Servicio == 1 ? '' : (json_app.cliente.Corte_Servicio == 2 ? 'Cada '+json_app.cliente.Fechas_Especificas : (json_app.cliente.Corte_Servicio == 3 ? 'Los días '+json_app.cliente.Fechas_Especificas.split('.')[0]+' y '+json_app.cliente.Fechas_Especificas.split('.')[1] : (json_app.cliente.Corte_Servicio == 4 ? 'El día '+json_app.cliente.Fechas_Especificas : '')))}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>OC/NP</b>
                                <p>${json_app.cliente.OC_NP}</p>
                            </div>
                            <div class="col text-center">
                                <b>Recepción de facturas</b>
                                <p>${json_app.cliente.Recepcion_Facturas}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>Uso de portales</b>
                                <p>${json_app.cliente.Uso_Portal == 0 ? 'Sí' : (json_app.cliente.Uso_Portal == 1 ? 'No' : '')}</p>
                            </div>
                            <div class="col">
                                <b>Dirección</b>
                                <p>${json_app.cliente.Portal_Direccion}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>Usuario</b>
                                <p>${json_app.cliente.Portal_Usuario}</p>
                            </div>
                            <div class="col text-center">
                                <b>Contraseña</b>
                                <p>${json_app.cliente.Portal_Contraseña}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <b>Centro de costos</b>
                                <p>${json_app.cliente.Centro_Costos}</p>
                            </div>
                        </div>
                        `;
                        document.querySelector('#content-facturacion').innerHTML = content;
                        utils.showToast('Los datos de facturación del cliente han sido actualizados exitosamente', 'success');
                        $('#modal_facturacion').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }

    save_cuentas(){
        var form = document.querySelector("#modal_cuentas form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/updateCuentas');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let content = '';
                        content = `
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <b>Contacto</b>
                                <p>${json_app.cliente.Cuentas_Contacto}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <b>Dirección de correo electrónico</b>
                                <p>${json_app.cliente.Cuentas_Correo}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 text-center">
                                <b>Teléfono</b>
                                <p>${json_app.cliente.Cuentas_Telefono}</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <b>Extensión</b>
                                <p>${json_app.cliente.Cuentas_Extension}</p>
                            </div>
                        </div>
                        `;
                        document.querySelector('#content-cuentas').innerHTML = content;
                        utils.showToast('La información de cuentas por pagar del cliente fue actualizada exitosamente', 'success');
                        $('#modal_cuentas').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }

    save_comentario_cliente(){
        var form = document.querySelector("#modal_comentario form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/updateComentario');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let content = '';
                        content = `
                        <p>${json_app.cliente.Comentario}</p>
                        `;
                        document.querySelector('#content-comentario').innerHTML = content;
                        utils.showToast('Los comentarios del cliente fueron actualizados exitosamente', 'success');
                        $('#modal_comentario').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }

    save_nota(){
        var form = document.querySelector("#modal_nota form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ClienteNotas/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let notas = '';
                        json_app.notas.forEach(element => {
                            notas += `
                            <div class="card-comment">
                                <img src="${element.avatar}" class="img-circle img-sm">
                                <div class="comment-text">
                                    <span class="username">
                                        ${element.first_name} ${element.last_name}
                                        <span class="text-muted float-right">${element.Fechaa}</span>
                                    </span>
                                    ${element.Comentarios}
                                </div>
                            </div>
                            `
                        });
                        document.querySelector('#tb_notas').innerHTML = notas;
                        utils.showToast('La nota fue registrada exitosamente', 'success');
                        $('#modal_nota').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }

    save_empresa(){
        var form = document.querySelector("#empresa-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Empresa_SA/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        utils.showToast('La empresa fue registrada exitosamente', 'success');
                        setTimeout("location.href='./ver&id="+json_app.id+"'", 3000);
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }
    }

    save_cliente(){
        var form = document.querySelector("#cliente-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cliente_SA/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        utils.showToast('El cliente fue registrado exitosamente', 'success');
                        setTimeout("location.href='./ver&id="+json_app.id+"'", 3000);
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }
    }

    getContactos(Cliente, Empresa){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}&Empresa=${Empresa}`;
        let form = document.querySelector('#modal_contactos');
        document.querySelectorAll('#modal_contactos form .btn')[1].disabled = false;
        xhr.open('POST', '../ClienteContacto_SA/getContactosByCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let contactos = '';
                        json_app.contactosEmpresa.forEach(element => {
                            contactos += `
                            <option value='${element.ID}'>${element.Nombre_Contacto} ${element.Apellido_Contacto}</option>
                            `;
                        });
                        form.querySelectorAll('select')[0].innerHTML = contactos;
                        form.querySelectorAll('select option').forEach(element => {
                            json_app.contactosCliente.forEach(contact => {
                                if (element.value == contact.ID_Contacto) {
                                    element.setAttribute('selected', 'selected');
                                }
                            });
                        })
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getRazonesSociales(Cliente, Empresa){
        let xhr = new XMLHttpRequest();
        let data = `Cliente=${Cliente}&Empresa=${Empresa}`;
        let form = document.querySelector('#modal_razones');
        document.querySelectorAll('#modal_razones form .btn')[1].disabled = false;
        xhr.open('POST', '../RazonesSociales/getRazonesByCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let razones = '';
                        json_app.razonesEmpresa.forEach(element => {
                            razones += `
                            <option value='${element.ID}'>${element.Razon}</option>
                            `;
                        });
                        form.querySelectorAll('select')[0].innerHTML = razones;
                        form.querySelectorAll('select option').forEach(element => {
                            json_app.razonesCliente.forEach(razon => {
                                if (element.value == razon.ID_Razon) {
                                    element.setAttribute('selected', 'selected');
                                }
                            });
                        })
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_contactos_cliente(){
        var form = document.querySelector("#modal_contactos form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ClienteContacto_SA/save_contactos_cliente');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                                <td>${element.Nombre_Contacto} ${element.Apellido_Contacto}</td>
                                <td>${element.Puesto}</td>
                                <td>${element.Correo}</td>
                                <td>${element.Telefono}</td>
                                <td>${element.Extension}</td>
                                <td>${element.Celular}</td>
                                <td class="text-center">${element.Fecha_Cumpleaños}</td>
                                <td>${element.Usuario}</td>
                                 <td>${element.password}</td>
                                <td>${element.nombre_tipo}</td>
                                <td class="text-center py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
									
									  <button class="btn btn-warning" data-id="${element.Usuario}" data-nombre="${element.Nombre_Contacto} ${element.Apellido_Contacto}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                               
                                        <button class="btn btn-info" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-danger" data-id="${element.ID_Contacto}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                               </div>
                               </td>
                            </tr>
                            `
                        });
                        document.querySelector('#tb_contacts tbody').innerHTML = contactos;
                        utils.showToast('Los contactos fueron actualizados exitosamente', 'success');
                        $('#modal_contactos').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }

    }

    save_razones_cliente(){
        var form = document.querySelector("#modal_razones form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../RazonesSociales/save_razones_cliente');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        let razones = '';
                        json_app.razones.forEach(element => {
                            razones += `
                            <tr>
                                <td>${element.Razon}</td>
                                <td>${element.RFC}</td>
                                <td>${element.Contacto}</td>
                                <td>${element.Otro}</td>
                                    <td class="text-center py-0 align-middle">
                                        <button class="btn btn-info" data-id="${element.ID_Razon}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </td>
                            </tr>
                            `
                        });
                        document.querySelector('#tb_razones tbody').innerHTML = razones;
                        utils.showToast('Se actualizaron las razones sociales exitosamente', 'success');
                        if (json_app.razones.length > 0) {
                            document.querySelector('#btn-nuevo-contacto').parentElement.style.display = 'block';
                            document.querySelector('#btn-modificar-contactos').parentElement.style.display = 'block';
                        }else{
                            document.querySelector('#btn-nuevo-contacto').parentElement.style.display = 'none';
                            document.querySelector('#btn-modificar-contactos').parentElement.style.display = 'none';
                        }
                        $('#modal_razones').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
            }        
        }
    }

    save_encuesta(){
        var form = document.querySelector("#modal_encuesta form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../EncuestaCliente/save');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        //utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        
                        utils.showToast('Gracias por sus comentarios', 'success');
                        $('#modal_encuesta').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        //utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[1].disabled = false;
                        //utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    //utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }        
        }
    }
	

	
    //=========================[Gabo Marzo 1]==============================================
    duplicate_contact(){  //gabo     saaaaa a reclu duplicar
       
        var form = document.querySelector("#modal_contacto form");
		var formData = new FormData(form);
        form.querySelectorAll('.bn_duplicate').disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ClienteContacto_SA/duplicate_contact');
		xhr.send(formData);
       
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                 console.log(r);
                try {
                    let json_app = JSON.parse(r); 
                    if(json_app.status == 1){
                        utils.showToast('Contacto duplicado', 'success');
                        window.open(json_app.url, '_blank');
                        $('#modal_contacto').modal('hide');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    }else if (json_app.status == 2){
                        utils.showToast('El usuario ya existe', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                        
                    }else if (json_app.status == 3){
                        utils.showToast('El usuario no existe', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                       
                    }else if (json_app.status == 4){
                        utils.showToast('Completa todos los campos', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                       
                    }else{
                        utils.showToast('Error', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                        
                    }
                } catch (error) {
                    utils.showToast('Error', 'error');
                    form.querySelectorAll('.bn_duplicate').disabled = false;
                    
                }

            }        
        }
    }
//=========================[Gabo Marzo 1]==============================================
	
	   eliminarCliente(cliente) {
        const formData = new FormData();
        formData.append('Cliente', cliente);
        fetch('../Cliente_SA/eliminarCliente', {
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
                    if (json_app.status == 1) {
                        utils.showToast('Fue eliminado con exito', 'success');

                        let clientes = '';

                        json_app.clientes.forEach(element => {
                            clientes += `
                            <tr>
                            <td class="text-left align-middle">${element.Cliente}</td>
                            <td class="text-left align-middle">${element.ID_Empresa}</td>
                            <td class="text-left align-middle">${element.Fecha_Registro}</td>
                            <td class="text-left align-middle">${element.Empresa}</td>
                            <td class="text-left align-middle">${element.Nombre_Cliente}</td>
                            <td class="text-center align-middle">${element.Centro_Costos}</td>
                            <td class="text-center align-middle">${element.Servicios}</td>
                            <td class="text-right align-middle">${element.Facturacion_Mes}</td>
                            <td class="text-center align-middle">${element.Prom_Mensual}</td>
                            <td class="text-right align-middle">${element.Prom_Fact}</td>
                            <td class="text-right align-middle">${element.Anual_Fact}</td>
                            <td class="text-center align-middle">${element.Fecha_Ultima_Evaluacion}</td>
                            <td class="text-center align-middle">${element.Calificacion}</td>
                            <td class="text-center align-middle">${element.creado_por}</td>
                            <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
                                    <a href="${element.url}" class="btn btn-success">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>

                                    <button class="btn btn-danger ml-3" data-id="${element.Cliente_incriptado}">
                                        <b class="h6 text-bold">X</b>
                                    </button>
                            </td>
                            </tr>
                            `
                        });


                        utils.destruir_datatable('#tb_customers', '#tb_customers tbody', clientes);

                    } else if (json_app.status == 2) {
                        let aviso = '';
                        json_app.aviso.forEach(element => {
                            aviso += `${element}<br>`
                        });

                        Swal.fire({
                            title: '<strong>No se puede eliminar este cliente.</strong>',
                            icon: 'info',
                            html: aviso,
                            showCloseButton: true,
                            focusConfirm: false,
                            cancelButtonAriaLabel: 'Thumbs down'
                        })

                    } else {
                        utils.showToast('No se pudo consultar la informacion dentro', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');

            });
    }



    eliminarEmpresa(Empresa) {
        const formData = new FormData();
        formData.append('Empresa', Empresa);
        fetch('../Empresa_SA/eliminarEmpresa', {
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
                    if (json_app.status == 1) {
                        utils.showToast('Fue eliminado con exito', 'success');

                        let clientes = '';

                        json_app.empresas.forEach(element => {
                            clientes += `
                                                      <tr>
                                                    <td class="text-left align-middle">${element.Nombre_Empresa}</td>
                                                    <td class="text-center py-0 align-middle">${element.creado_por}</td>
                                                    <td class="text-center py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="${element.baseurl}"
                                                                class="btn btn-success">
                                                                <i class="fas fa-eye"></i> Ver
                                                            </a>
                                                            <button class="btn btn-danger ml-3"
                                                                data-id="${element.Empresa}">
                                                                <b class="h6 text-bold">X</b>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                    `
                        });


                        utils.destruir_datatable('#tb_customers', '#tb_customers tbody', clientes);

                    } else if (json_app.status == 2) {
                        let aviso = '';
                        json_app.aviso.forEach(element => {
                            aviso += `${element}<br>`
                        });

                        Swal.fire({
                            title: '<strong>No se puede eliminar esta empresa.</strong>',
                            icon: 'info',
                            html: aviso,
                            showCloseButton: true,
                            focusConfirm: false,
                            cancelButtonAriaLabel: 'Thumbs down'
                        })

                    } else {
                        utils.showToast('No se pudo consultar la informacion dentro', 'error');
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
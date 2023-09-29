class ServicioApoyo{

    getEstudio(folio){
        this.folio = folio;
        let xhr = new XMLHttpRequest();
        let data = `Folio=${this.folio}`;
        document.querySelectorAll('#update-form .btn')[1].disabled = false;
        xhr.open('POST', '../ServicioApoyo/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_app = JSON.parse(this.responseText);
                    document.querySelector("#update-form").reset();
                    document.querySelector("#Folio").value = json_app.Folio;
                    document.querySelector("#Nombre_Candidato").value = json_app.Nombre_Candidato;
                    document.querySelector("#Cliente").value = json_app.Cliente;
                    document.querySelector("#Ejecutivo").value = json_app.Ejecutivo;

                    let Solicitud = new Date(json_app.Solicitud);
                    /* document.querySelector("#Dia_Solicitud").value = Solicitud.getDate();
                    document.querySelector("#Mes_Solicitud").value = Solicitud.getMonth() + 1;
                    document.querySelector("#Anio_Solicitud").value = Solicitud.getFullYear(); */
                    document.querySelector('#Fecha_Solicitud').value = `${Solicitud.getFullYear()}-${("0"+(Solicitud.getMonth()+1)).slice(-2)}-${("0" + Solicitud.getDate()).slice(-2)}`;
                    document.querySelector("#Hora_Solicitud").value = Solicitud.getHours();
                    document.querySelector("#Minuto_Solicitud").value = Solicitud.getMinutes();

                    if (json_app.Entrega != null) {
                        let Entrega = new Date(json_app.Entrega);
                        /* document.querySelector("#Dia_Entrega").value = Entrega.getDate();
                        document.querySelector("#Mes_Entrega").value = Entrega.getMonth() + 1;
                        document.querySelector("#Anio_Entrega").value = Entrega.getFullYear(); */
                        document.querySelector('#Fecha_Entrega').value = `${Entrega.getFullYear()}-${("0"+(Entrega.getMonth()+1)).slice(-2)}-${("0" + Entrega.getDate()).slice(-2)}`;
                        document.querySelector("#Hora_Entrega").value = Entrega.getHours();
                        document.querySelector("#Minuto_Entrega").value = Entrega.getMinutes();
                    }
                }
            }
        }
    }

    getAgenda(folio){
        this.folio = folio;
        let xhr = new XMLHttpRequest();
        let data = `Folio=${this.folio}`;
        document.querySelectorAll('#update-schedule-form .btn')[1].disabled = false;
        xhr.open('POST', '../ServicioApoyo/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_app = JSON.parse(this.responseText);
                    document.querySelector("#update-schedule-form").reset();
                    document.querySelector("#Folio_Candidato").value = json_app.Folio;
                    document.querySelector("#Candidato").value = json_app.Nombre_Candidato;
                    document.querySelector("#Nombre_Cliente").value = json_app.Cliente;
                    document.querySelector("#Logistica").value = json_app.Logistica;

                    if (json_app.Aplicacion != null) {
                        let Aplicacion = new Date(json_app.Aplicacion);
                        /* document.querySelector("#Dia_Aplicacion").value = Aplicacion.getDate();
                        document.querySelector("#Mes_Aplicacion").value = Aplicacion.getMonth() + 1;
                        document.querySelector("#Anio_Aplicacion").value = Aplicacion.getFullYear(); */
                        document.querySelector('#Fecha_Aplicacion').value = `${Aplicacion.getFullYear()}-${("0"+(Aplicacion.getMonth()+1)).slice(-2)}-${("0" + Aplicacion.getDate()).slice(-2)}`;
                        document.querySelector("#Hora_Aplicacion").value = Aplicacion.getHours();
                        document.querySelector("#Minuto_Aplicacion").value = Aplicacion.getMinutes();
                    }
                }
            }
        }
    }

    getLocalizacion(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getOneData');
        let form = document.querySelector('#modal_localizacion form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.flag_ubicacion;
                        form.querySelectorAll('input')[2].value = json_app.Ciudad;
                        form.querySelectorAll('select')[0].value = json_app.id_Estado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
			}
        }
    }

    getTipoServicio(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_service form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        if (json_app.Nuevo_Procedimiento != 1) {
                            form.querySelectorAll('select')[1].innerHTML = 
                            `
                            <option value="298">RAL</option>
                            <option value="231">INV.LAB</option>
                            <option value="230">ESE</option>
                            `;
                        }
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('select')[0].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('select')[1].value = json_app.Fase;
                        form.querySelectorAll('select')[2].value = json_app.Estado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
			}
        }
    }

    getDatosGenerales(folio){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getDatosGenerales');
        let form = document.querySelector('#modal_datos_generales form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
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

                        form.querySelector('h4').textContent = `${json_app.candidato_datos.Nombres} ${json_app.candidato_datos.Apellido_Paterno}`;
                        form.querySelectorAll('select')[1].innerHTML = contactos;
                        form.querySelectorAll('select')[2].innerHTML = razones;
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('select')[0].value = json_app.candidato_datos.Cliente;
                        form.querySelectorAll('select')[1].value = json_app.candidato_datos.Solicita;
                        form.querySelectorAll('select')[2].value = json_app.candidato_datos.Razon.trim();
                        form.querySelectorAll('input')[1].value = json_app.candidato_datos.Nombres;
                        form.querySelectorAll('input')[2].value = json_app.candidato_datos.Apellido_Paterno;
                        form.querySelectorAll('input')[3].value = json_app.candidato_datos.Apellido_Materno;
                        form.querySelectorAll('input')[4].value = json_app.candidato_datos.Puesto;
						form.querySelectorAll('input')[5].value = json_app.candidato_datos.CC_Cliente;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    update_config(){
        var form = document.querySelector("#update-form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_config');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0)
                        utils.showToast('Omitiste algún dato','error');
                    else if (json_app.status == 1){
                        document.querySelector("#solicitud"+json_app.folio).textContent = json_app.solicitud;
                        document.querySelector("#ejecutivo"+json_app.folio).textContent = json_app.ejecutivo;
                        document.querySelector("#entregado"+json_app.folio).textContent = json_app.entregado;
                        document.querySelector("#tiempo"+json_app.folio).textContent = json_app.tiempo;
                        let timeclass = "text-center align-middle ";
                        if (json_app.dias < 2)
                            document.querySelector("#tiempo"+json_app.folio).className = timeclass+'bg-success';
                        else if(json_app.dias > 2)
                            document.querySelector("#tiempo"+json_app.folio).className = timeclass+'bg-danger';
                        else
                            document.querySelector("#tiempo"+json_app.folio).className = timeclass+'bg-orange';

                        utils.showToast('Servicio actualizado exitosamente', 'success');
                        $('#modal_config').modal('hide');
                    }else if(json_app.status == 2)
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    else
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                
			}
		}
	}

    update_schedule(){
        var form = document.querySelector("#update-schedule-form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_schedule');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                    }else if (json_app.status == 1){
                        document.querySelector("#aplicacion"+json_app.folio).textContent = json_app.aplicacion;
                        document.querySelector("#logistica"+json_app.folio).textContent = json_app.logistica;
                        utils.showToast('Servicio agendado exitosamente', 'success');
                        $('#modal_schedule').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
		}
	}

    getContactosYRazonesPorCliente(Cliente){
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#modal_datos_generales form');
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
                    
                    form.querySelectorAll('select')[1].innerHTML = contactos;
                    form.querySelectorAll('select')[2].innerHTML = razones;
                }
            }
        }
    }

    save_servicio(){
        var form = document.querySelector("#candidate-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[0].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/create');
		xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato','error');
                    }else if(json_app.status == 1){
                        utils.showToast('El candidato fue registrado exitosamente', 'success');
                        form.reset();
                        form.querySelectorAll('.btn')[0].disabled = false;
                        //if (json_app.ral == 1) 
                            setTimeout(() => { window.location.href = json_app.redireccion;}, 1800);
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else{
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }

            }        
        }
    }
	
	save_continuar_servicio(){
        var form = document.querySelector("#modal_continuar_servicio form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/continuar_servicio');
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
                        utils.showToast('El candidato fue registrado exitosamente', 'success');
                        form.reset();
                        //form.querySelectorAll('.btn')[1].disabled = false;
                            setTimeout(() => { window.location.href = './crear';}, 3000);
                    }else if (json_app.status == 2){
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else if (json_app.status == 3){
                        utils.showToast('Este servicio excede de los 7 dias permitidas para ser continuado. Solicítalo de nuevo', 'warning');
                        setTimeout(() => { window.location.href = './crear';}, 3000);
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
	
	checkCURP(curp){
        if(curp.length >= 18){
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Datos/checkCURP');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('curp='+curp);

            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    let r = xhr.responseText;
                    console.log(r);
                    try {
                        let json_app = JSON.parse(r);
                        if(json_app.status == 0){
                            document.querySelector('#div_curp_duplicado').style.display = 'none';
                        }else if (json_app.status == 1){
                            document.querySelector('#div_curp_duplicado p').textContent = `Detectamos a través del CURP que ya tenemos información de ${json_app.Nombre} en nuestras bases de datos`;
                            document.querySelectorAll('#div_curp_duplicado input[type="radio"]')[1].value = json_app.Candidato;
                            document.querySelector('#div_curp_duplicado').style.display = 'block';
                        }else{
                            document.querySelector('#div_curp_duplicado').style.display = 'none';
                        }
                    } catch (error) {
                        document.querySelector('#div_curp_duplicado').style.display = 'none';
                    }
                }
            }
        }else{
            document.querySelector('#div_curp_duplicado').style.display = 'none';
        }
    }
}

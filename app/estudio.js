class Estudio extends ContenidoEstudio{
    update_datos_generales(){
        var form = document.querySelector("#modal_datos_generales form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_datos_generales');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
						xhr.clase.cargarBusquedaRAL(json_app.candidato_datos, json_app.busqueda_RAL, json_app.display);
                        utils.showToast('Servicio actualizado exitosamente', 'success');
                        $('#modal_datos_generales').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    update_service(){
        var form = document.querySelector("#modal_service form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_service');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        xhr.clase.setServicioSolicitado(json_app.candidato_datos.Servicio_Solicitado);
                        utils.showToast('Servicio actualizado exitosamente', 'success');
                        $('#modal_service').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    update_config_service(){
        var form = document.querySelector("#update-form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_config');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio actualizado exitosamente', 'success');
                        $('#modal_config').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    update_schedule_service(){
        var form = document.querySelector("#update-schedule-form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/update_schedule');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio agendado exitosamente', 'success');
                        $('#modal_schedule').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getEnlace(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_enlace form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../ServicioApoyo/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    form.querySelectorAll('input')[0].value = folio;
                    form.querySelectorAll('input')[1].value = json_app.Enlace_Drive;
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_enlace(){
        var form = document.querySelector("#modal_enlace form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_enlace');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Enlace actualizado exitosamente', 'success');
                        $('#modal_enlace').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getDatosPersonales(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../Datos/getOne');
        let form = document.querySelector('#modal_datos_personales form');
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
                        
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = json_app.Nacimiento;
                        form.querySelectorAll('input')[2].value = json_app.Edad;
                        form.querySelectorAll('select')[0].value = json_app.Sexo;
                        form.querySelectorAll('input')[3].value = json_app.Lugar_Nacimiento;
                        form.querySelectorAll('select')[1].value = json_app.Estado_Civil;
                        form.querySelectorAll('input')[4].value = json_app.Fecha_Matrimonio;
                        form.querySelectorAll('input')[5].value = json_app.Hijos;
                        form.querySelectorAll('input')[6].value = json_app.Nacionalidad;
                        form.querySelectorAll('input')[7].value = json_app.Vive_con;
                        
                        form.querySelectorAll('input')[8].value = json_app.CURP;
                        form.querySelectorAll('input')[9].value = json_app.IMSS;
                        form.querySelectorAll('input')[10].value = json_app.RFC;
   
                        if (json_app.ID_Empresa==413) {
                            form.querySelector('.num_licen').style.display = "block";
                            form.querySelector('[name="Numero_Licencia"]').value = json_app.Numero_Licencia
							form.querySelector('[name="Numero_Licencia"]').required=true
                        }
						
                        if (json_app.Estado_Civil != 102) {
                            form.querySelector('.matrimonio').style.display = "none";
                        }
                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_datos_personales(){
        var form = document.querySelector("#modal_datos_personales form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Datos/save_datos_personales');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarDatosGenerales(json_app, json_app.display);
                        utils.showToast('Datos personales actualizados exitosamente', 'success');
                        $('#modal_datos_personales').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}
	
	getDatosBusquedaRAL(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../Datos/getOne');
        let form = document.querySelector('#modal_buscar_ral form');
        form.querySelectorAll('.btn')[1].disabled = true;
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
                        form.querySelectorAll('input')[0].value = json_app.Nombres.trim();
                        form.querySelectorAll('input')[1].value = json_app.Apellido_Paterno.trim()+' '+json_app.Apellido_Materno.trim();
                        form.querySelectorAll('input')[2].value = json_app.CURP;
                        form.querySelectorAll('input')[3].value = json_app.Candidato;
                        form.querySelector('p').innerHTML = `Estás por realizar una búsqueda de RAL a nombre de <b>${json_app.Nombres.trim()} ${json_app.Apellido_Paterno.trim()} ${json_app.Apellido_Materno.trim()}</b> ¿Deseas continuar?`;
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    searchForRAL(){
        var form = document.querySelector("#modal_buscar_ral form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../RegistroAntecedentesLegales/search_for_by_candidato');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('No se pudo realizar la consulta del RAL','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarBusquedaRAL(json_app.candidato_datos, json_app.busqueda_RAL, json_app.display);
                        utils.showToast('Se completó la búsqueda del RAL', 'success');
                        $('#modal_buscar_ral').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = true;
                    }else if(json_app.status == 5){
                        utils.showToast('Necesitas tener registrado el CURP del candidato antes de consultar el RAL', 'warning');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getRAL(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../RAL/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1){
                        document.querySelector('#modal_ral .Folio').value = folio;
                        document.querySelectorAll('#modal_ral input')[2].value = json_app.Nombre;
                        document.querySelector("#Demandas").value = json_app.Demandas;
                        document.querySelector("#Estado_RAL").value = json_app.Estado;
                        document.querySelector('#Total_Demandas').value = json_app.Total_Demandas;
                        document.querySelector('#Total_Acuerdos').value = json_app.Total_Acuerdos;
                        document.querySelector('#Tipo_Juicio').value = json_app.Tipo_Juicio;
                        
                        document.querySelector('#ral_flag').value = 1;
                    }else {
                        document.querySelector('#modal_ral .Folio').value = folio;
                        document.querySelector('#ral_flag').value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }
	
	getComentariosRAL(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentarios_ral form');
        xhr.open('POST', '../RAL/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1){
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('textarea')[0].value = json_app.Comentarios;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getInvestigacion(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#update-investigacion-form');
        xhr.open('POST', '../InvestigacionLaboral/getOne');
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
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Circunstancias_Laborales;
                        form.querySelectorAll('select')[1].value = json_app.Proporciono_Datos_Empleos;
                        form.querySelectorAll('input')[2].value = json_app.Motivo_No_Proporciono_Datos;
                        form.querySelectorAll('select')[2].value = json_app.Demanda_Laboral;
                        form.querySelectorAll('input')[3].value = json_app.Motivo_Demanda;
                        form.querySelectorAll('input')[4].value = json_app.No_Empleos;

                        form.querySelectorAll('select')[3].value = json_app.Sindicalizado;
                        form.querySelectorAll('input')[5].value = json_app.Sindicato;
                        form.querySelectorAll('select')[4].value = json_app.Comite_Sindical;
                        form.querySelectorAll('input')[6].value = json_app.Puesto_Sindical;
                        form.querySelectorAll('input')[7].value = json_app.Funciones_Sindicato;
                        form.querySelectorAll('input')[8].value = json_app.Tiempo_Sindicato;
                        form.querySelectorAll('select')[5].value = json_app.Trabajo_Ternium;
						form.querySelectorAll('input')[9].value = json_app.Alta_Ternium;
                        form.querySelectorAll('input')[10].value = json_app.Veto_Ternium;

                        form.querySelectorAll('select')[6].value = json_app.Positivo_Antidoping;
                        form.querySelectorAll('input')[11].value = json_app.Sustancia_Antidoping;
                        form.querySelectorAll('select')[7].value = json_app.Accidentes_Empresa;
                        form.querySelectorAll('select')[8].value = json_app.Abandono_Unidad;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }


    update_ral(){
        var form = document.querySelector("#update-ral-form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../RAL/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0)
                        utils.showToast('Omitiste algún dato','error');
                    else if (json_app.status == 1){
                        xhr.clase.cargarInfoRAL(json_app, json_app.display);
                        if (json_app.Demandas == 1)
                            document.querySelector('#vert-tabs-capturas_ral-tab').style.display = 'none';
                        else if(json_app.Demandas == 2)
                            document.querySelector('#vert-tabs-capturas_ral-tab').style.display = 'block';
                        
                        utils.showToast('RAL actualizado exitosamente', 'success');
                        $('#modal_ral').modal('hide');
                    }else if(json_app.status == 2)
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    else
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                }
                
			}
		}
	}
	
	update_comentarios_ral(){
        var form = document.querySelector("#modal_comentarios_ral form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../RAL/update_comentarios');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0)
                        utils.showToast('Omitiste algún dato','error');
                    else if (json_app.status == 1){
                        xhr.clase.cargarComentariosRAL(json_app, json_app.display);
                        utils.showToast('Comentarios del RAL actualizados exitosamente', 'success');
                        $('#modal_comentarios_ral').modal('hide');
                    }else if(json_app.status == 2)
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    else
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                }
                
			}
		}
	}

    getImagen(Imagen){
        let xhr = new XMLHttpRequest();
        let data = `Imagen=${Imagen}`;
        let form = document.querySelector('#modal_imagen form');
        form.querySelectorAll('.btn')[3].disabled = false;
        //let content_imagen = form.querySelector('.imagen');
        let image = form.querySelector('img');
        image.style.display = "none";
        image.src = "";
         xhr.open('POST', "../Imagen/getOne");
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Imagen;
                        form.querySelectorAll('input')[1].value = json_app.Tabla;
                        form.querySelectorAll('input')[2].value = json_app.Folio_Origen;
                        form.querySelectorAll('input')[3].value = json_app.Archivo;
                        form.querySelectorAll('input')[4].value = folio;
                        form.querySelectorAll('input')[5].value = json_app.Folio;
                        form.querySelectorAll('input')[6].value = 1;
                        /*let image = document.createElement('img');
                        image.setAttribute('src', json_app);
                        content_imagen.appendChild(image);*/
                        image.src = json_app.Objeto;
                        image.style.display = "block";
                        console.log(form, json_app);
                        $('#modal_imagen').modal('show');
                        if (image.src == json_app.Objeto) {
                            let cropper;
                            $('#modal_imagen').on('shown.bs.modal', function(){
                                cropper = null;
                                cropper = new Cropper(image, {
                                    movable: true,
                                    zoomable: true,
                                    scalable: true,
                                    viewMode: 0,
                                    rotatable: true,
                                    preview:'.preview',
                                    ready: function(e){
                                        document.querySelectorAll('#modal_imagen .btn-primary')[0].addEventListener('click', e => {
                                            cropper.rotate(-45);
                                        })
                                    
                                        document.querySelectorAll('#modal_imagen .btn-primary')[1].addEventListener('click', e => {
                                            cropper.rotate(45);
                                        })
                                    }
                                });
                                
                            }).on('hidden.bs.modal', function(){
                                cropper.destroy();
                                cropper = null;
                            });
                        }
                        
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    verImagen(Imagen){
        console.log(Imagen);
        let xhr = new XMLHttpRequest();
        let data = `Imagen=${Imagen}`;
        let image = document.querySelector('#modal_ver_imagen img');
        image.style.display = "none";
        image.src = "";
        let link = document.querySelector('#modal_ver_imagen a');
        link.href = "";
        xhr.open('POST', "../Imagen/getOne");
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        image.src = json_app.Objeto;
                        image.style.display = "block";
                        link.href = json_app.Objeto;
                        link.download = json_app.Archivo;
                        $('#modal_ver_imagen').modal('show');
                    }
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    deleteImagen(Imagen){
        let xhr = new XMLHttpRequest();
        let data = `Imagen=${Imagen}`;
        let form = document.querySelector('#modal_delete_imagen form');
        let tabla = form.querySelectorAll('input')[1].value;
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
        //let content_imagen = form.querySelector('.imagen');
        xhr.open('POST', "../Imagen/delete");
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        if (tabla == 'RAL') {
                            xhr.clase.cargarCapturasRAL(json_app.capturas_ral, json_app.display);
                        }else if(tabla == 'Candidatos_Ubicacion' || tabla == 'Candidatos_Vivienda'){
                            xhr.clase.cargarUbicacionFotos(json_app.ubicacion_exterior, json_app.ubicacion_no_exterior, json_app.ubicacion_interior, json_app.ubicacion, json_app.vivienda);
                        }else if (tabla == 'Candidatos') {
                            xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        }else if(tabla == 'Documentos'){
                            xhr.clase.cargarDocumentos(json_app.documentos, json_app.display);
                        }
                        
                        utils.showToast('Se eliminó la imagen', 'success');
                        $('#modal_delete_imagen').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    getDatosContacto(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        document.querySelectorAll('#modal_contacto form .btn')[1].disabled = false;
        xhr.open('POST', '../Datos/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_contacto');
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = json_app.Telefono_fijo;
                        form.querySelectorAll('input')[2].value = json_app.Celular;
                        form.querySelectorAll('input')[3].value = json_app.Otro_Contacto;
                        form.querySelectorAll('input')[4].value = json_app.Correos;
                        form.querySelectorAll('input')[5].value = json_app.Linkedin;
                        form.querySelectorAll('input')[6].value = json_app.Facebook;
                        
                        form.querySelectorAll('input')[7].value = json_app.Domicilio;
                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_contacto(){
        var form = document.querySelector("#modal_contacto form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Datos/save_contacto');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarContacto(json_app, json_app.display);
                        utils.showToast('Datos de contacto actualizados exitosamente', 'success');
                        $('#modal_contacto').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getEscolaridad(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_escolaridad');
        document.querySelectorAll('#modal_escolaridad form .btn')[1].disabled = false;
        xhr.open('POST', '../Escolaridad/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Grado;
                        form.querySelectorAll('input')[3].value = json_app.Institucion;
                        form.querySelectorAll('input')[4].value = json_app.Localidad;
                        form.querySelectorAll('input')[5].value = json_app.Periodo;
                        form.querySelectorAll('select')[1].value = json_app.Documento;
                        form.querySelectorAll('input')[6].value = json_app.Folio;
                        form.querySelector('textarea').value = json_app.Comentario_Escolaridad;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_escolaridad(){
        var form = document.querySelector("#modal_escolaridad form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Escolaridad/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let comentario = json_app[json_app.length -2].Comentario_Escolaridad;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarEscolaridad(json_app, comentario);
                        
                        utils.showToast('Escolaridad actualizada exitosamente', 'success');
                        $('#modal_escolaridad').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getReferenciaLaboral(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        document.querySelectorAll('#modal_referencia_laboral form .btn')[1].disabled = false;
        xhr.open('POST', '../ReferenciaLaboral/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_referencia_laboral');
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Empresa;
                        form.querySelectorAll('input')[4].value = json_app.Giro;
                        form.querySelectorAll('input')[5].value = json_app.Domicilio;
                        form.querySelectorAll('input')[6].value = json_app.Telefono;
                        form.querySelectorAll('input')[7].value = json_app.Fecha_Ingreso;
                        form.querySelectorAll('input')[8].value = json_app.Fecha_Baja;
                        form.querySelectorAll('input')[9].value = json_app.Puesto_Inicial;
                        form.querySelectorAll('input')[10].value = json_app.Puesto_Final;
                        form.querySelectorAll('input')[11].value = json_app.Jefe;
                        form.querySelectorAll('input')[12].value = json_app.Puesto_Jefe;
                        form.querySelectorAll('input')[13].value = json_app.Motivo_Separacion;
                        form.querySelectorAll('select')[0].value = json_app.Dopaje;
                        form.querySelectorAll('select')[1].value = json_app.Recontratable;
                        form.querySelectorAll('textarea')[0].value = json_app.Recontratable_PorQue;
                        form.querySelectorAll('input')[14].value = json_app.Informante;
                        form.querySelectorAll('textarea')[1].value = json_app.Comentarios;
                        form.querySelectorAll('select')[2].value = json_app.Calif;
                        form.querySelectorAll('select')[3].value = json_app.Desempeno;
                        form.querySelectorAll('select')[4].value = json_app.Honradez;
                        form.querySelectorAll('select')[5].value = json_app.Puntualidad;
                        form.querySelectorAll('select')[6].value = json_app.Relacion;
                        form.querySelectorAll('select')[7].value = json_app.Responsabilidad;
                        form.querySelectorAll('select')[8].value = json_app.Adaptacion;
                        
                        form.querySelectorAll('select')[9].value = json_app.Sindicalizado;
                        form.querySelectorAll('input')[15].value = json_app.Sindicato;
                        form.querySelectorAll('select')[10].value = json_app.Comite_Sindical;
                        form.querySelectorAll('input')[16].value = json_app.Puesto_Sindical;
                        form.querySelectorAll('input')[17].value = json_app.Funciones_Sindicato;
                        form.querySelectorAll('input')[18].value = json_app.Tiempo_Sindicato;

                        if (json_app.Calif == 1)
                            form.querySelector('.calif').style.display = "none";
                        
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_referencia_laboral(){
        var form = document.querySelector("#modal_referencia_laboral form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ReferenciaLaboral/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarReferenciasLaborales(json_app, display);
                        utils.showToast('Referencia laboral actualizada exitosamente', 'success');
                        $('#modal_referencia_laboral').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}else{
                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                form.querySelectorAll('.btn')[1].disabled = false;
            }
		}
	}

	update_referencia_laboral_renglon(arrayRenglon, candidato) {

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ReferenciaLaboral/updateRenglon');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('arrayRenglon=' + arrayRenglon + '&' + 'candidato=' + candidato);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                       
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');

                        let i=0;
                        json_app.laborales.forEach(element => {
                            document.querySelectorAll('div .referencia_laboral_class')[i].setAttribute('renglon',i+1)
                            document.querySelectorAll('div .referencia_laboral_class')[i].children[1].setAttribute('data-id',i+1)//btn eliminar
                            document.querySelectorAll('div .referencia_laboral_class')[i].children[2].setAttribute('data-id',i+1)//btn actualizar
                            i++
                        })

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
	
    delete_referencia_laboral(){
        var form = document.querySelector("#modal_delete_referencia_laboral form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ReferenciaLaboral/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarReferenciasLaborales(json_app, display);
                        utils.showToast('Se eliminó la referencia laboral exitosamente', 'success');
                        $('#modal_delete_referencia_laboral').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}else{
                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                form.querySelectorAll('.btn')[1].disabled = false;
            }
		}
	}


    update_investigacion(){
        var form = document.querySelector("#update-investigacion-form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../InvestigacionLaboral/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0)
                        utils.showToast('Omitiste algún dato','error');
                    else if (json_app.status == 1){
                        xhr.clase.cargarInvestigacion(json_app, json_app.display);
                        
                        utils.showToast('Investigación laboral actualizada exitosamente', 'success');
                        $('#modal_investigacion').modal('hide');
                    }else if(json_app.status == 2)
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    else
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                }
			}
		}
	}

    getComentariosGeneralesInv(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentarios_generales_inv form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../ObservacionesGenerales/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Info_Proporcionada_Candidato;
                        form.querySelectorAll('select')[1].value = json_app.Referencias_Laborales;
                        form.querySelectorAll('select')[2].value = json_app.Info_Confiable;
                        form.querySelector('textarea').value = json_app.Comentario_General_il;
                        form.querySelectorAll('select')[3].value = `${json_app.Viable}`;
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_comentarios_generales_inv(){
        var form = document.querySelector("#modal_comentarios_generales_inv form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ObservacionesGenerales/save_comentarios_generales_inv');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarComentariosGeneralesInv(json_app, json_app.display);
                        xhr.clase.cargarComentariosGenerales(json_app, json_app.display);
                        utils.showToast('Comentarios generales de la investigación actualizados exitosamente', 'success');
                        $('#modal_comentarios_generales_inv').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getConociendoCandidato(folio){
        this.folio = folio;
        let xhr = new XMLHttpRequest();
        let data = `Folio=${this.folio}`;
        let conociendo_form = document.querySelector('#update-conociendo-form');
        document.querySelectorAll('#update-conociendo-form .btn')[1].disabled = false;
        xhr.open('POST', '../ConociendoCandidato/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        conociendo_form.querySelector('.Folio').value = json_app.Candidato;
                        conociendo_form.querySelector("#Interes_Puesto").value = json_app.Interes_Puesto;
                        conociendo_form.querySelector("#Que_Esperas_Lograr").value = json_app.Que_Esperas_Lograr;
                        conociendo_form.querySelector('#Caracteristicas_Empleo').value = json_app.Caracteristicas_Empleo;
                        conociendo_form.querySelector('#Objetivo_Laboral').value = json_app.Objetivo_Laboral;
                        conociendo_form.querySelector('#Que_Esperas_Empresa').value = json_app.Que_Esperas_Empresa;
                        conociendo_form.querySelector('#Cualidades').value = json_app.Cualidades;
                        conociendo_form.querySelector('#Trabajo_Equipo').value = json_app.Trabajo_Equipo;
                        conociendo_form.querySelector('#Ultimos_Jefes').value = json_app.Ultimos_Jefes;
                        conociendo_form.querySelector('#Que_Esperas_Aportar').value = json_app.Que_Esperas_Aportar;
                        conociendo_form.querySelector('#Jornada_Laboral').value = json_app.Jornada_Laboral;
                        conociendo_form.querySelector('#Motivacion').value = json_app.Motivacion;
                        conociendo_form.querySelector('#Que_Dirian_Jefes_Anteriores').value = json_app.Que_Dirian_Jefes_Anteriores;
                        conociendo_form.querySelector('#Orgullo_Trayectoria_Laboral').value = json_app.Orgullo_Trayectoria_Laboral;
                        conociendo_form.querySelector('#No_Te_Gusto_Empleos_Anteriores').value = json_app.No_Te_Gusto_Empleos_Anteriores;
                        conociendo_form.querySelector('#Estas_Otros_Procesos').value = json_app.Estas_Otros_Procesos;

                        conociendo_form.querySelector('#conociendo').value = 1;
                    }else {
                        conociendo_form.querySelector('.Folio').value = folio;
                        conociendo_form.querySelector('#conociendo').value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    update_conociendo(){
        var form = document.querySelector("#update-conociendo-form");
		var formData = new FormData(form);
        var btn = form.querySelectorAll('.btn')[1];
        btn.disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ConociendoCandidato/save');
		xhr.send(formData);
        xhr.clase = this;
        xhr.disabled = btn.disabled;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    this.circulo = json_app;
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        xhr.disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarConociendoCandidato(json_app, json_app.display);
                        utils.showToast('Sección de "conociendo candidato" actualizada exitosamente', 'success');
                        $('#modal_conociendo').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        xhr.disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        xhr.disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    xhr.disabled = false;
                }
                
			}
		}
	}

    getCohabitante(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        document.querySelectorAll('#cohabitante-form .btn')[1].disabled = false;
        xhr.open('POST', '../Cohabitante/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_cohabitante');
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Nombre;
                        form.querySelectorAll('select')[0].value = json_app.Parentesco;
                        form.querySelectorAll('input')[4].value = json_app.Edad;
                        form.querySelectorAll('select')[1].value = json_app.Edad_2;
                        form.querySelectorAll('select')[2].value = json_app.Estado_Civil;
                        form.querySelectorAll('input')[5].value = json_app.Ocupacion;
                        form.querySelectorAll('input')[6].value = json_app.Empresa;

                        if (json_app.Dependiente == 0)
                            form.querySelectorAll('input[type=radio]')[1].checked = true;
                        else
                            form.querySelectorAll('input[type=radio]')[0].checked = true;
                        form.querySelectorAll('input')[9].value = json_app.Telefono;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    update_cohabitante(){
        var form = document.querySelector("#cohabitante-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cohabitante/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        let comentario = json_app[json_app.length -3].Comentario_Cohabitan;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarCohabitantes(json_app, display, comentario);
                        
                        utils.showToast('Cohabitante actualizado exitosamente', 'success');
                        $('#modal_cohabitante').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_cohabitante(){
        var form = document.querySelector("#cohabitante-delete-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cohabitante/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarCohabitantes(json_app, display);
                        utils.showToast('Se eliminó al cohabitante exitosamente', 'success');
                        $('#modal_delete_cohabitante').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getComentarioCohabitan(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentario_cohabitan form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Cohabitante/getComentario');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    form.querySelectorAll('input')[0].value = folio;
                    form.querySelector('textarea').value = r;

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_comentario_cohabitan(){
        var form = document.querySelector("#modal_comentario_cohabitan form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Cohabitante/save_comentario');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        let comentario = json_app[json_app.length - 3].Comentario_Cohabitan;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarCohabitantes(json_app, display, comentario);
                        utils.showToast('Comentarios actualizados exitosamente', 'success');
                        $('#modal_comentario_cohabitan').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getComentarioDocumentacion(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentario_documentacion form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Imagen/getComentario');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('textarea')[0].value = json_app.Comentario_Documentos;
                        form.querySelectorAll('textarea')[1].value = json_app.Redes_Sociales;
                    }

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_comentario_documentacion(){
        var form = document.querySelector("#modal_comentario_documentacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Imagen/save_comentario');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarDocumentos(json_app.documentos, json_app.display, json_app.Comentario_Documentos, json_app.Redes_Sociales);
                        utils.showToast('Comentarios actualizados exitosamente', 'success');
                        $('#modal_comentario_documentacion').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getCirculoFamiliar(id){
        this.id = id;
        let xhr = new XMLHttpRequest();
        let data = `Id=${this.id}`;
        document.querySelectorAll('#circulo_familiar-form .btn')[1].disabled = false;
        xhr.open('POST', '../CirculoFamiliar/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_circulo-familiar');
                        form.querySelectorAll('input')[0].value = json_app.Id;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Nombre_Parentesco;
                        form.querySelectorAll('select')[0].value = json_app.Parentesco;
                        form.querySelectorAll('input')[4].value = json_app.Telefono_Parentesco;
                        if (json_app.Estatus == 'Finado')
                            form.querySelectorAll('input[type=radio]')[1].checked = true;
                        else
                            form.querySelectorAll('input[type=radio]')[0].checked = true;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    update_circulo_familiar(){
        var form = document.querySelector("#circulo_familiar-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../CirculoFamiliar/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarCirculoFamiliar(json_app, display);
                        
                        utils.showToast('Datos del familiar actualizados exitosamente', 'success');
                        $('#modal_circulo-familiar').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_circulo_familiar(){
        var form = document.querySelector("#circulo_familiar-delete-form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../CirculoFamiliar/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarCirculoFamiliar(json_app, display);
                        
                        utils.showToast('Se eliminó al miembro familiar exitosamente', 'success');
                        $('#modal_delete_circulo-familiar').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getHistorialSalud(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_historial_salud form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../HistorialSalud/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    form.querySelectorAll('input')[0].value = folio;
                    form.querySelectorAll('input')[1].value = json_app.historial_salud.status;
                    form.querySelectorAll('select')[0].value = json_app.historial_salud.Diabetes;
                    form.querySelectorAll('input')[2].value = json_app.historial_salud.Diabetes_Familiar;
                    form.querySelectorAll('select')[1].value = json_app.historial_salud.Cancer;
                    form.querySelectorAll('input')[3].value = json_app.historial_salud.Cancer_Familiar;
                    form.querySelectorAll('select')[2].value = json_app.historial_salud.Hipertension;
                    form.querySelectorAll('input')[4].value = json_app.historial_salud.Hipertension_Familiar;
                    form.querySelectorAll('select')[3].value = json_app.historial_salud.Disfuncion_Renal;
                    form.querySelectorAll('input')[5].value = json_app.historial_salud.Disfuncion_Renal_Familiar;
                    form.querySelectorAll('select')[4].value = json_app.historial_salud.Fibrosis_Quistica;
                    form.querySelectorAll('input')[6].value = json_app.historial_salud.Fibrosis_Quistica_Familiar;
                    form.querySelectorAll('select')[5].value = json_app.historial_salud.Miopia;
                    form.querySelectorAll('input')[7].value = json_app.historial_salud.Miopia_Familiar;
                    form.querySelectorAll('select')[6].value = json_app.historial_salud.Asma;
                    form.querySelectorAll('input')[8].value = json_app.historial_salud.Asma_Familiar;
                    form.querySelectorAll('select')[7].value = json_app.historial_salud.Migranas;
                    form.querySelectorAll('input')[9].value = json_app.historial_salud.Migranas_Familiar;
                    form.querySelectorAll('select')[8].value = json_app.historial_salud.Esclerosis_Multiple;
                    form.querySelectorAll('input')[10].value = json_app.historial_salud.Esclerosis_Multiple_Familiar;
                    form.querySelectorAll('select')[9].value = json_app.historial_salud.Fuma;
                    form.querySelectorAll('input')[11].value = json_app.historial_salud.Fuma_Cuanto;
                    form.querySelectorAll('select')[10].value = json_app.historial_salud.Bebe;
                    form.querySelectorAll('input')[12].value = json_app.historial_salud.Bebe_Frecuencia;
                    form.querySelectorAll('select')[11].value = json_app.historial_salud.Consume_Droga;
                    form.querySelectorAll('input')[13].value = json_app.historial_salud.Cual_Droga;
                    form.querySelectorAll('select')[12].value = json_app.historial_salud.Deportes;
                    form.querySelectorAll('input')[14].value = json_app.historial_salud.Deportes_Frecuencia;

                    for (let i = 0; i < form.querySelectorAll('input[type=checkbox]').length; i++) {
                        for (let j = 0; j < json_app.seguros.length; j++) {
                            if (form.querySelectorAll('input[type=checkbox]')[i].value == json_app.seguros[j]['Servicio_Medico']) {
                                form.querySelectorAll('input[type=checkbox]')[i].checked = true;
                            }
                        }
                    }

                    const selects_salud = form.querySelectorAll('select');
                    const inputs_salud = form.querySelectorAll('input');

                    for (let i = 0; i < selects_salud.length; i++) {
                        if (selects_salud[i].value == "Si" || selects_salud[i].value == 1)
                            inputs_salud[i + 2].parentElement.style.display = "block";
                        else if (selects_salud[i].value == "No" || selects_salud[i].value == 0)
                            inputs_salud[i + 2].parentElement.style.display = "none";
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_historial_salud(){
        var form = document.querySelector("#modal_historial_salud form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../HistorialSalud/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato','warning');
                    } else{
                        let json_app = JSON.parse(r);
                        if (json_app.salud.status == 2) {
                            utils.showToast('Hubo un error al guardar el historial de salud, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.salud.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = true;
                            xhr.clase.cargarHistorialSalud(json_app.salud, json_app.seguros);
                            utils.showToast('Historial de salud guardado exitosamente', 'success');
                            $('#modal_historial_salud').modal('hide');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else{
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getUbicacion(folio){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        document.querySelectorAll('#modal_ubicacion form .btn')[1].disabled = false;
        xhr.open('POST', '../Ubicacion/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    let form = document.querySelector('#modal_ubicacion form');
                    form.querySelectorAll('input')[0].value = folio;
                    form.querySelectorAll('input')[1].value = json_app.ubicacion.status;
                    form.querySelectorAll('input')[2].value = json_app.vivienda.status;
                    if (json_app.vivienda.status == 1) {
                        form.querySelectorAll('input')[3].value = json_app.vivienda.Tiempo_Viviendo;
                    }
                    if (json_app.ubicacion.status == 1) {
                        form.querySelectorAll('input')[4].value = json_app.ubicacion.Calle;
                        form.querySelectorAll('input')[5].value = json_app.ubicacion.Exterior;
                        form.querySelectorAll('input')[6].value = json_app.ubicacion.Interior;
                        form.querySelectorAll('input')[7].value = json_app.ubicacion.Colonia;
                        form.querySelectorAll('input')[8].value = json_app.ubicacion.Entre_Calles;
                        form.querySelectorAll('input')[9].value = json_app.ubicacion.Municipio;
                        form.querySelectorAll('select')[0].value = json_app.ubicacion.id_estado;
                        form.querySelectorAll('input')[10].value = json_app.ubicacion.Codigo_Postal;
                        form.querySelectorAll('input')[11].value = json_app.ubicacion.Fachada;
						form.querySelectorAll('input')[20].value = json_app.ubicacion.Maps;
                    }
                    if (json_app.vivienda.status == 1) {
                        form.querySelectorAll('select')[1].value = json_app.vivienda.Tipo_Vivienda;
                        form.querySelectorAll('input')[12].value = json_app.vivienda.Plantas;
                        form.querySelectorAll('input')[13].value = json_app.vivienda.Sanitarios;
                        form.querySelectorAll('input')[14].value = json_app.vivienda.Recamaras;
                        form.querySelectorAll('input')[15].value = json_app.vivienda.Capacidad_Cochera;
                        form.querySelectorAll('select')[2].value = json_app.vivienda.Domicilio_es;
                        form.querySelectorAll('input')[16].value = json_app.vivienda.Propietario;
                        form.querySelectorAll('input')[17].value = json_app.vivienda.Parentesco;
                        form.querySelectorAll('input')[18].value = json_app.vivienda.Telefono_Parentesco;
						form.querySelectorAll('select')[3].value = json_app.vivienda.Contrato_Arrendamiento;
                        form.querySelectorAll('input')[19].value = json_app.vivienda.Tiempo_Contrato;
                    }
					
					form.querySelectorAll('textarea')[0].value = json_app.comentario.Comentario_Vivienda;
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_ubicacion(){
        var form = document.querySelector("#modal_ubicacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Ubicacion/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato','warning');
                    } else{
                        let json_app = JSON.parse(r);
                        if (json_app.ubicacion.status == 1 && json_app.vivienda.status == 2) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.querySelectorAll('input')[2].value = 0;
                            utils.showToast('Hubo un error al guardar los datos de la vivienda del candidato, intenta de nuevo.', 'error');
                        } else if (json_app.ubicacion.status == 2 && json_app.vivienda.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.querySelectorAll('input')[1].value = 0;
                            utils.showToast('Hubo un error al guardar los datos de la ubicación del candidato, intenta de nuevo.', 'error');
                        } else if (json_app.ubicacion.status == 2 && json_app.vivienda.status == 2) {
                            form.querySelectorAll('.btn')[1].disabled = false;
                            form.querySelectorAll('input')[1].value = 0;
                            form.querySelectorAll('input')[2].value = 0;
                            utils.showToast('Hubo un error al guardar los datos del candidato, intenta de nuevo.', 'error');
                        } else if (json_app.ubicacion.status == 1 && json_app.vivienda.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = true;
                            xhr.clase.cargarUbicacion(json_app.ubicacion, json_app.vivienda, json_app.comentario);
                            utils.showToast('Datos de la ubicación y vivienda del candidato actualizados exitosamente', 'success');
                            $('#modal_ubicacion').modal('hide');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else{
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getEnseres(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_enseres form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Enseres/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Computadoras;
                        form.querySelectorAll('input')[3].value = json_app.Pantallas;
                        form.querySelectorAll('input')[4].value = json_app.Laptop;
                        form.querySelectorAll('input')[5].value = json_app.Impresoras;
                        form.querySelectorAll('input')[6].value = json_app.Refrigerador;
                        form.querySelectorAll('input')[7].value = json_app.Estufa;
                        form.querySelectorAll('input')[8].value = json_app.Aire_Acondicionado;
                        form.querySelectorAll('input')[9].value = json_app.Lavadora;
                        form.querySelectorAll('input')[10].value = json_app.Secadora;
                        form.querySelectorAll('input')[11].value = json_app.Otros;
                        form.querySelectorAll('select')[0].value = json_app.Mobiliario;
                        form.querySelector('textarea').value = json_app.Comentarios;
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_enseres(){
        var form = document.querySelector("#modal_enseres form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Enseres/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato','warning');
                    } else{
                        let json_app = JSON.parse(r);
                        if (json_app.status == 2) {
                            utils.showToast('Hubo un error al guardar los datos de los enseres, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = true;
                            xhr.clase.cargarEnseres(json_app);
                            utils.showToast('Datos de los enseres actualizados exitosamente', 'success');
                            $('#modal_enseres').modal('hide');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else{
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}


    getIngreso(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_ingreso');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Ingreso/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Aporta;
                        form.querySelectorAll('input')[4].value = json_app.Fuente;
                        form.querySelectorAll('input')[5].value = Math.round(json_app.Monto);

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_ingreso(){
        var form = document.querySelector("#modal_ingreso form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Ingreso/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarEconomiaFamiliar(json_app.ingresos, json_app.egresos, json_app.display);
                        utils.showToast('Ingreso guardado exitosamente', 'success');
                        $('#modal_ingreso').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_ingreso(){
        var form = document.querySelector("#modal_delete_ingreso form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Ingreso/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarEconomiaFamiliar(json_app.ingresos, json_app.egresos, json_app.display);
                        utils.showToast('Se eliminó el ingreso exitosamente', 'success');
                        $('#modal_delete_ingreso').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    addEgreso(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_egreso form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Egreso/getEgresosPorCompletarCandidato');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let data = '';
                        json_app.forEach(element => {
                            data += `<option value="${element.Campo}">${element.Descripcion}</option>`;
                        });
                        form.querySelectorAll('select')[0].innerHTML = data;
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                        form.querySelectorAll('input')[2].value = 0;

                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getEgreso(egreso){
        this.egreso = egreso;
        let xhr = new XMLHttpRequest();
        let data = `Egreso=${this.egreso}&Folio=${folio}`;
        let form = document.querySelector('#modal_egreso form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Egreso/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        
                        form.querySelectorAll('select')[0].innerHTML = `<option value="${json_app.Egreso}">${json_app.Descripcion}</option>`;
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = Math.round(json_app.Monto);

                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    save_egreso(){
        var form = document.querySelector("#modal_egreso form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Egreso/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarEconomiaFamiliar(json_app.ingresos, json_app.egresos, json_app.display);
                        utils.showToast('Egreso guardado exitosamente', 'success');
                        $('#modal_egreso').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_egreso(){
        var form = document.querySelector("#modal_delete_egreso form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Egreso/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarEconomiaFamiliar(json_app.ingresos, json_app.egresos, json_app.display);
                        utils.showToast('Se eliminó el egreso exitosamente', 'success');
                        $('#modal_delete_egreso').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getComentarioEconomia(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentario_economia form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Egreso/getComentario');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 2) {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelector('textarea').value = r;
                        $('#modal_comentario_economia').modal({backdrop: 'static', keyboard: false});
                    }
                    else{
                        utils.showToast('Los egresos no pueden ser mayores a los ingresos. Verifica, por favor', 'warning');
                    }

                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_comentario_economia(){
        var form = document.querySelector("#modal_comentario_economia form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Egreso/save_comentario');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarEconomiaFamiliar(json_app.ingresos, json_app.egresos, json_app.display, json_app.Comentario_Economia);
                        utils.showToast('Comentarios actualizados exitosamente', 'success');
                        $('#modal_comentario_economia').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}
	
	getINFONAVIT(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_INFONAVIT form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../ServicioApoyo/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.INFONAVIT;
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_INFONAVIT(){
        var form = document.querySelector("#modal_INFONAVIT form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Credito/save_INFONAVIT');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Guardado', 'success');
                        $('#modal_INFONAVIT').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getCredito(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_credito');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Credito/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Institucion;
                        form.querySelectorAll('input')[4].value = json_app.Limite_Credito;
                        form.querySelectorAll('input')[5].value = json_app.Saldo_Actual;
                        form.querySelectorAll('input')[6].value = json_app.Vencimiento;
                        form.querySelectorAll('input')[7].value = json_app.Abono_Mensual;

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_credito(){
        var form = document.querySelector("#modal_credito form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Credito/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Crédito guardado exitosamente', 'success');
                        $('#modal_credito').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_credito(){
        var form = document.querySelector("#modal_delete_credito form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Credito/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Se eliminó el crédito exitosamente', 'success');
                        $('#modal_delete_credito').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getBancaria(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_bancaria');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../CuentaBancaria/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Institucion;
                        form.querySelectorAll('input')[4].value = json_app.Tipo_Cuenta;
                        form.querySelectorAll('input')[5].value = json_app.Objetivo;
                        form.querySelectorAll('input')[6].value = json_app.Deposito_Mensual;

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_bancaria(){
        var form = document.querySelector("#modal_bancaria form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../CuentaBancaria/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Cuenta bancaria guardada exitosamente', 'success');
                        $('#modal_bancaria').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_bancaria(){
        var form = document.querySelector("#modal_delete_bancaria form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../CuentaBancaria/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Se eliminó la cuenta bancaria exitosamente', 'success');
                        $('#modal_delete_bancaria').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getSeguro(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_seguro');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Seguro/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Institucion;
                        form.querySelectorAll('input')[4].value = json_app.Tipo_Seguro;
                        form.querySelectorAll('input')[5].value = json_app.Forma_Pago;
                        form.querySelectorAll('input')[6].value = json_app.Prima;
                        form.querySelectorAll('input')[7].value = json_app.Vigencia

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_seguro(){
        var form = document.querySelector("#modal_seguro form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Seguro/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Seguro guardado exitosamente', 'success');
                        $('#modal_seguro').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_seguro(){
        var form = document.querySelector("#modal_delete_seguro form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Seguro/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionFinanciera(json_app.creditos, json_app.cuentas, json_app.seguros, json_app.INFONAVIT, json_app.display);
                        utils.showToast('Se eliminó el seguro exitosamente', 'success');
                        $('#modal_delete_seguro').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getInmueble(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_inmueble');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Inmueble/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Tipo_Inmueble;
                        form.querySelectorAll('input')[4].value = json_app.Ubicacion;
                        form.querySelectorAll('input')[5].value = json_app.Valor;
                        form.querySelectorAll('select')[0].value = json_app.Pagado;
                        form.querySelectorAll('input')[6].value = json_app.Abono_Mensual

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_inmueble(){
        var form = document.querySelector("#modal_inmueble form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Inmueble/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionPatrimonial(json_app.inmuebles, json_app.vehiculos, json_app.display);
                        utils.showToast('Inmueble guardado exitosamente', 'success');
                        $('#modal_inmueble').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_inmueble(){
        var form = document.querySelector("#modal_delete_inmueble form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Inmueble/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionPatrimonial(json_app.inmuebles, json_app.vehiculos, json_app.display);
                        utils.showToast('Se eliminó el inmueble exitosamente', 'success');
                        $('#modal_delete_inmueble').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getVehiculo(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        let form = document.querySelector('#modal_vehiculo');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../Vehiculo/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        console.log(json_app);
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('input')[3].value = json_app.Marca;
                        form.querySelectorAll('input')[4].value = json_app.Modelo;
                        form.querySelectorAll('input')[5].value = json_app.Valor;
                        form.querySelectorAll('select')[0].value = json_app.Pagado;
                        form.querySelectorAll('input')[6].value = json_app.Abono_Mensual

                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_vehiculo(){
        var form = document.querySelector("#modal_vehiculo form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Vehiculo/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionPatrimonial(json_app.inmuebles, json_app.vehiculos, json_app.display);
                        utils.showToast('Vehículo guardado exitosamente', 'success');
                        $('#modal_vehiculo').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_vehiculo(){
        var form = document.querySelector("#modal_delete_vehiculo form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Vehiculo/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInformacionPatrimonial(json_app.inmuebles, json_app.vehiculos, json_app.display);
                        utils.showToast('Se eliminó el vehículo exitosamente', 'success');
                        $('#modal_delete_vehiculo').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getConclusiones(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_conclusiones form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../ObservacionesGenerales/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Sobre_Candidato;
                        form.querySelectorAll('input')[3].value = json_app.Sobre_Casa;
                        form.querySelectorAll('input')[4].value = json_app.Conclusiones_Entrevistador;
                        form.querySelectorAll('select')[0].value = json_app.Participacion_Candidato;
                        form.querySelectorAll('select')[1].value = json_app.Entorno_Familiar;
                        form.querySelectorAll('select')[2].value = json_app.Referencias_Vecinales;
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                        
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_conclusiones(){
        var form = document.querySelector("#modal_conclusiones form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ObservacionesGenerales/save_conclusiones');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    if (r == 0) {
                        utils.showToast('Omitiste algún dato','warning');
                    } else{
                        let json_app = JSON.parse(r);
                        if (json_app.status == 2) {
                            utils.showToast('Hubo un error al guardar las conclusiones, intenta de nuevo.', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else if (json_app.status == 1) {
                            form.querySelectorAll('.btn')[1].disabled = true;
                            xhr.clase.cargarConclusiones(json_app, json_app.display);
                            utils.showToast('Conclusiones actualizadas exitosamente', 'success');
                            $('#modal_conclusiones').modal('hide');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        } else{
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            form.querySelectorAll('.btn')[1].disabled = false;
                        }
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}


    getReferencia(renglon){
        this.renglon = renglon;
        let xhr = new XMLHttpRequest();
        let data = `Renglon=${this.renglon}&Folio=${folio}`;
        document.querySelectorAll('#modal_referencia form .btn')[1].disabled = false;
        xhr.open('POST', '../Referencia/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_referencia');
                        form.querySelectorAll('input')[0].value = json_app.Renglon;
                        form.querySelectorAll('input')[1].value = json_app.Candidato;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('select')[0].value = json_app.Tipo;
                        form.querySelectorAll('input')[3].value = json_app.Relacion;
                        form.querySelectorAll('input')[4].value = json_app.Nombre;
                        form.querySelectorAll('input')[5].value = json_app.Telefono;
                        form.querySelectorAll('input')[6].value = json_app.Domicilio;
                        form.querySelectorAll('input')[7].value = json_app.Domicilio_Candidato;
                        form.querySelectorAll('input')[8].value = json_app.Tiempo_Viviendo;
                        form.querySelectorAll('input')[9].value = json_app.Tiempo_Conocerlo;
                        form.querySelectorAll('input')[10].value = json_app.Tiene_Hijos;
                        form.querySelectorAll('input')[11].value = json_app.Dedicacion;
                        form.querySelectorAll('input')[12].value = json_app.Estado_Civil;
                        form.querySelector('textarea').value = json_app.Comentarios;
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_referencia(){
        var form = document.querySelector("#modal_referencia form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Referencia/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarReferencias(json_app, display);
                        
                        utils.showToast('Referencia actualizada exitosamente', 'success');
                        $('#modal_referencia').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    delete_referencia(){
        var form = document.querySelector("#modal_delete_referencia form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Referencia/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app[json_app.length - 1].status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app[json_app.length - 1].status == 1){
                        let display = json_app[json_app.length - 2].display;
                        json_app.splice(json_app.length -1, 1);
                        json_app.splice(json_app.length -1, 1);
                        xhr.clase.cargarReferencias(json_app, display);
                        
                        utils.showToast('Se eliminó la referencia exitosamente', 'success');
                        $('#modal_delete_referencia').modal('hide');
                    }else if(json_app[json_app.length - 1].status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    getComentariosGenerales(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_comentarios_generales form');
        form.querySelectorAll('.btn')[1].disabled = false;
        xhr.open('POST', '../ObservacionesGenerales/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
       xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelector('textarea').value = json_app.Comentarios_Generales;
                         //form.querySelectorAll('input')[2].value = json_app.Califica_como;
                        form.querySelectorAll('select')[0].value = `${json_app.Viabilidad}`;
                    }else{
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    save_comentarios_generales(){
        var form = document.querySelector("#modal_comentarios_generales form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ObservacionesGenerales/save_comentarios_generales');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarComentariosGenerales(json_app, json_app.display);
                        utils.showToast('Comentarios generales de la verificación actualizados exitosamente', 'success');
                        $('#modal_comentarios_generales').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    set_tipo_investigacion(tipo){
        if(tipo == 0)
            utils.showToast('Omitiste algún dato','error');
        else if (tipo == 1){
            //utils.showToast('Se actualizó el tipo de investigación a ordinaria', 'success');
            document.querySelector('#vert-tabs-escolaridad-tab').hidden = true;
            document.querySelector('#vert-tabs-cohabitantes-tab').hidden = true;
            document.querySelector('#vert-tabs-referenciass-tab').hidden = false;
            document.querySelector('#vert-tabs-escolaridad').hidden = true;
            document.querySelector('#vert-tabs-cohabitantes').hidden = true;
            document.querySelector('#vert-tabs-referenciass').hidden = false;
            document.querySelector('#Tipo_Investigacion').value = 1;
        }else if(tipo == 2){
            //utils.showToast('Se actualizó el tipo de investigación a completa', 'success');
            document.querySelector('#vert-tabs-escolaridad-tab').hidden = false;
            document.querySelector('#vert-tabs-cohabitantes-tab').hidden = false;
            document.querySelector('#vert-tabs-referenciass-tab').hidden = false;
            document.querySelector('#vert-tabs-escolaridad').hidden = false;
            document.querySelector('#vert-tabs-cohabitantes').hidden = false;
            document.querySelector('#vert-tabs-referenciass').hidden = false;
            document.querySelector('#Tipo_Investigacion').value = 2;
        }else
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
    }

    setNivelPuesto(Nivel, conociendo_candidato){
        if ((Nivel == 1 || Nivel == 4) && !conociendo_candidato){
            document.querySelector('#vert-tabs-conociendo-tab').hidden = true;
            document.querySelector('#vert-tabs-conociendo').hidden = true;
        }
    }

    setFaseVLF(Nivel, Empresa, Servicio_Solicitado){
		console.log(Empresa, Servicio_Solicitado);
        if (Empresa != 111 && Servicio_Solicitado != 'SOI' && Empresa != 167) {
            document.querySelector('a[href="#vlf"]').classList.remove('active');
            document.querySelector('#vlf').classList.remove('active');
            document.querySelector('a[href="#vlf"]').style.display = 'none';
            document.querySelector('#vlf').style.display = 'none';
        }else{
            document.querySelector('a[href="#vlf"]').style.display = 'block';
            document.querySelector('#nav-vlf').style.display = 'block';
            /* document.querySelectorAll('#modal_service form select')[1].innerHTML = `
                <option value="310">Validación de Licencia Federal (VLF)</option>
                <option value="298">Reporte de Antecedentes Legales (VLF + RAL)</option>
                <option value="299">Investigación Laboral (VLF + RAL + Inv. Lab.)</option>
                <option value="300">Estudio Socioeconómico (VLF + RAL + Inv. Lab. + Verificación)</option>
            `; */
        }
    }

    update_tipo_investigacion(folio){
        var select = document.querySelector("#Tipo_Investigacion").value;
		
		let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}&Tipo_Investigacion=${select}`
		xhr.open('POST', '../ServicioApoyo/update_type');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                try {
                    xhr.clase.set_tipo_investigacion(select);
                    if (select == 1)
                        utils.showToast('Se actualizó el tipo de investigación a ordinaria', 'success');
                    else
                        utils.showToast('Se actualizó el tipo de investigación a completa', 'success');
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                
			}
		}
	}

    setFase(data, display){
        if(data.Servicio == 298 || data.Servicio == 328){
            document.querySelector('a[href="#ral"]').classList.add('active');
            document.querySelector('#ral').classList.add('active');
        }else if (data.Servicio == 231 || data.Servicio == 299){
            document.querySelector('a[href="#investigacion"]').classList.add('active');
            document.querySelector('#investigacion').classList.add('active');
        }else if(data.Servicio == 230 || data.Servicio == 300 || data.Servicio == 324){
            document.querySelector('a[href="#estudio"]').classList.add('active');
            document.querySelector('#estudio').classList.add('active');
        }else if(data.Servicio == 310){
            document.querySelector('a[href="#vlf"]').classList.add('active');
            document.querySelector('#vlf').classList.add('active');
        }
        if (display.Logistics == 'block' && display.Account == 'none') {
            document.querySelector('a[href="#vlf"]').classList.remove('active');
            document.querySelector('#vlf').classList.remove('active');
            document.querySelector('a[href="#ral"]').classList.remove('active');
            document.querySelector('#ral').classList.remove('active');
            document.querySelector('a[href="#investigacion"]').classList.remove('active');
            document.querySelector('#investigacion').classList.remove('active');
            document.querySelector('a[href="#estudio"]').classList.add('active');
            document.querySelector('#estudio').classList.add('active');
        }
		
		if (data.Servicio == 291) {
            document.querySelector('#vert-tabs-busqueda_ral-tab').style.display = 'block';
            document.querySelector('#vert-tabs-busqueda_ral-tab').classList.add('active');
            document.querySelector('#vert-tabs-busqueda_ral').classList.add('show');
            document.querySelector('#vert-tabs-busqueda_ral').classList.add('active');
            document.querySelector('#vert-tabs-acerca_ral-tab').classList.remove('active');
            document.querySelector('#vert-tabs-acerca_ral').classList.remove('active');
            document.querySelector('a[href="#vert-tabs-acerca_ral"]').style.display = 'none';
            document.querySelector('a[href="#vert-tabs-capturas_ral"]').style.display = 'none';
            document.querySelector('a[href="#ral"]').classList.add('active');
            document.querySelector('#ral').classList.add('active');

            document.querySelector('a[href="#investigacion"]').classList.remove('active');
            document.querySelector('#investigacion').classList.remove('active');
            document.querySelector('a[href="#investigacion"]').style.display = 'none';
            document.querySelector('#investigacion').style.display = 'none';
            
            document.querySelector('a[href="#estudio"]').classList.remove('active');
            document.querySelector('#estudio').classList.remove('active');
            document.querySelector('a[href="#estudio"]').style.display = 'none';
            document.querySelector('#estudio').style.display = 'none';

			if (data.IL == null && (data.ID_Empresa == 452 || data.ID_Empresa == 214 || data.ID_Empresa == 232 || data.ID_Empresa == 220 || data.ID_Empresa == 248 || data.ID_Empresa == 143 || data.ID_Empresa == 302 || data.ID_Empresa == 284 || data.ID_Empresa == 162 || data.ID_Empresa == 139 || data.ID_Empresa == 112 || data.ID_Empresa == 58 || data.ID_Empresa == 410 || data.ID_Empresa == 127 || data.ID_Empresa == 126 || data.ID_Empresa == 107 || data.ID_Empresa == 93 || data.ID_Empresa == 77 || data.ID_Empresa == 335 || data.ID_Empresa == 213 || data.ID_Empresa == 142 || data.ID_Empresa == 110 || data.ID_Empresa == 7 || data.ID_Empresa == 432 || data.ID_Empresa == 430 || data.ID_Empresa == 418 || data.ID_Empresa == 322 || data.ID_Empresa == 227 || data.ID_Empresa == 161 || data.ID_Empresa == 6 || data.ID_Empresa == 296 || data.ID_Empresa == 235 || data.ID_Empresa == 154 || data.ID_Empresa == 85 || data.ID_Empresa == 24 || data.ID_Empresa == 328 || data.ID_Empresa == 242 || data.ID_Empresa == 163 || data.ID_Empresa == 114 || data.ID_Empresa == 100 || data.ID_Empresa == 359 || data.ID_Empresa == 320 || data.ID_Empresa == 212 || data.ID_Empresa == 108 || data.ID_Empresa == 32 || data.ID_Empresa == 325 || data.ID_Empresa == 263 || data.ID_Empresa == 223 || data.ID_Empresa == 200 || data.ID_Empresa == 157 || data.ID_Empresa == 140 || data.ID_Empresa == 341 || data.ID_Empresa == 81 || data.ID_Empresa == 183 || data.ID_Empresa == 79 || data.ID_Empresa == 25 || data.ID_Empresa == 415 || data.ID_Empresa == 416 || data.ID_Empresa == 353 || data.ID_Empresa == 252 || data.ID_Empresa == 407 || data.ID_Empresa == 399 || data.ID_Empresa == 372 || data.ID_Empresa == 405 || data.ID_Empresa == 184 || data.ID_Empresa == 336 || data.ID_Empresa == 27 || data.ID_Empresa == 25 || data.ID_Empresa == 197 || data.ID_Empresa == 109 || data.ID_Empresa == 413 || data.ID_Empresa == 76 || data.ID_Empresa == 222 || data.ID_Empresa == 17 || data.ID_Empresa == 31 || data.ID_Empresa == 30 || data.Cliente == 74 || data.Cliente == 475 || data.Cliente == 506 || data.ID_Empresa == 153 || data.ID_Empresa == 130 || data.ID_Empresa == 8 || data.ID_Empresa == 391 || data.ID_Empresa == 412 || data.ID_Empresa == 279 || data.ID_Empresa == 224 || data.Cliente == 453 ||data.ID_Empresa == 307 ||data.ID_Empresa == 389 || data.ID_Empresa == 103 || data.ID_Empresa == 180 || data.ID_Empresa == 87 || data.ID_Empresa == 388 || data.ID_Empresa == 292|| data.ID_Empresa == 365 || data.ID_Empresa == 195 || data.ID_Empresa == 274 || data.ID_Empresa == 369 || data.ID_Empresa == 339 || data.ID_Empresa == 382 || data.ID_Empresa == 356 || data.ID_Empresa == 381 || data.ID_Empresa == 45 || data.ID_Empresa == 61 || data.ID_Empresa == 35 || data.ID_Empresa == 179 || data.ID_Empresa == 33 || data.ID_Empresa == 193 || data.ID_Empresa == 168 || data.ID_Empresa == 215 || data.ID_Empresa == 190 || data.ID_Empresa == 144 || data.ID_Empresa == 257 || data.ID_Empresa == 268 || data.ID_Empresa == 39 || data.ID_Empresa == 301 || data.ID_Empresa == 9 || data.ID_Empresa == 314 || data.ID_Empresa == 52 || data.ID_Empresa == 147 || data.Cliente == 181 || data.Cliente == 42 || data.ID_Empresa == 115 || data.ID_Empresa == 277 || data.ID_Empresa == 368 || data.ID_Empresa == 351|| data.ID_Empresa == 165 || data.ID_Empresa == 18 || data.ID_Empresa == 82))
                document.querySelectorAll('.botones_continuar button')[0].style.display = 'block';
            if ((data.ESE == null && (data.ID_Empresa == 452 || data.ID_Empresa == 305 || data.ID_Empresa == 434 || data.ID_Empresa == 298 || data.ID_Empresa == 278 || data.ID_Empresa == 245 || data.ID_Empresa == 199 || data.ID_Empresa == 120 || data.ID_Empresa == 445 || data.ID_Empresa == 444 || data.ID_Empresa == 438 || data.ID_Empresa == 253 || data.ID_Empresa == 301 || data.ID_Empresa == 181 || data.ID_Empresa == 141 || data.ID_Empresa == 94 || data.ID_Empresa == 426 || data.ID_Empresa == 151 || data.ID_Empresa == 214 || data.ID_Empresa == 232 || data.ID_Empresa == 220 || data.ID_Empresa == 248 || data.ID_Empresa == 143 || data.ID_Empresa == 302 || data.ID_Empresa == 284 || data.ID_Empresa == 162 || data.ID_Empresa == 139 || data.ID_Empresa == 112 || data.ID_Empresa == 58 || data.ID_Empresa == 410 || data.ID_Empresa == 127 || data.ID_Empresa == 126 || data.ID_Empresa == 107 || data.ID_Empresa == 93 || data.ID_Empresa == 77 || data.ID_Empresa == 335 || data.ID_Empresa == 213 || data.ID_Empresa == 142 || data.ID_Empresa == 110 || data.ID_Empresa == 7 || data.ID_Empresa == 432 || data.ID_Empresa == 430 || data.ID_Empresa == 418 || data.ID_Empresa == 322 || data.ID_Empresa == 227 || data.ID_Empresa == 161 || data.ID_Empresa == 6 || data.ID_Empresa == 296 || data.ID_Empresa == 235 || data.ID_Empresa == 154 || data.ID_Empresa == 85 || data.ID_Empresa == 24 || data.ID_Empresa == 328 || data.ID_Empresa == 247 || data.ID_Empresa == 242 || data.ID_Empresa == 163 || data.ID_Empresa == 114 || data.ID_Empresa == 100 || data.ID_Empresa == 359 || data.ID_Empresa == 320 || data.ID_Empresa == 212 || data.ID_Empresa == 108 || data.ID_Empresa == 32 || data.ID_Empresa == 325 || data.ID_Empresa == 263 || data.ID_Empresa == 223 || data.ID_Empresa == 200 || data.ID_Empresa == 157 || data.ID_Empresa == 140 || data.ID_Empresa == 341 || data.ID_Empresa == 81 || data.ID_Empresa == 183 || data.ID_Empresa == 79 || data.ID_Empresa == 25 || data.ID_Empresa == 415 || data.ID_Empresa == 416 || data.ID_Empresa == 353 || data.ID_Empresa == 252 || data.ID_Empresa == 407 || data.ID_Empresa == 399 || data.ID_Empresa == 372 || data.ID_Empresa == 405 || data.ID_Empresa == 184 || data.ID_Empresa == 336 || data.ID_Empresa == 27 || data.ID_Empresa == 25 || data.ID_Empresa == 197 || data.ID_Empresa == 109 || data.ID_Empresa == 413 || data.ID_Empresa == 76 ||data.ID_Empresa == 222 || data.ID_Empresa == 56 ||  data.ID_Empresa == 17 || data.ID_Empresa == 31 || data.ID_Empresa == 30 || data.Cliente == 74 || data.Cliente == 475 || data.Cliente == 506 || data.ID_Empresa == 153 || data.ID_Empresa == 130 ||data.ID_Empresa == 8 || data.ID_Empresa == 391 || data.ID_Empresa == 412 || data.ID_Empresa == 279 || data.ID_Empresa == 224 || data.Cliente == 453 ||data.ID_Empresa == 307 ||data.ID_Empresa == 389 ||data.ID_Empresa == 103 ||data.ID_Empresa == 167 || data.ID_Empresa == 87 || data.ID_Empresa == 388 || data.ID_Empresa == 292 || data.ID_Empresa == 260 || data.ID_Empresa == 365 || data.ID_Empresa == 339 || data.ID_Empresa == 274 || data.ID_Empresa == 369 || data.ID_Empresa == 195 || data.ID_Empresa == 382 || data.ID_Empresa == 356 || data.ID_Empresa == 381 || data.ID_Empresa == 45 || data.ID_Empresa == 61 || data.ID_Empresa == 35 || data.ID_Empresa == 33 || data.ID_Empresa == 304 || data.ID_Empresa == 15 || data.ID_Empresa == 111 || data.ID_Empresa == 102 || data.ID_Empresa == 22 || data.ID_Empresa == 319 || data.ID_Empresa == 46 || data.ID_Empresa == 193 || data.ID_Empresa == 168 || data.ID_Empresa == 36 || data.ID_Empresa == 225 || data.ID_Empresa == 196 || data.ID_Empresa == 329 || data.ID_Empresa == 215 || data.ID_Empresa == 144 || data.ID_Empresa == 257 || data.ID_Empresa == 277 || data.ID_Empresa == 14 || data.ID_Empresa == 268 || data.ID_Empresa == 39 || data.ID_Empresa == 9 || data.ID_Empresa == 295 || data.ID_Empresa == 314 || data.ID_Empresa == 40 || data.ID_Empresa == 273 || data.ID_Empresa == 315 || data.ID_Empresa == 52 || data.ID_Empresa == 350 || data.ID_Empresa == 147 || data.ID_Empresa == 267 || data.Cliente == 181 || data.Cliente == 42 || data.Cliente == 513 || data.Cliente == 193 || data.Cliente == 475 || data.Cliente == 245 || data.ID_Empresa == 115 || data.ID_Empresa == 131 || data.ID_Empresa == 92 || data.ID_Empresa == 351 || data.ID_Empresa == 159 || data.ID_Empresa == 368 || data.Cliente == 531 || data.ID_Empresa == 375 || data.ID_Empresa == 502 || data.ID_Empresa == 165 || data.ID_Empresa == 18)) || (data.ESE == null && display.Operations))
                document.querySelectorAll('.botones_continuar button')[1].style.display = 'block';
			if (data.A_RAL == 0 && data.ID_Empresa == 45)
                document.querySelectorAll('.botones_continuar button')[2].style.display = 'block';
            //if (data.Transportista == 1)
			if (data.ID_Empresa == 82 || data.Transportista == 1)
                document.querySelectorAll('.botones_continuar button')[3].style.display = 'inline-block';
        }
    }

    setServicioSolicitado(Servicio_Solicitado){
        if(Servicio_Solicitado == 'RAL' || Servicio_Solicitado == 'ANÁLISIS DE RAL'){
            document.querySelector('.card-tabs').classList.add('card-orange');
        }else if (Servicio_Solicitado == 'INV. LABORAL'){
            document.querySelector('.card-tabs').classList.add('card-danger');
        }else if(Servicio_Solicitado == 'ESE'){
            document.querySelector('.card-tabs').classList.add('card-navy');
        }else if(Servicio_Solicitado == 'VAL. LICENCIA FED.')
            document.querySelector('.card-tabs').classList.add('card-success');
		else if (Servicio_Solicitado == 'ESE + VISITA')
            document.querySelector('.card-tabs').classList.add('card-purple');
        else if (Servicio_Solicitado == 'SOI')
            document.querySelector('.card-tabs').classList.add('card-dark');
    }

    setDopajeLogimex(Cliente){
        if(Cliente == 314){
            document.querySelectorAll('#modal_referencia_laboral .form-group')[11].style.display = 'block';
        }
    }



    getComentarioCancelacion(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_cancelacion form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;
                        form.querySelector('textarea').value = json_app.Comentario_Cancelado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getAvanzarFase(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_avanzar form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    getComentarioFinalizacion(edo = 0){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_finalizacion form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;
                        form.querySelectorAll('textarea')[0].value = json_app.Comentario_Finalizado;
                        if (edo != 0) 
                            form.querySelectorAll('input')[2].value = edo;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
			}
        }
    }
	
	getComentarioPausado(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_pausar form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;
                        form.querySelectorAll('textarea')[0].value = json_app.Comentario_Pausa;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }
	
	getReanudacion(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_reanudar form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Servicio_Solicitado;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;
                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
			}
        }
    }

    getReactivar(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_reactivar form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Factura;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
			}
        }
    }

    getEliminar(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        xhr.open('POST', '../ServicioApoyo/getTipoServicio');
        let form = document.querySelector('#modal_eliminar form');
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
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = json_app.Factura;
                        form.querySelectorAll('input')[2].value = json_app.Fase;
                        form.querySelectorAll('input')[3].value = json_app.Estado;

                    }else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
			}
        }
    }

    save_cancelacion(){
        var form = document.querySelector("#modal_cancelacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_cancelacion');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio cancelado', 'success');
                        $('#modal_cancelacion').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 3){
                        utils.showToast('La viabilidad que designaste al candidato es distinta a la de tu ejecutivo de logística. Revisa de nuevo', 'warning');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    save_finalizacion(){
        var form = document.querySelector("#modal_finalizacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_finalizacion');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio finalizado', 'success');
                        $('#modal_finalizacion').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 3){
                        utils.showToast('La viabilidad que designaste al candidato es distinta a la de tu ejecutivo de logística. Revisa de nuevo', 'warning');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}
	
	save_pausa(){
        var form = document.querySelector("#modal_pausar form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_pausar');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio finalizado', 'success');
                        $('#modal_pausar').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}
	
	save_reanudar(){
        var form = document.querySelector("#modal_reanudar form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_reanudar');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Servicio reanudado', 'success');
                        $('#modal_reanudar').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    save_avanzar(){
        var form = document.querySelector("#modal_avanzar form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_avanzar');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Se avanzó de fase', 'success');
                        $('#modal_avanzar').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 3){
                        utils.showToast('La viabilidad que designaste al candidato es distinta a la de tu ejecutivo de logística. Revisa de nuevo', 'warning');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    reactivarServicio(){
        var form = document.querySelector("#modal_reactivar form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/reactivar');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Se reactivó el servicio', 'success');
                        $('#modal_reactivar').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    eliminarServicio(){
        var form = document.querySelector("#modal_eliminar form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/eliminar');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Se eliminó el servicio', 'success');
                        $('#modal_eliminar').modal('hide');
                        setTimeout("location.href='./index'", 3000);
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    save_localizacion(){
        var form = document.querySelector("#modal_localizacion form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/save_localizacion');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Localización actualizada exitosamente', 'success');
                        $('#modal_localizacion').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getLicencia(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_licencia form');
        xhr.open('POST', '../ValidacionLicencia/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Numero_Licencia;
                        form.querySelectorAll('input[type=checkbox]')[0].checked = json_app.CategoriaA == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[1].checked = json_app.CategoriaB == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[2].checked = json_app.CategoriaC == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[3].checked = json_app.CategoriaD == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[4].checked = json_app.CategoriaE == 1 ? true : false;
                        form.querySelectorAll('input[type=checkbox]')[5].checked = json_app.CategoriaF == 1 ? true : false;
                        
                        form.querySelectorAll('input')[9].value = json_app.Licencia_Vigente_Del;
                        form.querySelectorAll('input')[10].value = json_app.Licencia_Vigente_Hasta;

                        form.querySelectorAll('input')[11].value = json_app.Estatus;

                        form.querySelectorAll('select')[0].value = json_app.Tipo_Licencia;
                        if (json_app.Tipo_Licencia == 1) {
                            form.querySelectorAll('.form-group')[2].style.display = 'block';
                            form.querySelectorAll('.form-group')[4].style.display = 'none';
                            form.querySelectorAll('.form-group')[3].querySelector('label').textContent = 'Hasta';
                            document.querySelector('#vert-tabs-examen_medico-tab').style.display = 'block';
                        }else if (json_app.Tipo_Licencia == 2) {
                            form.querySelectorAll('.form-group')[2].style.display = 'none';
                            form.querySelectorAll('.form-group')[4].style.display = 'block';
                            form.querySelectorAll('.form-group')[3].querySelector('label').textContent = 'Vencimiento';
                            document.querySelector('#vert-tabs-examen_medico-tab').style.display = 'none';
                        }
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    getExamenMedico(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_examen_medico form');
        xhr.open('POST', '../ValidacionLicencia/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('input')[2].value = json_app.Numero_Examen;
                        form.querySelectorAll('input')[3].value = json_app.Tipo_Examen;
                        form.querySelectorAll('input')[4].value = json_app.Resultado_Examen;
                        form.querySelectorAll('input')[5].value = json_app.Fecha_Dictamen_Examen;
                        form.querySelectorAll('input')[6].value = json_app.Vigente_Hasta_Examen;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    getResultadoLicencia(){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        let form = document.querySelector('#modal_resultado_licencia form');
        xhr.open('POST', '../ValidacionLicencia/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.clase = this;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        form.querySelectorAll('input')[0].value = json_app.Candidato;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('textarea')[0].value = json_app.Caracteristicas;
                        form.querySelectorAll('textarea')[1].value = json_app.Resultado;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }

    update_licencia(){
        var form = document.querySelector("#modal_licencia form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ValidacionLicencia/updateLicencia');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarValidacionLicencia(json_app, json_app.display);
                        utils.showToast('Información de Licencia Federal actualizada exitosamente', 'success');
                        $('#modal_licencia').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    update_examen_medico(){
        var form = document.querySelector("#modal_examen_medico form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ValidacionLicencia/updateExamen');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarValidacionLicencia(json_app, json_app.display);
                        utils.showToast('Información de Exámen Médico actualizada exitosamente', 'success');
                        $('#modal_examen_medico').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    update_resultado_licencia(){
        var form = document.querySelector("#modal_resultado_licencia form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ValidacionLicencia/updateResultados');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarValidacionLicencia(json_app, json_app.display);
                        utils.showToast('Información de Licencia actualizada exitosamente', 'success');
                        $('#modal_resultado_licencia').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}

    getContinuarServicio(Servicio_Solicitado){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        console.log(data);
        let form = document.querySelector('#modal_continuar_servicio form');
        xhr.open('POST', '../ServicioApoyo/getDatosGenerales');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let datos = json_app.candidato_datos;
                        form.querySelectorAll('input')[0].value = datos.Candidato;
                        form.querySelectorAll('input')[1].value = datos.Nombres;
                        form.querySelectorAll('input')[2].value = datos.Apellido_Paterno;
                        form.querySelectorAll('input')[3].value = datos.Apellido_Materno;
                        form.querySelectorAll('input')[4].value = datos.id_Estado;
                        form.querySelectorAll('input')[5].value = datos.Ciudad;
                        form.querySelectorAll('input')[6].value = Servicio_Solicitado;
                        form.querySelectorAll('input')[7].value = datos.Razon;
                        form.querySelectorAll('input')[8].value = datos.CC_Cliente;
                        form.querySelectorAll('input')[9].value = datos.Cliente;
                        let ejecutivos = '';
						
						
						
                          if (datos.ID_Empresa == 153) {
                            if (json_app.usuario == 3911 || json_app.usuario == 4420 || json_app.usuario == 4257 || json_app.usuario == 2413 || json_app.usuario == 6011 || json_app.usuario == 6012) {
                                ejecutivos += `<option value="lissetruiz">Lisset Ruiz Montelongo</option>`;
							}else {
                                ejecutivos += `<option value="karendelangel">Ana Karen Del Angel Meza</option>`;
							}
                        } else {
                            json_app.ejecutivos.forEach(ejecutivo => {
                                ejecutivos +=
                                    `
                                <option value="${ejecutivo.username}">${ejecutivo.first_name} ${ejecutivo.last_name}</option>
                                `;
                            });
                        }
						
						
						
						
                        form.querySelectorAll('select')[0].innerHTML = ejecutivos;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }
	
	getNota(Id){
        this.Id = Id;
        let xhr = new XMLHttpRequest();
        let data = `Id=${this.Id}`;
        document.querySelectorAll('#modal_nota form .btn')[1].disabled = false;
        xhr.open('POST', '../Notas/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let form = document.querySelector('#modal_nota');
                        form.querySelectorAll('input')[0].value = json_app.Id;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 1;
                        form.querySelectorAll('textarea')[0].value = json_app.Nota
                    }else {
                        form.querySelectorAll('input')[0].value = 0;
                        form.querySelectorAll('input')[1].value = folio;
                        form.querySelectorAll('input')[2].value = 0;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
                    
			}
        }
    }

    save_notas(){
        var form = document.querySelector("#modal_nota form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Notas/save');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarNotas(json_app.notas, json_app.display);
                        utils.showToast('Nota guardada exitosamente', 'success');
                        $('#modal_nota').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
                
			}
		}
	}

    delete_nota(){
        var form = document.querySelector("#modal_delete_nota form");
		var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Notas/delete');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else if (json_app.status == 1){
                        xhr.clase.cargarNotas(json_app.notas, json_app.display);
                        utils.showToast('Se eliminó la nota exitosamente', 'success');
                        $('#modal_delete_nota').modal('hide');
                    }else if(json_app.status == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }else{
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
	}
	
	getContactar(folio){
        let xhr = new XMLHttpRequest();
        let data = `Folio=${folio}`;
        console.log(data);
        let form = document.querySelector('#modal_contactar form');
        xhr.open('POST', '../ServicioApoyo/getDatosGenerales');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0){
                        let json_app = JSON.parse(r);
                        let datos = json_app.candidato_datos;
                        form.querySelectorAll('input')[0].value = folio;
                        form.querySelectorAll('input')[1].value = 1;
                        form.querySelectorAll('b')[0].textContent = `Estás por afirmas que ${datos.Sexo == 99 ? 'la candidata' : 'el candidato'} ha sido ${datos.Sexo == 99 ? 'contactada' : 'contactado'}.`;
                        //form.querySelectorAll('input')[2].value = datos.Correo_Cliente;
                        let contactos = '';
                        json_app.contactosCliente.forEach(element => {
                            contactos += `
                            <option value='${element.Correo}'>${element.Nombre_Contacto} ${element.Apellido_Contacto}</option>
                            `;
                        });
                        form.querySelectorAll('select')[0].innerHTML = contactos;
                        form.querySelectorAll('textarea')[0].value = `Se le informa que ${datos.Sexo == 99 ? 'la candidata' : 'el candidato'} ${datos.Nombres +' '+datos.Apellido_Paterno+' '+datos.Apellido_Materno} ha sido ${datos.Sexo == 99 ? 'contactada' : 'contactado'}`;
                    }else {
                        form.querySelectorAll('input')[0].value = folio;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                }
                    
			}
        }
    }
	
	update_contact(){
        var form = document.querySelector("#modal_contactar form");
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../ServicioApoyo/contact');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if(json_app.status == 0){
                        utils.showToast('Omitiste algún dato','error');
                    }else if (json_app.status == 1){
                        xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                        utils.showToast('Se notificó al cliente exitosamente', 'success');
                        $('#modal_contactar').modal('hide');
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
}
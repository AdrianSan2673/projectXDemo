class Psychometry{
    create(){
        var form = document.querySelector("#psychometry-form");
        var formData = new FormData(form);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../psicometria/create');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#psychometry-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Psicometría registrada exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../psicometria/index`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#psychometry-form #submit").disabled = false;
                }else if (r == 4){
                    utils.showToast('El archivo de la psicometría excede el peso permitido o tiene un formato no admitido', 'warning');
                    document.querySelector("#psychometry-form #submit").disabled = false;
                }else{
                    document.querySelector("#psychometry-form #submit").disabled = false;
                }
            }
        }
    }

    update(){
        var form = document.querySelector("#psychometry-form");
        var formData = new FormData(form);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../psicometria/update');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#psychometry-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Psicometría actualizada exitosamente', 'success');
                    //setTimeout(() => {
                      ///  window.history.back();
                    //}, 3000);
                    document.querySelector("#psychometry-form #submit").disabled = false;

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#psychometry-form #submit").disabled = false;
                }else{
                    document.querySelector("#psychometry-form #submit").disabled = false;
                }
            }
        }
    }

    getPsychometry(id){
        this.id = id;
        let xhr = new XMLHttpRequest();
        let data = `id=${this.id}`;
        xhr.open('POST', '../Administracion/getPsychometry');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0){
                    let json_app = JSON.parse(this.responseText);
                    console.log(json_app);
                    document.querySelector("#update-form").reset();
                    document.querySelector("#id").value = json_app.id;
                    document.querySelector("#id_customer").value = json_app.id_customer;
                    document.querySelector("#id_business_name").value = json_app.id_business_name;
                    document.querySelector("#request_date").value = json_app.request_date;
                    document.querySelector("#id_purchase_order").value = json_app.id_purchase_order;
                    document.querySelector("#customer").value = json_app.customer;
                    document.querySelector("#candidate").value = json_app.candidate;
                    document.querySelector("#send_date").value = json_app.end_date;
                    document.querySelector("#folio").value = json_app.folio;
                    document.querySelector("#amount").value = parseFloat(json_app.amount).toFixed(2);
                    $('#modal_edit').modal('show'); 
                }
            }
        }
    }

    update_folio(){
        var form = document.querySelector("#update-form");
        this.id = document.querySelector("#id").value;
		var formData = new FormData(form);
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/update_folio_psycho');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
        xhr.id = this.id;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
				if(r == 0){
					utils.showToast('Omitiste algún dato','error');
				}else{
                    document.getElementById("folio"+xhr.id).value = r;
                    $('#modal_edit').modal('hide');
				}
			}
		}
    }
    
    add(){
        var form = document.querySelector("#psychometry-add-form");
        var formData = new FormData(form);
        
        this.id_candidate = document.querySelector("#psychometry-add-form #id_candidate").value;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../psicometria/add');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.id_candidate = this.id_candidate;
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#psychometry-add-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Psicometría registrada exitosamente', 'success');
                    setTimeout(() => {
                        //window.location.href = `../psicometria/ver&id=${xhr.id_candidate}`;
                        window.history.back();
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#psychometry-add-form #submit").disabled = false;
                }else if (r == 4){
                    utils.showToast('El archivo de la psicometría excede el peso permitido o tiene un formato no admitido', 'warning');
                    document.querySelector("#psychometry-add-form #submit").disabled = false;
                }
                else{
                    document.querySelector("#psychometry-add-form #submit").disabled = false;
                }
            }
        }
    }
	
	



    //gabo psycho
    save_interpretation() {

        var form = document.querySelector("#interpretation-form");
        var formData = new FormData(form);


        fetch('../psicometria/update_interpretation', {
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

                try {
                    const json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Llena todos los campos requeridos por favor', 'error');
                        document.querySelector("#guardar_interpretacion").disabled = false;

                    } else if (json_app.status == 1) {
                        utils.showToast('La información se ha actualizado correctamente', 'success');
                        document.querySelector("#guardar_interpretacion").disabled = false;

                    } else if (json_app.status == 2) {
                        utils.showToast(' No se pudo guardar la informacion', 'error');
                        document.querySelector("#guardar_interpretacion").disabled = false;


                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector("#guardar_interpretacion").disabled = false;


                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#guardar_interpretacion").disabled = false;

            });
    }


    upload_file() {

        var form = document.querySelector("#form-document");
        var formData = new FormData(form);


        fetch('../psicometria/upload_file', {
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

                try {

                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {


                        var div = `
                  <div class="col-8">
                  <label for="psycho" class="col-form-label">Documento Cargado:</label>
                  <a class="btn-success btn" href="${json_app.routeDocu}" target="_blank">Ver
                      psicometria</a>
                 </div>
                 <br>
                  
                  `;

                        document.querySelector('#documento_cargado').innerHTML = div;

                        utils.showToast('Archivo  agregado.', 'success');

                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }








                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    document.querySelector("#guardar_interpretacion").disabled = false;


                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#guardar_interpretacion").disabled = false;

            });
    }
	
	
	
	
	
	
	
}
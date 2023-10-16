class administracion_reclu_cobranza {   //gabo
    
    getFactura(id) {
       
        var form = document.querySelector("#modal_editar_factura form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Administracion/getBillG');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                
                try {
                    let json_app = JSON.parse(r);

                    if (json_app.status == 0) {
                        
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                
                        document.querySelector('#modal_editar_factura [name="id"]').value = json_app.factura_datos.id;
                        document.querySelector('#modal_editar_factura [name="folio"]').value = json_app.factura_datos.folio;
                        document.querySelector('#modal_editar_factura [name="emit_date"]').value = json_app.factura_datos.emit_date;
                        document.querySelector('#modal_editar_factura [name="customer"]').value = json_app.factura_datos.customer;
                        
                        
                       
                        let business_name= json_app.business_names;                        
                         $("#modal_editar_factura [name='id_business_name']").find('option').remove();
                        business_name.forEach((element) => {
                            if(element['id']==json_app.factura_datos.id_business_name){
                                
                                $("#modal_editar_factura [name='id_business_name']").append($('<option selected="selected">').val(element['id']).text(element['business_name']));
                            }else{
                                $("#modal_editar_factura [name='id_business_name']").append($('<option>').val(element['id']).text(element['business_name']));
                            }
                        });

                       $("#modal_editar_factura [name='status']").val(json_app.factura_datos.status);
                        $('#status').trigger('change');
                 
                        document.querySelector('#modal_editar_factura [name="amount"]').value = json_app.factura_datos.total;  

                        if(json_app.factura_datos.iva==1.11){
                           $("#yes").attr("checked", true); 
                        }else{
                           $("#no").attr("checked", true); 
                        }

                        document.querySelector('#modal_editar_factura [name="payment_date"]').value = json_app.factura_datos.payment_date;  
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast('La fecha inicial es mayor que la final.', 'error');
                    } else {
                        alert("hola");
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }




	gestionar_factura(id){
        var form = document.querySelector("#bill-gestion-form form");
        let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/gestion_factura_modal');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                
				try {
					let json_app = JSON.parse(r);
					if(json_app.status == 0){
						utils.showToast('Omitiste algún dato','error');
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					} else if(json_app.status == 1){
                          console.log(r);
                          document.querySelector('#modal_gestionar_factura [name="id"]').value = json_app.factura.id;
                          document.querySelector('#modal_gestionar_factura [name="folio"]').value = json_app.factura.folio;
                          document.querySelector('#modal_gestionar_factura [name="emit_date"]').value = json_app.factura.emit_date;
                          document.querySelector('#modal_gestionar_factura [name="customer"]').value = json_app.factura.customer;

                         let business_name= json_app.business_names;
                        
                         $("#id_business_name").find('option').remove();
                        business_name.forEach((element) => {
                            console.log(element['business_name']);
                            if(element['id']==json_app.factura.id_business_name){
                                
                                $('#id_business_name').append($('<option selected="selected">').val(element['id']).text(element['business_name']));
                            }else{
                                $('#id_business_name').append($('<option>').val(element['id']).text(element['business_name']));
                            }
                        });
                        
                         $("#modal_gestionar_factura [name='status']").val(json_app.factura.status);
                        $('#status').trigger('change');
						
						
					}else if (json_app.status == 2){
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					}else{
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#bill-gestion-form #submit").disabled = false;
				}
				
			}
		}
	}


}


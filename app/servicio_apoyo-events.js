const folio = document.querySelector('#folio').textContent;
const estudio = new Estudio();
const servicio = new ServicioApoyo();

document.addEventListener('DOMContentLoaded', e => {
    
    fetchData(folio);

    document.querySelector('#modal_datos_generales form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_datos_generales();
    }

    document.querySelector('#modal_service form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_service();
    }

    document.querySelector("#update-form").onsubmit = function(e){
        e.preventDefault();
        estudio.update_config_service();
    };

    document.querySelector("#update-schedule-form").onsubmit = function(e){
        e.preventDefault();
        estudio.update_schedule_service();
    };

    document.querySelector("#modal_localizacion form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_localizacion();
    };

    document.querySelector("#modal_enlace form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_enlace();
    };

    document.querySelector("#modal_cancelacion form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_cancelacion();
    };

    document.querySelector("#modal_finalizacion form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_finalizacion();
    };
	
	document.querySelector("#modal_pausar form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_pausa();
    };
	
	document.querySelector("#modal_reanudar form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_reanudar();
    };

    document.querySelector('#modal_avanzar form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_avanzar();
    }

    document.querySelector('#modal_reactivar form').onsubmit = function(e){
        e.preventDefault();
        estudio.reactivarServicio();
    }

    document.querySelector('#modal_eliminar form').onsubmit = function(e){
        e.preventDefault();
        estudio.eliminarServicio();
    }

    document.querySelector('#Tipo_Investigacion').addEventListener('change', () => {
        estudio.update_tipo_investigacion(folio);
    });

    document.querySelector('#update-ral-form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_ral();
    }

    document.querySelector('#modal_comentarios_ral form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_comentarios_ral();
    }

    document.querySelector('#update-conociendo-form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_conociendo();
    }

    $('#modal_datos_personales form').validate({
        rules: {
            Nacimiento: {
                maxlength: 50
            },
            Edad: {
                number: true,
                min: 17
            },
            Sexo: {
                required: true
            },
            Lugar_Nacimiento: {
                maxlength: 50
            },
            Hijos: {
                min: 0
            },
            Vive_con: {
                maxlength: 40
            },
            CURP: {
                maxlength: 20
            },
            IMSS: {
                maxlength: 15
            },
            RFC: {
                maxlength: 15
            }
        },
        messages: {
            Nacimiento: {
                maxlength: "El máximo es de 50 caracteres"
            },
            Edad: {
                number: "Solo números",
                min: "La edad mínima es 18"
            },
            Sexo: {
                required: "Selecciona el sexo del candidato"
            },
            Lugar_Nacimiento: {
                maxlength: "El máximo es de 50 caracteres"
            },
            Hijos: {
                min: "El mínimo de hijos es 0"
            },
            Vive_con: {
                maxlength: "El máximo de caracteres es 40"
            },
            CURP: {
                maxlength: "El máximo de caracteres es 20"
            },
            IMSS: {
                maxlength: "El máximo de caracteres de 15"
            },
            RFC: {
                maxlength: "El máximo de caracteres de 15"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(){
            e.preventDefault();
            estudio.save_datos_personales();
        }
    })

    document.querySelector('#modal_contacto form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_contacto();
    }

    document.querySelector('#modal_escolaridad form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_escolaridad();
    }

    document.querySelector('#modal_referencia_laboral form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_referencia_laboral();
    }

    document.querySelector('#modal_delete_referencia_laboral form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_referencia_laboral();
    }

    document.querySelector('#update-investigacion-form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_investigacion();
    }

    document.querySelector('#modal_comentarios_generales_inv form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_comentarios_generales_inv();
    }

    document.querySelector('#cohabitante-form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_cohabitante();
    }

    document.querySelector('#cohabitante-delete-form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_cohabitante();
    }

    document.querySelector("#modal_comentario_cohabitan form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_comentario_cohabitan();
    };

    document.querySelector("#modal_comentario_documentacion form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_comentario_documentacion();
    };

    document.querySelector('#circulo_familiar-form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_circulo_familiar();
    }

    document.querySelector('#circulo_familiar-delete-form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_circulo_familiar();
    }

    document.querySelector('#modal_historial_salud form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_historial_salud();
    }

    document.querySelector('#modal_ubicacion form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_ubicacion();
    }

    document.querySelector('#modal_enseres form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_enseres();
    }

    document.querySelector('#modal_referencia form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_referencia();
    }

    document.querySelector('#modal_delete_referencia form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_referencia();
    }

    document.querySelector('#modal_ingreso form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_ingreso();
    }

    document.querySelector('#modal_delete_ingreso form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_ingreso();
    }

    document.querySelector('#modal_egreso form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_egreso();
    }

    document.querySelector('#modal_delete_egreso form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_egreso();
    }

    document.querySelector("#modal_comentario_economia form").onsubmit = function(e){
        e.preventDefault();
        estudio.save_comentario_economia();
    };
	
	document.querySelector('#modal_INFONAVIT form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_INFONAVIT();
    }

    document.querySelector('#modal_credito form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_credito();
    }

    document.querySelector('#modal_delete_credito form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_credito();
    }

    document.querySelector('#modal_bancaria form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_bancaria();
    }

    document.querySelector('#modal_delete_bancaria form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_bancaria();
    }

    document.querySelector('#modal_seguro form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_seguro();
    }

    document.querySelector('#modal_delete_seguro form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_seguro();
    }

    document.querySelector('#modal_inmueble form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_inmueble();
    }

    document.querySelector('#modal_delete_inmueble form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_inmueble();
    }

    document.querySelector('#modal_vehiculo form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_vehiculo();
    }

    document.querySelector('#modal_delete_vehiculo form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_vehiculo();
    }

    document.querySelector('#modal_conclusiones form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_conclusiones();
    }

    document.querySelector('#modal_comentarios_generales form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_comentarios_generales();
    }
	
	document.querySelector('#modal_nota form').onsubmit = function(e){
        e.preventDefault();
        estudio.save_notas();
    }

    document.querySelector('#modal_delete_nota form').onsubmit = function(e){
        e.preventDefault();
        estudio.delete_nota();
    }

    var new_image = document.querySelector('#modal_imagen img');
    $('#btn-image-ral').change(function(e){
        var files = e.target.files;
		var done = function(url){
			new_image.src = url;

            var form = document.querySelector("#modal_imagen form");
            //var formData = new FormData(form);
            form.querySelectorAll('input')[0].value = 0;
            form.querySelectorAll('input')[1].value = 'RAL';
            form.querySelectorAll('input')[2].value = 298;
            form.querySelectorAll('input')[3].value = files[0].name;
            form.querySelectorAll('input')[4].value = folio;
            form.querySelectorAll('input')[5].value = 0;
            form.querySelectorAll('input')[6].value = 0;

            form.querySelectorAll('.btn')[3].disabled = false;
			$('#modal_imagen').modal({backdrop: 'static', keyboard: false});
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(e)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
    });

    var cropper;
    var optionsImgs = {
            movable: true,
            zoomable: true,
            scalable: true,
            viewMode: 0,
            rotatable: true,
            autoCropArea: 1,
           //preview:'.preview'
		}

    $('#modal_imagen').on('shown.bs.modal', function() {
		cropper = new Cropper(new_image, optionsImgs);
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

    document.querySelector('#modal_imagen .docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropped;
        var result;
        var input;
        var data;
    
        if (!cropper) {
          return;
        }
    
        while (target !== this) {
          if (target.getAttribute('data-method')) {
            break;
          }
    
          target = target.parentNode;
        }
    
        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
          return;
        }
    
        data = {
          method: target.getAttribute('data-method'),
          target: target.getAttribute('data-target'),
          option: target.getAttribute('data-option') || undefined,
          secondOption: target.getAttribute('data-second-option') || undefined
        };
    
        cropped = cropper.cropped;
    
        if (data.method) {
          if (typeof data.target !== 'undefined') {
            input = document.querySelector(data.target);
    
            if (!target.hasAttribute('data-option') && data.target && input) {
              try {
                data.option = JSON.parse(input.value);
              } catch (e) {
                console.log(e.message);
              }
            }
          }
    
          switch (data.method) {
            case 'rotate':
              if (cropped && optionsImgs.viewMode > 0) {
                cropper.clear();
              }
    
              break;
          }
    
          result = cropper[data.method](data.option, data.secondOption);
    
          switch (data.method) {
            case 'rotate':
              if (cropped && optionsImgs.viewMode > 0) {
                cropper.crop();
              }
    
              break;
    
            case 'scaleX':
            case 'scaleY':
              target.setAttribute('data-option', -data.option);
              break;
          }
    
          if (typeof result === 'object' && result !== cropper && input) {
            try {
              input.value = JSON.stringify(result);
            } catch (e) {
              console.log(e.message);
            }
          }
        }
      };

    let cropperr;
    let optionsDocs = {
        autoCropArea: 1,
        //preview:'.previeww',
        checkOrientation: true,
        responsive: true
    };

    $('#modal_documento').on('shown.bs.modal', function() {
		cropperr = new Cropper(document.querySelector('#modal_documento img'), optionsDocs);
	}).on('hidden.bs.modal', function(){
		cropperr.destroy();
   		cropperr = null;
	});

    document.querySelector('#modal_documento .docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropped;
        var result;
        var input;
        var data;
    
        if (!cropperr) {
          return;
        }
    
        while (target !== this) {
          if (target.getAttribute('data-method')) {
            break;
          }
    
          target = target.parentNode;
        }
    
        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
          return;
        }
    
        data = {
          method: target.getAttribute('data-method'),
          target: target.getAttribute('data-target'),
          option: target.getAttribute('data-option') || undefined,
          secondOption: target.getAttribute('data-second-option') || undefined
        };
    
        cropped = cropperr.cropped;
    
        if (data.method) {
          if (typeof data.target !== 'undefined') {
            input = document.querySelector(data.target);
    
            if (!target.hasAttribute('data-option') && data.target && input) {
              try {
                data.option = JSON.parse(input.value);
              } catch (e) {
                console.log(e.message);
              }
            }
          }
    
          switch (data.method) {
            case 'rotate':
              if (cropped && optionsDocs.viewMode > 0) {
                cropperr.clear();
              }
    
              break;
          }
    
          result = cropperr[data.method](data.option, data.secondOption);
    
          switch (data.method) {
            case 'rotate':
              if (cropped && optionsDocs.viewMode > 0) {
                cropperr.crop();
              }
    
              break;
    
            case 'scaleX':
            case 'scaleY':
              target.setAttribute('data-option', -data.option);
              break;
          }
    
          if (typeof result === 'object' && result !== cropperr && input) {
            try {
              input.value = JSON.stringify(result);
            } catch (e) {
              console.log(e.message);
            }
          }
        }
      };

    document.querySelector('#modal_imagen').onsubmit = function(e){
        e.preventDefault();
        

        canvas = cropper.getCroppedCanvas({
            maxWidth: 900,
            maxHeight: 900
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;

                var form = document.querySelector("#modal_imagen form");
                //var formData = new FormData(form);
                let Imagen = form.querySelectorAll('input')[0].value;
                let Tabla = form.querySelectorAll('input')[1].value;
                let Folio_Origen = form.querySelectorAll('input')[2].value;
                let Archivo = form.querySelectorAll('input')[3].value;
                let Candidato = form.querySelectorAll('input')[4].value;
                let Folio = form.querySelectorAll('input')[5].value;
                let flag = form.querySelectorAll('input')[6].value;

                form.querySelectorAll('.btn-orange')[0].disabled = true;

				let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Imagen/save');
                let data = `Imagen=${Imagen}&Tabla=${Tabla}&Folio_Origen=${Folio_Origen}&Archivo=${Archivo}&Candidato=${Candidato}&Folio=${Folio}&Objeto=${base64data}&flag=${flag}`;
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                //formData.Objeto = base64data;
                //formData.push({Objeto: base64data});
                //xhr.send(formData);
                xhr.clase = estudio;
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = this.responseText;
                        console.log(r);
                        try {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 1){
                                if (Tabla == 'RAL') {
                                    estudio.cargarCapturasRAL(json_app.capturas_ral, json_app.display);
                                }else if(Tabla == 'Candidatos_Ubicacion' || Tabla == 'Candidatos_Vivienda'){
                                    estudio.cargarUbicacionFotos(json_app.ubicacion_exterior, json_app.ubicacion_no_exterior, json_app.ubicacion_interior, json_app.ubicacion, json_app.vivienda);
                                }else if (Tabla == 'Candidatos') {
                                    estudio.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                                }else if(Tabla == 'Documentos'){
                                    estudio.cargarDocumentos(json_app.documentos, json_app.display);
                                }
                                
                                utils.showToast('Imagen cargada exitosamente', 'success');
                                $('#modal_imagen').modal('hide');
                                form.querySelectorAll('.btn-orange')[0].disabled = false;
                            }
                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                            form.querySelectorAll('.btn-orange')[0].disabled = false;
                        }
                    }
                }
			};
		});


        //estudio.save_imagen();
    }


    document.querySelector('#modal_documento').onsubmit = function(e){
        e.preventDefault();

        canvas = cropperr.getCroppedCanvas({ maxWidth: 1000, maxHeight: 1000 });

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;

                var form = document.querySelector("#modal_documento form");
                //var formData = new FormData(form);
                let Imagen = form.querySelectorAll('input')[0].value;
                let Tabla = form.querySelectorAll('input')[1].value;
                //let Folio_Origen = form.querySelectorAll('input')[2].value;
                let Archivo = form.querySelectorAll('input')[2].value;
                let Candidato = form.querySelectorAll('input')[3].value;
                let Folio = form.querySelectorAll('input')[4].value;
                let flag = form.querySelectorAll('input')[5].value;
                let Folio_Origen = form.querySelector('select').value;

                form.querySelectorAll('.btn-orange')[0].disabled = true;

				let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Imagen/save');
                let data = `Imagen=${Imagen}&Tabla=${Tabla}&Folio_Origen=${Folio_Origen}&Archivo=${Archivo}&Candidato=${Candidato}&Folio=${Folio}&Objeto=${base64data}&flag=${flag}`;
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                //formData.Objeto = base64data;
                //formData.push({Objeto: base64data});
                //xhr.send(formData);
                xhr.clase = estudio;
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = this.responseText;
                        console.log(r);
                        try {
                            let json_app = JSON.parse(r);
                            if (json_app.status == 1){
                                if (Tabla == 'Documentos') {
                                    estudio.cargarDocumentos(json_app.documentos, json_app.display);
                                }
                                
                                utils.showToast('Documento añadido exitosamente', 'success');
                                $('#modal_documento').modal('hide');
                                form.querySelectorAll('.btn-orange')[0].disabled = false;
                            }
                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                            form.querySelectorAll('.btn-orange')[0].disabled = false;
                        }
                    }
                }
			};
		});
    }

    document.querySelector('#modal_delete_imagen form').onsubmit = function(e){
        e.preventDefault();
        estudio.deleteImagen();
    }

    document.querySelector('#modal_licencia form').onsubmit = function(e) {
        e.preventDefault();
        estudio.update_licencia();
    }

    document.querySelector('#modal_examen_medico form').onsubmit = function(e){
        e.preventDefault();
        estudio.update_examen_medico();
    }

    document.querySelector('#modal_resultado_licencia').onsubmit = function(e){
        e.preventDefault();
        estudio.update_resultado_licencia();
    }
	
	document.querySelector('#modal_buscar_ral').onsubmit = function(e){
        e.preventDefault();
        estudio.searchForRAL();
    }
   /*

    document.querySelector("#update-form").onsubmit = function(e){
        e.preventDefault();
        let servicio = new Estudio();
        servicio.update_config_service();
    };

    document.querySelector('.btn-schedule').addEventListener('click', (e) => {
        $('#modal_schedule').modal({backdrop: 'static', keyboard: false});
        let estudio = new ServicioApoyo();
        estudio.getAgenda(id); 
    });

    document.querySelector('#btn-service').addEventListener('click', (e) => {
        $('#modal_service').modal({backdrop: 'static', keyboard: false});
    });

    document.querySelector('#btn-nueva_laboral').addEventListener('click', (e) => {
        $('#modal_referencia_laboral').modal({backdrop: 'static', keyboard: false});
    }); */



    $('.modal-content').resizable({
        //alsoResize: ".modal-dialog",
        minHeight: 300,
        minWidth: 300
      });
    $('.modal-dialog').draggable();


    document.querySelectorAll('.botones_continuar button')[0].addEventListener('click', e => {
        $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        estudio.getContinuarServicio(231);
    })
    document.querySelectorAll('.botones_continuar button')[1].addEventListener('click', e => {
        $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        estudio.getContinuarServicio(230);
    })
	document.querySelectorAll('.botones_continuar button')[2].addEventListener('click', e => {
        $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        estudio.getContinuarServicio(328);
    })
    document.querySelectorAll('.botones_continuar button')[3].addEventListener('click', e => {
        $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        estudio.getContinuarServicio(340);
    })
	document.querySelectorAll('.botones_continuar button')[4].addEventListener('click', e => {
        $('#modal_continuar_servicio').modal({backdrop: 'static', keyboard: false});
        estudio.getContinuarServicio(341);
    })
    document.querySelector('#modal_continuar_servicio form').addEventListener('submit', e => {
        e.preventDefault();
        let servicio = new ServicioApoyo();
        servicio.save_continuar_servicio();
    });

	document.querySelector('#modal_contactar form').addEventListener('submit', e => {
        e.preventDefault();
        estudio.update_contact();
    })
	
	document.querySelectorAll('.botones_pausar_finalizar button')[0].addEventListener('click', e => {
        Swal.fire({
            title: 'Finalizar en RAL',
            text: "Estás por indicar que no quieres continuar con el servicio. ¿Estás seguro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F28322',
            confirmButtonText: 'Sí, solo quiero el RAL',
            cancelButtonText: "Cancelar",
            reverseButtons: true
          }).then((result) => {
            console.log(result)
            if (result.value) {
                let data = `Folio=${folio}&Servicio_Solicitado=291&Fase=291&Estado=250&Comentario_Finalizacion=${'El cliente eligió no continuar este servicio'}`;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../ServicioApoyo/save_finalizacion');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.clase = estudio;
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = this.responseText;
                        console.log(r);
                        try {
                            let json_app = JSON.parse(r);
                            if(json_app.status == 0){
                                utils.showToast('Omitiste algún dato','error');
                            }else if (json_app.status == 1){
                                xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                                Swal.fire(
                                    'Finalizado',
                                    'El servicio ha sido finalizado',
                                    'success'
                                  )
                            }else if(json_app.status == 2){
                                Swal.fire(
                                    'Error al pausar',
                                    'Algo salió mal. Inténtalo de nuevo',
                                    'error'
                                )
                            }else{
                                Swal.fire(
                                    'Error al pausar',
                                    'Algo salió mal. Inténtalo de nuevo',
                                    'error'
                                )
                            }
                        } catch (error) {
                            Swal.fire(
                                'Error al pausar',
                                'Algo salió mal. Inténtalo de nuevo '+error,
                                'error'
                            )
                        }
                    }
                }
            }
          })
    })
    document.querySelectorAll('.botones_pausar_finalizar button')[1].addEventListener('click', e => {
        Swal.fire({
            title: 'Pausar servicio',
            text: "Tendrás solo 7 días para mantener pausado el servicio, si no se factura en automático",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#F28322',
            confirmButtonText: 'Acepto pausar servicio',
            cancelButtonText: "Cancelar",
            reverseButtons: true
          }).then((result) => {
            console.log(result)
            if (result.value) {
                let data = `Folio=${folio}&Servicio_Solicitado=291&Fase=291&Estado=250&Comentario_Pausa=${'Este servicio fue pausado por el cliente en fase de RAL.'}`;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../ServicioApoyo/save_pausar');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.clase = estudio;
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = this.responseText;
                        console.log(r);
                        try {
                            let json_app = JSON.parse(r);
                            if(json_app.status == 0){
                                utils.showToast('Omitiste algún dato','error');
                            }else if (json_app.status == 1){
                                xhr.clase.cargarInfoServicio(json_app.candidato_datos, json_app.perfil, json_app.display);
                                Swal.fire(
                                    'Servicio pausado',
                                    'TIene 7 días para continuar con este servicio',
                                    'success'
                                )
                            }else if(json_app.status == 2){
                                Swal.fire(
                                    'Error al pausar',
                                    'Algo salió mal. Inténtalo de nuevo',
                                    'error'
                                )
                            }else{
                                Swal.fire(
                                    'Error al pausar',
                                    'Algo salió mal. Inténtalo de nuevo',
                                    'error'
                                )
                            }
                        } catch (error) {
                            Swal.fire(
                                'Error al pausar',
                                'Algo salió mal. Inténtalo de nuevo '+error,
                                'error'
                            )
                        }
                    }
                }
                
            }
          })
    })
	
	document.querySelector('#modal_soi form').addEventListener('submit', e => {
        e.preventDefault();
        estudio.soi();
    })

    document.querySelector('#btn-upload-google-search').addEventListener('change', function(e) {
        const selectedFile = e.target.files[0];
        
        if (selectedFile) {
            const formData = new FormData();
            formData.append('search', selectedFile);
			formData.append('Folio', folio);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../ServicioApoyo/upload_google_search');
            xhr.send(formData);
            xhr.clase = estudio;
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
					let json_app = JSON.parse(r);
					console.log(r);
                    if (json_app.status == 1) {
                        xhr.clase.cargarBusquedaGoogle(json_app.google_search);
                        utils.showToast('Búsqueda en Internet cargada con éxito', 'success');
                    }
                } else {
                    utils.showToast('Error al subir archivo', 'error');
                }
            };

        }
    });
});


estudio.info_servicio.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-watch-photo') || e.target.parentElement.classList.contains('btn-watch-photo')) {
        let imagen;
        if (e.target.classList.contains('btn-watch-photo'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.verImagen(imagen);
    }

    if (e.target.classList.contains('btn-edit-photo') || e.target.parentElement.classList.contains('btn-edit-photo')) {
        let imagen;
        if (e.target.classList.contains('btn-edit-photo'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.getImagen(imagen);
    }

    if (e.target.classList.contains('btn-delete-photo') || e.target.parentElement.classList.contains('btn-delete-photo')) {
        $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
        let imagen;
        if (e.target.classList.contains('btn-delete-photo')){
            imagen = e.target.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.children[1].innerText;
        }else{
            imagen = e.target.parentElement.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.parentElement.children[1].innerText;
        }

        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[0].value = imagen;
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[1].value = 'Candidatos';
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[2].value = folio;
        document.querySelectorAll('#modal_delete_imagen form p')[0].textContent = `¿Estás seguro de que quieres eliminar la foto del candidato?`;
    }
	
	if (e.target.classList.contains('btn-contactar') || e.target.parentElement.classList.contains('btn-contactar')) {
        $('#modal_contactar').modal({backdrop: 'static', keyboard: false});
        estudio.getContactar(folio);
    }

    if (e.target.classList.contains('btn-empresa') || e.target.parentElement.classList.contains('btn-empresa')) {
        $('#modal_datos_generales').modal({backdrop: 'static', keyboard: false});
        servicio.getDatosGenerales(folio);
    }
    if (e.target.classList.contains('btn-localizacion') || e.target.parentElement.classList.contains('btn-localizacion')) {
        $('#modal_localizacion').modal({backdrop: 'static', keyboard: false});
        servicio.getLocalizacion(folio);
    }
    if (e.target.classList.contains('btn-service') || e.target.offsetParent.classList.contains('btn-service')) {
        $('#modal_service').modal({backdrop: 'static', keyboard: false});
        servicio.getTipoServicio(folio);
    }
    if (e.target.classList.contains('btn-config') || e.target.offsetParent.classList.contains('btn-config')) {
        $('#modal_config').modal({backdrop: 'static', keyboard: false});
        document.querySelectorAll('#modal_config input')[1].value = 1;
        servicio.getEstudio(folio);
    }
    if (e.target.classList.contains('btn-schedule') || e.target.offsetParent.classList.contains('btn-schedule')) {
        $('#modal_schedule').modal({backdrop: 'static', keyboard: false});
        document.querySelectorAll('#modal_schedule input')[1].value = 1;
        servicio.getAgenda(folio); 
    }

    if (e.target.classList.contains('btn-videocall') || e.target.offsetParent.classList.contains('btn-videocall')) {
        $('#modal_enlace').modal({backdrop: 'static', keyboard: false});
        document.querySelectorAll('#modal_enlace input')[1].value = 1;
        estudio.getEnlace(); 
    }


    if (e.target.classList.contains('btn-cancelar') || e.target.parentElement.classList.contains('btn-cancelar')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres cancelar todo el servicio? No se hará cobro por este.';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelarlo, justifica el motivo';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 0;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-cancelar-ral') || e.target.parentElement.classList.contains('btn-cancelar-ral')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres cancelar la investigación laboral? Solo se hará cobro por el RAL.';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta RAL, justifica el motivo por el cual ya no se continuó';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 0;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-cancelar-ralf') || e.target.parentElement.classList.contains('btn-cancelar-ralf')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres finalizar el servicio en RAL? Solo se hará cobro por el RAL.';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta RAL, justifica el motivo por el cual ya no se continuó';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 1;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-avanzar-investigacion') || e.target.parentElement.classList.contains('btn-avanzar-investigacion')) {
        $('#modal_avanzar').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_avanzar h6').textContent = 'Estás por avanzar a la fase de investigación';
        estudio.getAvanzarFase();
    }

    if (e.target.classList.contains('btn-cancelar-investigacion') || e.target.parentElement.classList.contains('btn-cancelar-investigacion')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres cancelar el Estudio SocioEconómico? Se estará cobrando el RAL y la Investigación Laboral';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta Investigación Laboral, justifica el motivo por el cual ya no se continuó';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 0;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-cancelar-investigacionf') || e.target.parentElement.classList.contains('btn-cancelar-investigacionf')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres finalizar en Investigación Laboral? Se estará cobrando el RAL y la Investigación Laboral';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta Investigación Laboral, justifica el motivo por el cual ya no se continuó';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 1;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-avanzar-estudio') || e.target.parentElement.classList.contains('btn-avanzar-estudio')) {
        //document.querySelector('#modal_avanzar h6').textContent = 'Estás por avanzar a la fase de estudio socioeconómico';
        /* $('#modal_avanzar').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_avanzar h6').textContent = 'Estás finalizando la investigación laboral';
        estudio.getAvanzarFase(); */
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás finalizando la investigación laboral';
        estudio.getComentarioFinalizacion(299);
    }

    if (e.target.classList.contains('btn-finalizar-servicio') || e.target.parentElement.classList.contains('btn-finalizar-servicio')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        //document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el servicio completo. Se cobraría el RAL, la investigación laboral y el estudio socioeconómico';
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el estudio socioeconómico.';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion(300);
    }

    if (e.target.classList.contains('btn-finalizar-ral') || e.target.parentElement.classList.contains('btn-finalizar-ral')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el RAL.';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion();
    }
	
	if (e.target.classList.contains('btn-finalizar-aral') || e.target.parentElement.classList.contains('btn-finalizar-aral')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el Análisis RAL.';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion();
    }

    if (e.target.classList.contains('btn-finalizar-investigacion') || e.target.parentElement.classList.contains('btn-finalizar-investigacion')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar la Investigación Laboral.';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion(231);
    }

    if (e.target.classList.contains('btn-finalizar-estudio') || e.target.parentElement.classList.contains('btn-finalizar-estudio')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el estudio socioeconómico.';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion();
    }
	
	if (e.target.classList.contains('btn-cancelar-estudiof') || e.target.parentElement.classList.contains('btn-cancelar-estudiof')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres finalizar en Estudio SocioEconómico? Se estará cobrando el RAL, la Investigación Laboral y el Estudio Socioeconómico sin la Visita Presencial';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta Estudio Socioeconómico, justifica el motivo por el cual ya no se continuó con la Visita Presencial';
        document.querySelectorAll('#modal_cancelacion  input')[4].value = 1;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-avanzar-visita') || e.target.parentElement.classList.contains('btn-avanzar-visita')) {
        $('#modal_avanzar').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_avanzar h6').textContent = 'Estás por avanzar a la fase de Visita Presencial';
        estudio.getAvanzarFase();
    }

    if (e.target.classList.contains('btn-cancelar-estudio') || e.target.parentElement.classList.contains('btn-cancelar-estudio')) {
        $('#modal_cancelacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_cancelacion h6').textContent = '¿Estás seguro de que quieres cancelar la Visita Presencial? Se estará cobrando el RAL, la Investigación Laboral y el Estudio Socioeconómico';
        document.querySelector('#modal_cancelacion label').textContent = 'Si deseas cancelar el proceso hasta Estudio Socioeconómico, justifica el motivo por el cual ya no se continuó con la Visita Presencial';
        document.querySelectorAll('#modal_cancelacion input')[4].value = 0;
        estudio.getComentarioCancelacion();
    }

    if (e.target.classList.contains('btn-finalizar-visita') || e.target.parentElement.classList.contains('btn-finalizar-visita')) {
        $('#modal_finalizacion').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_finalizacion h6').textContent = 'Estás por finalizar el servicio completo. Se cobraría el RAL, la investigación laboral, el estudio socioeconómico y la Visita Presencial';
        document.querySelector('#modal_finalizacion label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay algo pendiente.';
        estudio.getComentarioFinalizacion();
    }

    if (e.target.classList.contains('btn-reactivar') || e.target.parentElement.classList.contains('btn-reactivar')) {
        $('#modal_reactivar').modal({backdrop: 'static', keyboard: false});
        estudio.getReactivar();
    }

    if (e.target.classList.contains('btn-eliminar') || e.target.parentElement.classList.contains('btn-eliminar')) {
        $('#modal_eliminar').modal({backdrop: 'static', keyboard: false});
        estudio.getEliminar();
    }
	
	if (e.target.classList.contains('btn-pausar') || e.target.parentElement.classList.contains('btn-pausar')) {
        $('#modal_pausar').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_pausar h6').textContent = 'Estás por pausar el servicio';
        document.querySelector('#modal_pausar label').textContent = 'Escribe tus comentarios acerca del estatus del servicio, sobretodo si hay un estimado de cuanto tiempo estará pausado';
        estudio.getComentarioPausado();
    }
	
	if (e.target.classList.contains('btn-reanudar') || e.target.parentElement.classList.contains('btn-reanudar')) {
        $('#modal_reanudar').modal({backdrop: 'static', keyboard: false});
        document.querySelector('#modal_reanudar h6').textContent = 'Estás por reanudar el servicio';
        estudio.getReanudacion();
    }
    
    e.stopPropagation();
});

estudio.info_servicio.addEventListener('change', (e) => {
    if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {
        var new_image = document.querySelector('#modal_imagen img');
        var files = e.target.files;
        var done = function(url){
            new_image.src = url;

            var form = document.querySelector("#modal_imagen form");
            //var formData = new FormData(form);
            form.querySelectorAll('input')[0].value = 0;
            form.querySelectorAll('input')[1].value = 'Candidatos';
            form.querySelectorAll('input')[2].value = folio;
            form.querySelectorAll('input')[3].value = files[0].name;
            form.querySelectorAll('input')[4].value = folio;
            form.querySelectorAll('input')[5].value = folio;
            form.querySelectorAll('input')[6].value = 0;

            form.querySelectorAll('.btn')[3].disabled = false;
            $('#modal_imagen').modal({backdrop: 'static', keyboard: false});
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(e)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    }
})

estudio.content_ral.addEventListener('click', e => {
    if (e.target.classList.contains('btn-ral') || e.target.parentElement.classList.contains('btn-ral')) {
        $('#modal_ral').modal({backdrop: 'static', keyboard: false});
        estudio.getRAL();
    }
    e.stopPropagation();
})

estudio.content_capturas_ral.addEventListener('click', e => {
    if (e.target.classList.contains('btn-success') || e.target.parentElement.classList.contains('btn-success')) {
        let imagen;
        if (e.target.classList.contains('btn-success'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.verImagen(imagen);
    }

    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        let imagen;
        if (e.target.classList.contains('btn-info'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.getImagen(imagen);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
        let imagen;
        if (e.target.classList.contains('btn-danger')){
            imagen = e.target.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.children[1].innerText;
        }else{
            imagen = e.target.parentElement.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.parentElement.children[1].innerText;
        }

        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[0].value = imagen;
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[1].value = 'RAL';
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[2].value = folio;
        document.querySelectorAll('#modal_delete_imagen form p')[0].textContent = `¿Estás seguro de que quieres eliminar la imagen ${archivo}?`;
    }
    e.stopPropagation();
})

estudio.content_busqueda_ral.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        e.preventDefault();
        estudio.getDatosBusquedaRAL();
        $('#modal_buscar_ral').modal({backdrop: 'static', keyboard: false});
    }
    e.stopPropagation();
})

estudio.content_comentarios_ral.parentElement.children[0].addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_comentarios_ral').modal({backdrop: 'static', keyboard: false});
        estudio.getComentariosRAL();
    }
    e.stopPropagation();
})

estudio.content_licencia.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        estudio.getLicencia();
        $('#modal_licencia').modal({backdrop: 'static', keyboard: false});
    }
    e.stopPropagation();
})

estudio.content_examen_medico.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        estudio.getExamenMedico();
        $('#modal_examen_medico').modal({backdrop: 'static', keyboard: false});
    }
    e.stopPropagation();
})

estudio.content_resultado_licencia.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        estudio.getResultadoLicencia();
        $('#modal_resultado_licencia').modal({backdrop: 'static', keyboard: false});
    }
    e.stopPropagation();
})

for (let i = 0; i < estudio.content_datos_generales.length; i++) {
    estudio.content_datos_generales[i].parentElement.children[0].addEventListener('click', e => {
        $('#modal_datos_personales').modal({backdrop: 'static', keyboard: false});
        estudio.getDatosPersonales();
    })
    console.log(estudio.content_datos_generales[i].children[0]);
}


/**
 * Datos de contacto
 * 
 */

for (let i = 0; i < estudio.content_contacto.length; i++) {
    estudio.content_contacto[i].parentElement.children[0].addEventListener('click', e => {
        $('#modal_contacto').modal({backdrop: 'static', keyboard: false});
        estudio.getDatosContacto();
    })
}

/**
 * Escolaridad
 * 
 */

for (let i = 0; i < estudio.content_escolaridad.length; i++) {
    estudio.content_escolaridad[i].parentElement.children[0].addEventListener('click', e => {
        $('#modal_escolaridad').modal({backdrop: 'static', keyboard: false});
        estudio.getEscolaridad(estudio.content_escolaridad[i].parentElement.children[0].dataset.id);
    })
}

/**
 * Referencias laborales
 */

estudio.content_referencias_laborales.parentElement.children[0].addEventListener('click', function(e){
    $('#modal_referencia_laboral').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_referencia_laboral form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    estudio.getReferenciaLaboral(0);
})

estudio.content_referencias_laborales.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
        $('#modal_referencia_laboral').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.offsetParent.dataset.id;

        estudio.getReferenciaLaboral(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
        $('#modal_delete_referencia_laboral').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.children[5].children[0].children[1].innerText;
        }else{
            renglon = e.target.offsetParent.dataset.id;
            nombre = e.target.parentElement.parentElement.children[5].children[0].children[1].innerText;
        }
        document.querySelectorAll('#modal_delete_referencia_laboral form .btn')[1].disabled = false;
        document.querySelectorAll('#modal_delete_referencia_laboral form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_referencia_laboral form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_referencia_laboral form p').textContent = `¿Estás seguro(a) de que deseas eliminar la referencia laboral de ${nombre}?  `;
    }
    e.stopPropagation();
})

for (let i = 0; i < estudio.content_documentos.length; i++) {
    estudio.content_documentos[i].parentElement.parentElement.parentElement.children[0].children[1].addEventListener('change', function(e){
        console.log(folio);
        var files = e.target.files;
		let data = `Folio=${folio}`;
        let xhr = new XMLHttpRequest();
		xhr.open('POST', '../Imagen/getDocumentosPorCompletar');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
        xhr.clase = this;
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
                let r = this.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    let data = '';
                    json_app.forEach(element => {
                        data += `<option value="${element.Campo}">${element.Descripcion}</option>`;
                    });
                    document.querySelector('#modal_documento select').innerHTML = data;
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                    //form.querySelectorAll('.btn')[1].disabled = false;
                }
			}
		}
        
        var done = function(url){
            
			document.querySelector('#modal_documento img').src = url;

            var form = document.querySelector("#modal_documento form");
            //var formData = new FormData(form);
            form.querySelectorAll('input')[0].value = 0;
            form.querySelectorAll('input')[1].value = 'Documentos';
            form.querySelectorAll('input')[2].value = files[0].name;
            form.querySelectorAll('input')[3].value = folio;
            form.querySelectorAll('input')[4].value = 0;
            form.querySelectorAll('input')[5].value = 0;

            form.querySelectorAll('.btn')[3].disabled = false;
			$('#modal_documento').modal({backdrop: 'static', keyboard: false});
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(e)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
    })

    estudio.content_documentos[i].addEventListener('click', e => {
        if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains('btn-success')) {
            let imagen;
            if (e.target.classList.contains('btn-success'))
                imagen = e.target.dataset.id;
            else
                imagen = e.target.offsetParent.dataset.id;
    
            estudio.verImagen(imagen);
        }

        if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
            let imagen;
            if (e.target.classList.contains('btn-info'))
                imagen = e.target.dataset.id;
            else
                imagen = e.target.offsetParent.dataset.id;
    
            estudio.getImagen(imagen);
        }

        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
            $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
            let imagen;
            if (e.target.classList.contains('btn-danger')){
                imagen = e.target.dataset.id;
                nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
            }else{
                imagen = e.target.offsetParent.dataset.id;
                nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
            }
            document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[0].value = imagen;
            document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[1].value = 'Documentos';
            document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[2].value = folio;
            document.querySelector('#modal_delete_imagen form p').textContent = `¿Estás seguro(a) de que deseas eliminar la imagen ${nombre}?  `;
        }
        e.stopPropagation();
    })

    estudio.content_documentos[i].parentElement.parentElement.parentElement.children[3].addEventListener('click', (e) => {
        $('#modal_comentario_documentacion').modal({backdrop: 'static', keyboard: false});
        estudio.getComentarioDocumentacion();
    })
}

estudio.content_investigacion.addEventListener('click', function(e){
    if (e.target.classList.contains('btn') || e.target.offsetParent.classList.contains('btn')) {
        $('#modal_investigacion').modal({backdrop: 'static', keyboard: false});
        
        estudio.getInvestigacion();
    }
    e.stopPropagation();
});

estudio.content_comentarios_generales_inv.parentElement.children[0].addEventListener('click', e => {
    $('#modal_comentarios_generales_inv').modal({backdrop: 'static', keyboard: false});
    estudio.getComentariosGeneralesInv();
})

estudio.content_conociendo_candidato.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn') || e.target.offsetParent.classList.contains('btn')) {
        $('#modal_conociendo').modal({backdrop: 'static', keyboard: false});
        estudio.getConociendoCandidato(folio);
    }
    e.stopPropagation();
});

/**
 * Cohabitantes
 *
 */

for (let i = 0; i < estudio.content_cohabitantes.length; i++) {
    estudio.content_cohabitantes[i].parentElement.parentElement.parentElement.children[0].addEventListener('click', (e) => {
        $('#modal_cohabitante').modal({backdrop: 'static', keyboard: false});
        let form = document.querySelector('#modal_cohabitante form');
        form.reset();
        form.querySelectorAll('.btn')[1].disabled = false;
        form.querySelectorAll('input')[0].value = 0;
        form.querySelectorAll('input')[1].value = folio;
        form.querySelectorAll('input')[2].value = 0;
		estudio.getCohabitante(0);
    })

    estudio.content_cohabitantes[i].addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
            $('#modal_cohabitante').modal({backdrop: 'static', keyboard: false});
            let renglon;
            if (e.target.classList.contains('btn-info'))
                renglon = e.target.dataset.id;
            else
                renglon = e.target.offsetParent.dataset.id;
    
            estudio.getCohabitante(renglon);
        }

        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
            document.querySelectorAll('#modal_delete_cohabitante .btn')[1].disabled = false;
            $('#modal_delete_cohabitante').modal({backdrop: 'static', keyboard: false});
            let renglon;
            if (e.target.classList.contains('btn-danger')){
                renglon = e.target.dataset.id;
                nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
            }else{
                renglon = e.target.offsetParent.dataset.id;
                nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
            }
            document.querySelectorAll('#cohabitante-delete-form input[type=hidden]')[0].value = renglon;
            document.querySelectorAll('#cohabitante-delete-form input[type=hidden]')[1].value = folio;
            document.querySelector('#cohabitante-delete-form p').textContent = `¿Estás seguro(a) de que deseas eliminar al cohabitante ${nombre}?  `;
        }

        
        e.stopPropagation();
    })

    estudio.content_cohabitantes[i].parentElement.parentElement.parentElement.children[3].addEventListener('click', (e) => {
        $('#modal_comentario_cohabitan').modal({backdrop: 'static', keyboard: false});
        estudio.getComentarioCohabitan();
    })
}


/**
 * Círculo familiar
 * 
 */

estudio.content_circulo_familiar.parentElement.parentElement.parentElement.children[0].addEventListener('click', (e) => {
        $('#modal_circulo-familiar').modal({backdrop: 'static', keyboard: false});
        let form = document.querySelector('#modal_circulo-familiar form');
        form.reset();
        form.querySelectorAll('.btn')[1].disabled = false;
        form.querySelectorAll('input')[0].value = 0;
        form.querySelectorAll('input')[1].value = folio;
        form.querySelectorAll('input')[2].value = 0;
})

estudio.content_circulo_familiar.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
        $('#modal_circulo-familiar').modal({backdrop: 'static', keyboard: false});
        let id;
        if (e.target.classList.contains('btn-info'))
            id = e.target.dataset.id;
        else
            id = e.target.offsetParent.dataset.id;

        estudio.getCirculoFamiliar(id);
    }
    e.stopPropagation();
})

estudio.content_circulo_familiar.addEventListener('click', (e) => {
    if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
        document.querySelectorAll('#modal_delete_circulo-familiar .btn')[1].disabled = false;
        $('#modal_delete_circulo-familiar').modal({backdrop: 'static', keyboard: false});
        let id;
        if (e.target.classList.contains('btn-danger')){
            id = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            id = e.target.offsetParent.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#circulo_familiar-delete-form input[type=hidden]')[0].value = id;
        document.querySelectorAll('#circulo_familiar-delete-form input[type=hidden]')[1].value = folio;
        document.querySelector('#circulo_familiar-delete-form p').textContent = `¿Estás seguro(a) de que deseas eliminar a ${nombre} del círculo familiar?  `;
    }
    e.stopPropagation();
})

/**
 * Historial de salud
 * 
 */

estudio.content_historial_salud.parentElement.children[0].addEventListener('click', (e) => {
    $('#modal_historial_salud').modal({backdrop: 'static', keyboard: false});
    estudio.getHistorialSalud();
})

/**
 * Ubicación
 * 
 */

estudio.content_ubicacion.parentElement.children[0].addEventListener('click', (e) => {
    $('#modal_ubicacion').modal({backdrop: 'static', keyboard: false});
    estudio.getUbicacion(folio);
})

/**
 * Ubicación fotos
 * 
 */

 estudio.content_ubicacion_fotos.addEventListener('click', e => {
    if (e.target.classList.contains('btn-success') || e.target.parentElement.classList.contains('btn-success')) {
        let imagen;
        if (e.target.classList.contains('btn-success'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.verImagen(imagen);
    }

    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        let imagen;
        if (e.target.classList.contains('btn-info'))
            imagen = e.target.dataset.id;
        else
            imagen = e.target.parentElement.dataset.id;

        estudio.getImagen(imagen);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        $('#modal_delete_imagen').modal({backdrop: 'static', keyboard: false});
        let imagen;
        let archivo;
        let Folio_Origen;
        let Tabla;
        if (e.target.classList.contains('btn-danger')){
            imagen = e.target.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.children[1].innerText;
            Folio_Origen = e.target.dataset.Folio_Origen;
            Tabla = e.target.dataset.Tabla;
        }else{
            imagen = e.target.parentElement.dataset.id;
            archivo = e.target.parentElement.parentElement.parentElement.parentElement.children[1].innerText;
            Folio_Origen = e.target.parentElement.dataset.Folio_Origen;
            Tabla = e.target.parentElement.dataset.Tabla;
        }

        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[0].value = imagen;
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[1].value = Tabla;
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[2].value = folio;
        document.querySelectorAll('#modal_delete_imagen form input[type=hidden]')[3].value = Folio_Origen;
        document.querySelectorAll('#modal_delete_imagen form p')[0].textContent = `¿Estás seguro de que quieres eliminar la imagen ${archivo}?`;
    }

    e.stopPropagation();
})

estudio.content_ubicacion_fotos.addEventListener('change', e => {
    if (e.target.classList.contains('btn-orange') || e.target.parentElement.classList.contains('btn-orange')) {
        var new_image = document.querySelector('#modal_imagen img');
        let tabla;
        let id;
        if (e.target.classList.contains('btn-orange')) {
            tabla = e.target.dataset.tabla;
            id = e.target.dataset.id;
        }else{
            tabla = e.target.parentElement.dataset.tabla;
            id = e.target.parentElement.dataset.id;
        }

        var files = e.target.files;
        var done = function(url){
            new_image.src = url;

            var form = document.querySelector("#modal_imagen form");
            //var formData = new FormData(form);
            form.querySelectorAll('input')[0].value = 0;
            form.querySelectorAll('input')[1].value = tabla;
            form.querySelectorAll('input')[2].value = id;
            form.querySelectorAll('input')[3].value = files[0].name;
            form.querySelectorAll('input')[4].value = folio;
            form.querySelectorAll('input')[5].value = folio;
            form.querySelectorAll('input')[6].value = 0;

            form.querySelectorAll('.btn')[3].disabled = false;
            $('#modal_imagen').modal({backdrop: 'static', keyboard: false});
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(e)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    }
    e.stopPropagation();
})

/**
 * Enseres
 * 
 */

estudio.content_enseres.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_enseres').modal({backdrop: 'static', keyboard: false});
    estudio.getEnseres();
})

/**
 * Referencias
 *  
 */
for (let i = 0; i < estudio.content_referencias.length; i++) {
    estudio.content_referencias[i].parentElement.children[0].addEventListener('click', e => {
        $('#modal_referencia').modal({backdrop: 'static', keyboard: false});
        let form = document.querySelector('#modal_referencia form');
        form.reset();
        form.querySelectorAll('.btn')[1].disabled = false;
        form.querySelectorAll('input')[0].value = 0;
        form.querySelectorAll('input')[1].value = folio;
        form.querySelectorAll('input')[2].value = 0;
		estudio.getReferencia(0);
    })

    estudio.content_referencias[i].addEventListener('click', e => {
        if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
            $('#modal_referencia').modal({backdrop: 'static', keyboard: false});
            let renglon;
            if (e.target.classList.contains('btn-info'))
                renglon = e.target.dataset.id;
            else
                renglon = e.target.parentElement.dataset.id;

            estudio.getReferencia(renglon);
        }

        if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
            var form = document.querySelector("#modal_delete_referencia form");
            form.querySelectorAll('.btn')[1].disabled = false;
            $('#modal_delete_referencia').modal({backdrop: 'static', keyboard: false});
            let renglon;
            if (e.target.classList.contains('btn-danger')){
                renglon = e.target.dataset.id;
                nombre = e.target.parentElement.children[7].innerText;
            }else{
                renglon = e.target.parentElement.dataset.id;
                nombre = e.target.parentElement.parentElement.children[7].innerText;
            }
            document.querySelectorAll('#modal_delete_referencia form input[type=hidden]')[0].value = renglon;
            document.querySelectorAll('#modal_delete_referencia form input[type=hidden]')[1].value = folio;
            document.querySelector('#modal_delete_referencia form p').textContent = `¿Estás seguro(a) de que deseas eliminar la referencia ${nombre}?  `;
        }
        e.stopPropagation();
    })
}





/**
 * Ingresos
 *  
 */
estudio.content_ingresos.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_ingreso').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_ingreso form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
})

estudio.content_ingresos.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_ingreso').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getIngreso(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_ingreso form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_ingreso').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_ingreso form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_ingreso form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_ingreso form p').textContent = `¿Estás seguro(a) de que deseas eliminar el ingreso de ${nombre}?  `;
    }
    e.stopPropagation();
})


/**
 * Egresos
 *  
 */
 estudio.content_egresos.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_egreso').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_egreso form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    estudio.addEgreso();
})

estudio.content_egresos.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_egreso').modal({backdrop: 'static', keyboard: false});
        let egreso;
        if (e.target.classList.contains('btn-info'))
            egreso = e.target.dataset.id;
        else
            egreso = e.target.parentElement.dataset.id;

        estudio.getEgreso(egreso);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_egreso form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_egreso').modal({backdrop: 'static', keyboard: false});
        let egreso;
        if (e.target.classList.contains('btn-danger')){
            egreso = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            egreso = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_egreso form input[type=hidden]')[0].value = egreso;
        document.querySelectorAll('#modal_delete_egreso form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_egreso form p').textContent = `¿Estás seguro(a) de que deseas eliminar el egreso de ${nombre}?  `;
    }
    e.stopPropagation();
})

estudio.content_totales_economia.parentElement.children[2].addEventListener('click', e => {
    estudio.getComentarioEconomia();
})

/**
 * Créditos
 *  
 */

estudio.content_creditos.parentElement.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_INFONAVIT').modal({backdrop: 'static', keyboard: false});
    estudio.getINFONAVIT();
})

estudio.content_creditos.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_credito').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_credito form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    form.querySelectorAll('input')[4].value = "$ 0.00";
    form.querySelectorAll('input')[5].value = "$ 0.00";
    form.querySelectorAll('input')[7].value = "$ 0.00";
})

estudio.content_creditos.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_credito').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getCredito(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_credito form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_credito').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_credito form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_credito form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_credito form p').textContent = `¿Estás seguro(a) de que deseas eliminar el crédito de ${nombre}?  `;
    }
    e.stopPropagation();
})


/**
 * Cuenta bancaria
 *  
 */

estudio.content_cuentas_bancarias.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_bancaria').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_bancaria form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    form.querySelectorAll('input')[6].value = "$ 0.00";
})

estudio.content_cuentas_bancarias.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_bancaria').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getBancaria(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_bancaria form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_bancaria').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_bancaria form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_bancaria form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_bancaria form p').textContent = `¿Estás seguro(a) de que deseas eliminar la cuenta bancaria de ${nombre}?  `;
    }
    e.stopPropagation();
})

/**
 * Seguros
 *  
 */

 estudio.content_seguros.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_seguro').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_seguro form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    form.querySelectorAll('input')[6].value = "$ 0.00";
})

estudio.content_seguros.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_seguro').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getSeguro(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_seguro form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_seguro').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_seguro form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_seguro form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_seguro form p').textContent = `¿Estás seguro(a) de que deseas eliminar el seguro de ${nombre}?  `;
    }
    e.stopPropagation();
})

/**
 * Bienes inmuebles
 *  
 */

 estudio.content_inmuebles.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_inmueble').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_inmueble form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    form.querySelectorAll('input')[5].value = "$ 0.00";
    form.querySelectorAll('input')[6].value = "$ 0.00";
})

estudio.content_inmuebles.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_inmueble').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getInmueble(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_inmueble form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_inmueble').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_inmueble form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_inmueble form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_inmueble form p').textContent = `¿Estás seguro(a) de que deseas eliminar el inmueble de ${nombre}?  `;
    }
    e.stopPropagation();
})

/**
 * Vehículos
 *  
 */

 estudio.content_vehiculos.parentElement.parentElement.parentElement.children[0].addEventListener('click', e => {
    $('#modal_vehiculo').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_vehiculo form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
    form.querySelectorAll('input')[5].value = "$ 0.00";
    form.querySelectorAll('input')[6].value = "$ 0.00";
})

estudio.content_vehiculos.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_vehiculo').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-info'))
            renglon = e.target.dataset.id;
        else
            renglon = e.target.parentElement.dataset.id;

        estudio.getVehiculo(renglon);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_vehiculo form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_vehiculo').modal({backdrop: 'static', keyboard: false});
        let renglon;
        if (e.target.classList.contains('btn-danger')){
            renglon = e.target.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }else{
            renglon = e.target.parentElement.dataset.id;
            nombre = e.target.parentElement.parentElement.parentElement.parentElement.children[0].innerText;
        }
        document.querySelectorAll('#modal_delete_vehiculo form input[type=hidden]')[0].value = renglon;
        document.querySelectorAll('#modal_delete_vehiculo form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_vehiculo form p').textContent = `¿Estás seguro(a) de que deseas eliminar el vehículo ${nombre}?  `;
    }
    e.stopPropagation();
})

estudio.content_conclusiones.parentElement.children[0].addEventListener('click', e => {
    $('#modal_conclusiones').modal({backdrop: 'static', keyboard: false});
    estudio.getConclusiones();
})

estudio.content_comentarios_generales.parentElement.children[0].addEventListener('click', e => {
    $('#modal_comentarios_generales').modal({backdrop: 'static', keyboard: false});
    estudio.getComentariosGenerales();
})

estudio.content_notas.parentElement.children[1].children[0].children[0].addEventListener('click', e => {
    $('#modal_nota').modal({backdrop: 'static', keyboard: false});
    let form = document.querySelector('#modal_nota form');
    form.reset();
    form.querySelectorAll('.btn')[1].disabled = false;
    form.querySelectorAll('input')[0].value = 0;
    form.querySelectorAll('input')[1].value = folio;
    form.querySelectorAll('input')[2].value = 0;
})

estudio.content_notas.addEventListener('click', e => {
    if (e.target.classList.contains('btn-info') || e.target.parentElement.classList.contains('btn-info')) {
        $('#modal_nota').modal({backdrop: 'static', keyboard: false});
        let Id;
        if (e.target.classList.contains('btn-info'))
            Id = e.target.dataset.id;
        else
            Id = e.target.parentElement.dataset.id;

        estudio.getNota(Id);
    }

    if (e.target.classList.contains('btn-danger') || e.target.parentElement.classList.contains('btn-danger')) {
        var form = document.querySelector("#modal_delete_nota form");
        form.querySelectorAll('.btn')[1].disabled = false;
        $('#modal_delete_nota').modal({backdrop: 'static', keyboard: false});
        let Id;
        if (e.target.classList.contains('btn-danger')){
            Id = e.target.dataset.id;
        }else{
            Id = e.target.parentElement.dataset.id;
        }
        document.querySelectorAll('#modal_delete_nota form input[type=hidden]')[0].value = Id;
        document.querySelectorAll('#modal_delete_nota form input[type=hidden]')[1].value = folio;
        document.querySelector('#modal_delete_nota form p').textContent = `¿Estás seguro(a) de que deseas eliminar la siguiente nota?`;
    }
    e.stopPropagation();
})

const fetchData = async (folio) => {
    const res = await fetch(`../ServicioApoyo/getOneService&candidato=${folio}`);
    const data = await res.json();
    document.title = `${data.candidato_datos.Nombres} ${data.candidato_datos.Apellido_Paterno} ${data.candidato_datos.Apellido_Materno}`;
    console.log(data);
    estudio.set_tipo_investigacion(data.candidato_datos.Tipo_Investigacion);
    estudio.setNivelPuesto(data.candidato_datos.Nivel, data.conociendo_candidato);
    estudio.setFaseVLF(data.candidato_datos.Nivel, data.candidato_datos.ID_Empresa, data.candidato_datos.Servicio_Solicitado);
    estudio.setFase(data.candidato_datos, data.display);
    estudio.setServicioSolicitado(data.candidato_datos.Servicio_Solicitado, data.display);
    estudio.setDopajeLogimex(data.candidato_datos.Cliente);
    estudio.cargarInfoServicio(data.candidato_datos, data.perfil, data.display, data.cv_ruta, data.soi, data.historial_candidato);
    estudio.cargarValidacionLicencia(data.vlf, data.display);
	estudio.cargarBusquedaRAL(data.candidato_datos, data.busqueda_RAL, data.display);
    estudio.cargarPropioRAL(data.candidato_datos, data.expedientes_RAL, data.display);
    estudio.cargarInfoRAL(data.ral, data.display);
    estudio.cargarCapturasRAL(data.capturas_ral, data.display);
    estudio.cargarComentariosRAL(data.ral, data.display);
    estudio.cargarDatosGenerales(data.candidato_datos, data.display);
    estudio.cargarContacto(data.candidato_datos, data.display);
    estudio.cargarReferenciasLaborales(data.referencias_laborales, data.display, data.candidato_datos.ID_Empresa, data.candidato_datos);
    estudio.cargarDocumentos(data.documentos, data.display, data.comentarios.Comentario_Documentos, data.docs.Redes_Sociales);
    estudio.cargarInvestigacion(data.investigacion, data.display, data.candidato_datos.ID_Empresa);
    estudio.cargarBusquedaGoogle(data.google_search);
    estudio.cargarComentariosGeneralesInv(data.observaciones, data.display, data.candidato_datos);

    estudio.cargarConociendoCandidato(data.conociendo_candidato, data.display);
    estudio.cargarEscolaridad(data.escolaridad, data.candidato_datos);
    estudio.cargarCohabitantes(data.cohabitantes, data.display, data.comentarios.Comentario_Cohabitan, data.candidato_datos);
    estudio.cargarCirculoFamiliar(data.circulo_familiar, data.display);
    estudio.cargarHistorialSalud(data.historial_salud, data.salud_seguros);
    estudio.cargarUbicacion(data.ubicacion, data.vivienda, data.candidato_datos);
    estudio.cargarUbicacionFotos(data.ubicacion_exterior, data.ubicacion_no_exterior, data.ubicacion_interior, data.ubicacion, data.vivienda);
    estudio.cargarEnseres(data.enseres);
    estudio.cargarReferencias(data.referencias, data.display, data.candidato_datos);
    estudio.cargarEconomiaFamiliar(data.ingresos, data.egresos, data.display, data.comentarios.Comentario_Economia);
    estudio.cargarInformacionFinanciera(data.creditos, data.cuentas, data.seguros, data.comentarios.INFONAVIT, data.display);
    estudio.cargarInformacionPatrimonial(data.inmuebles, data.vehiculos, data.display);
    estudio.cargarConclusiones(data.observaciones, data.display, data.candidato_datos);
    estudio.cargarComentariosGenerales(data.observaciones, data.display, data.candidato_datos);
    estudio.cargarNotas(data.notas, data.display);
	estudio.set_SOI(data.candidato_datos, data.soiCer, data.display, data.soi)
}
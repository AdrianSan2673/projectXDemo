class ContenidoEstudio {
    constructor() {
        this.info_servicio = document.getElementById('info-servicio');
        this.content_licencia = document.getElementById('content-licencia');
        this.content_examen_medico = document.getElementById('content-examen_medico');
        this.content_resultado_licencia = document.getElementById('content-resultado_licencia');
        this.content_busqueda_ral = document.getElementById('content-busqueda_ral');
        this.content_expediente_ral = document.getElementById('content-expedientes_ral');
        this.content_ral = document.getElementById('content-ral');
        this.content_capturas_ral = document.getElementById('content-capturas_ral');
        this.content_propio_ral = document.getElementById('content-propio_ral');
        this.content_comentarios_ral = document.getElementById('content-comentarios_ral');

        this.content_datos_generales = document.getElementsByClassName('content-datos_generales');
        this.content_contacto = document.getElementsByClassName('content-contacto');
        this.content_referencias_laborales = document.getElementById('content-referencias_laborales');
        this.content_documentos = document.getElementsByClassName('content-documentos');
        this.content_investigacion = document.getElementById('content-investigacion');
        this.content_comentarios_generales_inv = document.getElementById('content-comentarios_generales_inv');
        this.content_conociendo_candidato = document.getElementById('content-conociendo_candidato');
        this.content_escolaridad = document.getElementsByClassName('content-escolaridad');
        this.content_cohabitantes = document.getElementsByClassName('content-cohabitantes');
        this.content_circulo_familiar = document.getElementById('content-circulo_familiar');
        this.content_historial_salud = document.getElementById('content-historial_salud');
        this.content_ubicacion = document.getElementById('content-ubicacion');
        this.content_ubicacion_fotos = document.getElementById('content-ubicacion_fotos');
        this.content_enseres = document.getElementById('content-enseres');
        this.content_referencias = document.getElementsByClassName('content-referencias');
        this.content_ingresos = document.getElementById('content-ingresos');
        this.content_egresos = document.getElementById('content-egresos');
        this.content_totales_economia = document.getElementById('content-totales-economia');
        this.content_creditos = document.getElementById('content-creditos');
        this.content_cuentas_bancarias = document.getElementById('content-cuentas_bancarias');
        this.content_seguros = document.getElementById('content-seguros');
        this.content_inmuebles = document.getElementById('content-inmuebles');
        this.content_vehiculos = document.getElementById('content-vehiculos');
        this.content_conclusiones = document.getElementById('content-conclusiones');
        this.content_comentarios_generales = document.getElementById('content-comentarios_generales');
        this.content_notas = document.getElementById('content-notas');

        this.template_perfil = document.getElementById('template-perfil').content;
        this.template_datos_empresa = document.getElementById('template-datos_empresa').content;
        this.template_candidato_contactado = document.getElementById('template-candidato_contactado').content;
        this.template_localizacion = document.getElementById('template-localizacion').content;
        this.template_estatus_servicio = document.getElementById('template-estatus_servicio').content;
        this.template_botones_estatus = document.getElementById('template-botones_estatus').content;
        this.template_config = document.getElementById('template-config').content;
        this.template_schedule = document.getElementById('template-schedule').content;
        this.template_videollamada = document.getElementById('template-videollamada').content;
        this.template_comentarios_servicio = document.getElementById('template-comentarios_servicio').content;
        this.template_reactivar_eliminar = document.getElementById('template-reactivar_eliminar').content;
        this.template_historial_candidato = document.getElementById('template-historial_candidato').content;

        this.template_licencia = document.getElementById('template-licencia').content;
        this.template_examen_medico = document.getElementById('template-examen_medico').content;
        this.template_resultado_licencia = document.getElementById('template-resultado_licencia').content;

        this.template_busqueda_ral = document.getElementById('template-busqueda_ral').content;
        this.template_expediente_ral = document.getElementById('template-expediente_ral').content;
        this.template_ral = document.getElementById('template-ral').content;
        this.template_captura_ral = document.getElementById('template-captura_ral').content;
        this.template_propio_ral = document.getElementById('template-propio_ral').content;
        this.template_propio_ral_estados = document.getElementById('template-propio_ral_estados').content

        this.template_comentarios_ral = document.getElementById('template-comentarios_ral').content;

        this.template_datos_generales = document.getElementById('template-datos_generales').content;
        this.template_contacto = document.getElementById('template-contacto').content;
        this.template_referencia_laboral = document.getElementById('template-referencia_laboral').content;
        this.template_documento = document.getElementById('template-documento').content;
        this.template_investigacion = document.getElementById('template-investigacion').content;
        this.template_comentarios_generales_inv = document.getElementById('template-comentarios_generales_inv').content;
        this.template_conociendo_candidato = document.getElementById('template-conociendo_candidato').content;
        this.template_escolaridad = document.getElementById('template-escolaridad').content;
        this.template_cohabitante = document.getElementById('template-cohabitante').content;
        this.template_circulo_familiar = document.getElementById('template-circulo_familiar').content;
        this.template_historial_salud = document.getElementById('template-historial_salud').content;
        this.template_ubicacion = document.getElementById('template-ubicacion').content;
        this.template_ubicacion_fotos = document.getElementById('template-ubicacion_fotos').content;
        this.template_enseres = document.getElementById('template-enseres').content;
        this.template_referencia = document.getElementById('template-referencia').content;
        this.template_ingreso = document.getElementById('template-ingreso').content;
        this.template_egreso = document.getElementById('template-egreso').content;
        this.template_totales_economia = document.getElementById('template-totales-economia').content;
        this.template_credito = document.getElementById('template-credito').content;
        this.template_cuenta_bancaria = document.getElementById('template-cuenta_bancaria').content;
        this.template_seguro = document.getElementById('template-seguro').content;
        this.template_inmueble = document.getElementById('template-inmueble').content;
        this.template_vehiculo = document.getElementById('template-vehiculo').content;
        this.template_conclusiones = document.getElementById('template-conclusiones').content;
        this.template_comentarios_generales = document.getElementById('template-comentarios_generales').content;
        this.template_notas = document.getElementById('template-notas').content;

        this.fragment_info_servicio = document.createDocumentFragment();
        this.fragment_historial_candidato = document.createDocumentFragment();

        this.fragment_licencia = document.createDocumentFragment();
        this.fragment_examen_medico = document.createDocumentFragment();
        this.fragment_resultado_licencia = document.createDocumentFragment();

        this.fragment_busqueda_ral = document.createDocumentFragment();
        this.fragment_expediente_ral = document.createDocumentFragment();
        this.fragment_ral = document.createDocumentFragment();
        this.fragment_captura_ral = document.createDocumentFragment();
        this.fragment_propio_ral = document.createDocumentFragment();
        this.fragment_comentarios_ral = document.createDocumentFragment();

        this.fragments_datos_generales = new Array();
        for (let i = 0; i < this.content_datos_generales.length; i++) {
            this.fragments_datos_generales[i] = document.createDocumentFragment();
        }
        this.fragment_datos_generales = this.fragments_datos_generales;

        this.fragments_contacto = new Array();
        for (let i = 0; i < this.content_contacto.length; i++) {
            this.fragments_contacto[i] = document.createDocumentFragment();
        }
        this.fragment_contacto = this.fragments_contacto;

        this.fragment_referencia_laboral = document.createDocumentFragment();

        this.fragments_documento = new Array();
        for (let i = 0; i < this.content_documentos.length; i++) {
            this.fragments_documento[i] = document.createDocumentFragment();
        }
        this.fragment_documento = this.fragments_documento;

        this.fragment_investigacion = document.createDocumentFragment();
        this.fragment_comentarios_generales_inv = document.createDocumentFragment();

        this.fragment_conociendo_candidato = document.createDocumentFragment();
        this.fragments_escolaridad = new Array();
        for (let i = 0; i < this.content_escolaridad.length; i++) {
            this.fragments_escolaridad[i] = document.createDocumentFragment();
        }
        this.fragment_escolaridad = this.fragments_escolaridad;

        this.fragments_cohabitante = new Array();
        for (let i = 0; i < this.content_cohabitantes.length; i++) {
            this.fragments_cohabitante[i] = document.createDocumentFragment();
        }
        this.fragment_cohabitante = this.fragments_cohabitante;

        this.fragments_referencia = new Array();
        for (let i = 0; i < this.content_referencias.length; i++) {
            this.fragments_referencia[i] = document.createDocumentFragment();
        }
        this.fragment_referencia = this.fragments_referencia;

        this.fragment_circulo_familiar = document.createDocumentFragment();
        this.fragment_historial_salud = document.createDocumentFragment();
        this.fragment_ubicacion = document.createDocumentFragment();
        this.fragment_ubicacion_fotos = document.createDocumentFragment();
        this.fragment_enseres = document.createDocumentFragment();
        this.fragment_ingreso = document.createDocumentFragment();
        this.fragment_egreso = document.createDocumentFragment();
        this.fragment_totales_economia = document.createDocumentFragment();
        this.fragment_credito = document.createDocumentFragment();
        this.fragment_cuenta_bancaria = document.createDocumentFragment();
        this.fragment_seguro = document.createDocumentFragment();
        this.fragment_inmueble = document.createDocumentFragment();
        this.fragment_vehiculo = document.createDocumentFragment();
        this.fragment_conclusiones = document.createDocumentFragment();
        this.fragment_comentarios_generales = document.createDocumentFragment();
        this.fragment_notas = document.createDocumentFragment();
    }


    cargarInfoServicio(data, perfil, display, cv_ruta = 0, soi = 0, historial_candidato = false) {
        this.template_botones_estatus.querySelectorAll('.btn-group')[0].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[1].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[2].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[3].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[4].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[5].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[6].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[7].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[8].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[9].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[10].style.display = 'none';
        this.template_botones_estatus.querySelectorAll('.btn-group')[11].style.display = 'none';

        this.template_perfil.querySelector('img').src = perfil[0];

        if (display.SA == 'block') {
            if (perfil[0] == '../dist/img/user-icon.png' || perfil[0] == '../dist/img/user-icon-rose.png') {
                this.template_perfil.querySelector('.btn-watch-photo').style.display = 'none';
                this.template_perfil.querySelector('.btn-edit-photo').style.display = 'none';
                this.template_perfil.querySelector('.btn-delete-photo').style.display = 'none';
            } else {
                this.template_perfil.querySelector('.btn-watch-photo').style.display = 'block';
                this.template_perfil.querySelector('.btn-edit-photo').style.display = 'block';
                this.template_perfil.querySelector('.btn-delete-photo').style.display = 'block';
            }
        } else {
            this.template_perfil.querySelector('.btn-edit-photo').style.display = 'none';
            this.template_perfil.querySelector('.btn-delete-photo').style.display = 'none';
            this.template_perfil.querySelector('.btn-upload-photo').parentElement.style.display = 'none';
        }

        this.template_perfil.querySelector('.btn-watch-photo').dataset.id = data.Foto;
        this.template_perfil.querySelector('.btn-edit-photo').dataset.id = data.Foto;
        this.template_perfil.querySelector('.btn-delete-photo').dataset.id = data.Foto;
        this.template_perfil.querySelector('h3 b').textContent = data.Nombres;
        this.template_perfil.querySelector('h3 p').textContent = data.Apellido_Paterno + ' ' + data.Apellido_Materno;
        this.template_perfil.querySelector('h6').textContent = data.Puesto;

        this.template_candidato_contactado.querySelectorAll('span')[0].textContent = data.Contactado == 1 ? 'Contactado' : (data.Contactado == 2 ? 'No contactado' : '');
        this.template_candidato_contactado.querySelectorAll('p')[0].textContent = data.Contactado == 1 ? data.Fecha_Contactado : (data.Contactado == 2 ? '--' : '');
        this.template_candidato_contactado.querySelectorAll('button')[0].style.display = display.SA;
        if (data.Contactado == 1) {
            this.template_candidato_contactado.querySelectorAll('button')[0].style.display = 'none';
            this.template_candidato_contactado.querySelectorAll('span')[0].classList.add('badge-success');
        } else if (data.Contactado == 2) {
            this.template_candidato_contactado.querySelectorAll('button')[0].style.display = 'block';
            this.template_candidato_contactado.querySelectorAll('span')[0].classList.add('badge-warning');
            this.template_candidato_contactado.querySelectorAll('button')[0].style.display = display.SA;
        }

        this.template_datos_empresa.querySelectorAll('p')[0].textContent = data.Nombre_Cliente;
        this.template_datos_empresa.querySelectorAll('p')[1].textContent = data.Razon;
        this.template_datos_empresa.querySelectorAll('p')[2].textContent = data.CC_Cliente;

        this.template_datos_empresa.querySelectorAll('p')[3].textContent = data.Quien_Solicita;
        this.template_datos_empresa.querySelectorAll('p')[4].textContent = data.Correo_Cliente;
        this.template_datos_empresa.querySelectorAll('p')[5].textContent = data.Telefono_Cliente + (data.Extension_Cliente ? ' /' + data.Extension_Cliente : '');
        this.template_datos_empresa.querySelectorAll('p')[6].textContent = data.Celular_Cliente;
        this.template_datos_empresa.querySelector('button').style.display = display.Account;

        this.template_localizacion.querySelectorAll('p')[0].textContent = data.Ciudad;
        this.template_localizacion.querySelectorAll('p')[1].textContent = data.EstadoMX;
        this.template_localizacion.querySelector('button').style.display = display.SA;

        this.template_estatus_servicio.querySelectorAll('p')[0].textContent = data.Servicio_Solicitado;
        this.template_estatus_servicio.querySelectorAll('p')[1].textContent = data.Fase;
        this.template_estatus_servicio.querySelectorAll('p')[2].textContent = data.Estatus;
        this.template_estatus_servicio.querySelector('button').style.display = display.Operations;

        if (display.Account == 'block') {
            //if (data.Nuevo_Procedimiento == 1 && (data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'INV. LABORAL') && data.Servicio == 298 && (data.Estado == 250 || data.Estado == 251)) {
            if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'INV. LABORAL' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 298 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[0].style.display = 'block';
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'ESE' && data.Servicio == 299 && (data.Estado == 250 || data.Estado == 251)) {
            } else if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 299 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[1].style.display = 'block';
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'ESE' && data.Servicio == 300 && (data.Estado == 250 || data.Estado == 251)) {
            } else if (data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 299 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[3].style.display = 'block';
            } else if (data.Servicio_Solicitado == 'RAL' && data.Servicio == 298 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[4].style.display = 'block';
            } else if (data.Servicio_Solicitado == 'ANÁLISIS DE RAL' && data.Servicio == 328 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[9].style.display = 'block';
            } else if (data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 231 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[5].style.display = 'block';
            } else if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 230 && (data.Estado == 250 || data.Estado == 251) && data.Fecha_Entregado_INV == null) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].style.display = 'block';
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].querySelectorAll('.btn')[2].style.display = 'none';
            } else if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 231 && (data.Estado == 252 || data.Estado == 254) || data.Fecha_Entregado_INV != null) {
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
            } else if (data.Servicio_Solicitado == 'ESE + VISITA' && data.Servicio == 300 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[7].style.display = 'block';
            } else if (data.Servicio_Solicitado == 'ESE + VISITA' && data.Servicio == 324 && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[8].style.display = 'block';
            }

            //if (data.Nuevo_Procedimiento == 1 && (data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'INV. LABORAL') && (data.Servicio == 298 || data.Servicio == 311)) {
            if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'INV. LABORAL' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') && (data.Servicio == 298 || data.Servicio == 311 || data.Servicio == 328)) {
                document.querySelectorAll('#content_botones a')[1].style.display = "block";
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'ESE' && data.Servicio == 299) {
            } else if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 299) {
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'ESE' && data.Servicio == 300) {
            } else if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') && data.Servicio == 300) {
                //this.template_botones_estatus.querySelectorAll('.btn-group')[2].style.display = 'block';
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
                document.querySelectorAll('#content_botones a')[3].style.display = "block";
                if (data.ID_Empresa == 413) { //Btn estudio ESE en ingles para Charger logistics
                    document.querySelectorAll('#content_botones a')[4].style.display = "block";
                }
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 299) {
            } else if (data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 299) {
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
            } else if (data.Servicio_Solicitado == 'RAL' && (data.Servicio == 298 || data.Servicio == 311 || data.Servicio == 328)) {
                document.querySelectorAll('#content_botones a')[1].style.display = "block";
            } else if (data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 231) {
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
            } else if (data.Servicio_Solicitado == 'ESE' && data.Servicio == 230) {
                document.querySelectorAll('#content_botones a')[2].style.display = "block";
                document.querySelectorAll('#content_botones a')[3].style.display = "block";
                if (data.ID_Empresa == 413) { //Btn estudio ESE en ingles para Charger logistics
                    document.querySelectorAll('#content_botones a')[4].style.display = "block";
                }
            }

            if (data.Estado == 250 || data.Estado == 251) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[10].style.display = 'block';
            }

            if (data.Estado == 249)
                this.template_botones_estatus.querySelectorAll('.btn-group')[11].style.display = 'block';
        }

        if (display.AccountCustomerSA == 'block') {

            if (((data.Servicio == 298 || data.Servicio == 291 || data.Servicio == 328) && (data.Estado == 252 || data.Estado == 254 || data.Fecha_Entregado_RAL != null)) || ((data.Servicio == 299 || data.Servicio == 300 || data.Servicio == 324)) || ((data.Servicio == 300 || data.Servicio == 324 || data.Servicio == 231))) {
                document.querySelectorAll('#content_botones a')[1].style.display = "block";
            }
            if ((((data.Servicio == 231 || data.Servicio == 299) || (data.Servicio == 230)) && (data.Estado == 252 || data.Estado == 254)) || (data.Servicio == 300 || data.Servicio == 324)) {
                if (data.ID_Empresa == 353 && (data.Fecha_Entregado_ESE == null || data.Fecha_Entregado_INV == null) && data.Servicio_Solicitado == 'ESE') { //Auto partes calderon no debe aparecer la IV si no esta el ESE
                    document.querySelectorAll('#content_botones a')[2].style.display = "none";
                } else {
                    document.querySelectorAll('#content_botones a')[2].style.display = "block";

                }
            }
            if ((data.Servicio == 230 || data.Servicio == 300 || data.Servicio == 324) && (data.Estado == 252 || data.Estado == 254)) {
                document.querySelectorAll('#content_botones a')[3].style.display = "block";
            }
            if ((data.Estado == 249 || data.Estado == 250 || data.Estado == 251) && data.Servicio_Solicitado == 'RAL' && display.SA == 'none') {
                document.querySelectorAll('.botones_pausar_finalizar button')[0].style.display = 'inline-block';
            }
            if ((data.Estado == 250 || data.Estado == 251) && data.Servicio_Solicitado == 'RAL' && display.SA == 'none') {
                document.querySelectorAll('.botones_pausar_finalizar button')[1].style.display = 'inline-block';
            }
        }


        if (display.Logistics == 'block') {
            if ((data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'SOI') && (data.Servicio == 299 || data.Servicio == 300) && data.Fecha_Entregado_ESE == null && (data.Estado == 250 || data.Estado == 251)) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[2].style.display = 'block';
                document.querySelectorAll('#content_botones a')[1].style.display = "block";
                //}else if (data.Nuevo_Procedimiento == 1 && data.Servicio_Solicitado == 'INV. LABORAL' && data.Servicio == 299 && (data.Estado == 250 || data.Estado == 251)) {
            } else if (data.Servicio_Solicitado == 'ESE' && data.Servicio == 230 && (data.Estado == 250 || data.Estado == 251) && data.Fecha_Entregado_ESE == null) {
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].style.display = 'block';
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].querySelectorAll('.btn')[0].style.display = 'none';
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].querySelectorAll('.btn')[1].style.display = 'none';
                this.template_botones_estatus.querySelectorAll('.btn-group')[6].querySelectorAll('.btn')[2].style.display = 'block';
            }


            if (data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') {
                document.querySelectorAll('#content_botones a')[3].style.display = "block";

                if (data.ID_Empresa == 413) { //Btn estudio ESE en ingles para Charger logistics
                    document.querySelectorAll('#content_botones a')[4].style.display = "block";
                    document.querySelectorAll('#content_botones a')[5].style.display = "block";

                }
            }

        }

        this.template_config.querySelectorAll('p')[0].textContent = data.Fecha;
        this.template_config.querySelectorAll('p')[1].textContent = data.Analista;
        this.template_config.querySelectorAll('p')[2].textContent = data.Correo_Analista;
        this.template_config.querySelectorAll('p')[3].textContent = data.Fecha_Entregado;
        this.template_config.querySelector('button').style.display = display.Operations

        this.template_schedule.querySelectorAll('p')[0].textContent = data.Verificador;
        this.template_schedule.querySelectorAll('p')[1].textContent = data.Fecha_Aplicacion;
        this.template_schedule.querySelector('button').style.display = display.Logistics;

        this.template_videollamada.querySelector('button').style.display = display.Logistics;

        if (data.Enlace_Drive) {
            if (data.Enlace_Drive.length > 10) {
                this.template_videollamada.querySelector('div').style.display = 'block';
                if (data.Enlace_Drive.endsWith('view?usp=sharing'))
                    this.template_videollamada.querySelector('iframe').src = data.Enlace_Drive.replace('view?usp=sharing', 'preview');

                if (data.Enlace_Drive.endsWith('view?usp=share_link'))
                    this.template_videollamada.querySelector('iframe').src = data.Enlace_Drive.replace('view?usp=share_link', 'preview');
            } else
                this.template_videollamada.querySelector('div').style.display = 'none';
        } else
            this.template_videollamada.querySelector('div').style.display = 'none';

        this.template_reactivar_eliminar.querySelectorAll('button')[0].style.display = display.Operations;
        this.template_reactivar_eliminar.querySelectorAll('button')[1].style.display = display.Operations;

        if (display.Operations == 'block') {
            if (data.Estado != 254 && (data.Estado == 258 || data.Estado == 252) && data.Factura == '')
                this.template_reactivar_eliminar.querySelectorAll('button')[0].style.display = 'block';
            else
                this.template_reactivar_eliminar.querySelectorAll('button')[0].style.display = 'none';

            if (data.Estado != 254 && data.Factura == '')
                this.template_reactivar_eliminar.querySelectorAll('button')[1].style.display = 'block';
            else
                this.template_reactivar_eliminar.querySelectorAll('button')[1].style.display = 'none';
        }

        if (display.SA == 'block' && historial_candidato) {
            historial_candidato.forEach(historial => {
                this.template_historial_candidato.querySelector('h6').textContent = `${historial.Nombres} ${historial.Apellido_Paterno} ${historial.Apellido_Materno}`;
                this.template_historial_candidato.querySelector('a').href = `./ver&candidato=${historial.Candidato}`;
                this.template_historial_candidato.querySelectorAll('p')[0].textContent = historial.Fecha;
                this.template_historial_candidato.querySelectorAll('b')[0].textContent = historial.Nombre_Cliente;
                this.template_historial_candidato.querySelectorAll('p')[1].textContent = historial.Fase;

                if (historial.Servicio == 291 || historial.Servicio == 298)
                    this.template_historial_candidato.querySelector('div').classList.add('callout-warning');
                else if (historial.Servicio == 231 || historial.Servicio == 299)
                    this.template_historial_candidato.querySelector('div').classList.add('callout-danger');
                else if (historial.Servicio == 230 || historial.Servicio == 300)
                    this.template_historial_candidato.querySelector('div').classList.add('callout-navy');

                const clone_historial_candidato = this.template_historial_candidato.cloneNode(true);
                this.fragment_historial_candidato.appendChild(clone_historial_candidato);
            });
        }

        if (cv_ruta != 0) {
            this.template_reactivar_eliminar.querySelector('a').href = cv_ruta;
            this.template_reactivar_eliminar.querySelector('a').style.display = 'block';
        }

        if (soi != 0) {
            document.querySelector('#soi-card').style.display = 'block';
            document.querySelector('#soi-card img').src = soi;
            document.querySelector('#soi-card a').href = soi;
            document.querySelector('#soi-card a').download = 'SOI ' + data.Nombres + ' ' + data.Apellido_Paterno + ' ' + data.Apellido_Materno;
        }

        
        document.querySelector('#update-form [name="Ejecutivo"]').disabled = data.Ejecutivo_modificacion == 1 ? true : false;
        document.querySelector('#modal_schedule [name="Logistica"]').disabled = data.Gestor_modificacion == 1 ? true : false;

        const clone_perfil = this.template_perfil.cloneNode(true);
        const clone_candidato_contactado = this.template_candidato_contactado.cloneNode(true);
        const clone_datos_empresa = this.template_datos_empresa.cloneNode(true);
        const clone_localizacion = this.template_localizacion.cloneNode(true);
        const clone_estatus_servicio = this.template_estatus_servicio.cloneNode(true);
        const clone_botones_estatus = this.template_botones_estatus.cloneNode(true);
        const clone_config = this.template_config.cloneNode(true);
        const clone_schedule = this.template_schedule.cloneNode(true);
        const clone_videollamada = this.template_videollamada.cloneNode(true);
        const clone_reactivar_eliminar = this.template_reactivar_eliminar.cloneNode(true);

        this.fragment_info_servicio.appendChild(clone_perfil);
        if (data.Contactado != null)
            this.fragment_info_servicio.appendChild(clone_candidato_contactado);
        this.fragment_info_servicio.appendChild(clone_datos_empresa);
        this.fragment_info_servicio.appendChild(clone_localizacion);
        this.fragment_info_servicio.appendChild(clone_estatus_servicio);
        this.fragment_info_servicio.appendChild(clone_botones_estatus);
        this.fragment_info_servicio.appendChild(clone_config);

        if (data.Servicio_Solicitado == 'ESE' || data.Servicio_Solicitado == 'ESE + VISITA' || data.Servicio_Solicitado == 'SOI') {
            this.fragment_info_servicio.appendChild(clone_schedule);
            this.fragment_info_servicio.appendChild(clone_videollamada);
        }

        if (data.Especificaciones != '' && data.Especificaciones != null) {
            document.querySelector('#especificaciones_Empresa h6').textContent = data.Especificaciones;
            document.querySelector('#especificaciones_Empresa').style.display = display.SA;
        }

        if (data.Comentario_Cancelado != '' || data.Comentario_Cliente != '') {
            if (data.Comentario_Cliente != '') {
                this.template_comentarios_servicio.querySelectorAll('p')[0].innerText = data.Comentario_Cliente;
                document.querySelector('#Comentarios_Cliente h6').textContent = data.Comentario_Cliente;
                document.querySelector('#Comentarios_Cliente').style.display = 'block';
            }
            if (data.Comentario_Cancelado != '') {
                this.template_comentarios_servicio.querySelectorAll('p')[1].innerText = data.Comentario_Cancelado;
            }
            const clone_comentarios = this.template_comentarios_servicio.cloneNode(true);
            this.fragment_info_servicio.appendChild(clone_comentarios);
        }

        this.fragment_info_servicio.appendChild(clone_reactivar_eliminar);
        if (display.SA == 'block')
            this.fragment_info_servicio.appendChild(this.fragment_historial_candidato);
        this.info_servicio.innerHTML = '';
        this.info_servicio.appendChild(this.fragment_info_servicio);

        document.querySelectorAll('#modal_ral input')[2].value = `${data.Nombres} ${data.Apellido_Paterno} ${data.Apellido_Materno}`;


        
        document.querySelector('#update-form [name="Ejecutivo"]').disabled = data.Ejecutivo_modificacion == 1 ? true : false;
        document.querySelector('#modal_schedule [name="Logistica"]').disabled = data.Gestor_modificacion == 1 ? true : false;

    }

    cargarInfoRAL(data, display) {
        this.template_ral.querySelectorAll('p')[0].textContent = data.Demandas == 1 ? 'Sin demandas' : (data.Demandas == 2 ? 'Con Demandas' : 'Sin asignar');
        this.template_ral.querySelectorAll('p')[1].textContent = data.Estado;
        this.template_ral.querySelectorAll('P')[2].textContent = data.Total_Demandas;
        this.template_ral.querySelectorAll('p')[3].textContent = data.Total_Acuerdos;
        this.template_ral.querySelectorAll('p')[4].textContent = data.Tipo_Juicio;
        this.template_ral.querySelector('button').style.display = display.Account;

        if (data.Demandas == 2) {
            this.template_ral.querySelector('div').style.display = 'block';
        } else {
            this.template_ral.querySelector('div').style.display = 'none';
        }

        const clone_ral = this.template_ral.cloneNode(true);

        this.fragment_ral.appendChild(clone_ral);

        this.content_ral.innerHTML = '';
        this.content_ral.appendChild(this.fragment_ral);
        console.log(data && display.Account);

        //document.querySelectorAll('#content_botones a')[1].style.display = data && (display.Account == 'block')? 'block' : 'none';
    }

    cargarBusquedaRAL(candidato_datos, busqueda_RAL, display) {
        this.template_busqueda_ral.querySelectorAll('input')[0].value = candidato_datos.Nombres.trim();
        this.template_busqueda_ral.querySelectorAll('input')[1].value = candidato_datos.Apellido_Paterno.trim() + ' ' + candidato_datos.Apellido_Materno.trim();
        this.template_busqueda_ral.querySelector('a').style.display = 'none';
        if (busqueda_RAL.status == 1) {
            this.template_busqueda_ral.querySelector('button').style.display = 'none';
            this.template_busqueda_ral.querySelector('h6').innerHTML = `Resultados de búsqueda: <b>${candidato_datos.Nombres} ${candidato_datos.Apellido_Paterno} ${candidato_datos.Apellido_Materno}</b>`;
            if (busqueda_RAL.expedientes.length > 0) {
                this.template_busqueda_ral.querySelector('a').style.display = 'inline-block';
                this.template_busqueda_ral.querySelector('a').setAttribute('href', busqueda_RAL.PDF_RAL);
                busqueda_RAL.expedientes.forEach(expediente => {
                    this.template_expediente_ral.querySelectorAll('a')[0].setAttribute('href', '#collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('h4')[0].innerHTML = `<b>${expediente.Actor}</b> | ${expediente.Demandado} | Exp ${expediente.Toca}`;
                    this.template_expediente_ral.querySelectorAll('b')[1].textContent = `${expediente.Estado} > ${expediente.Ciudad} > ${expediente.Juzgado}`;
                    this.template_expediente_ral.querySelectorAll('div')[2].setAttribute('id', 'collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('p')[0].textContent = `${expediente.Ciudad} > ${expediente.Juzgado}`;

                    this.template_expediente_ral.querySelectorAll('dd')[0].textContent = expediente.Actor;
                    this.template_expediente_ral.querySelectorAll('dd')[1].textContent = expediente.Demandado;
                    this.template_expediente_ral.querySelectorAll('dd')[2].textContent = expediente.Tipo;

                    this.template_expediente_ral.querySelectorAll('p')[1].innerHTML = `<b>RESUMEN: </b>El expediente <b>${expediente.Toca}</b> ${expediente.Tipo} fue promovido por <b>${expediente.Actor}</b> en contra de ${expediente.Demandado} en el ${expediente.Juzgado} en ${expediente.Ciudad}, ${expediente.Estado}. El proceso inició el ${expediente.Fecha} y cuenta con <b>${expediente.acuerdos.length}</b> notificaciones.`;
                    this.template_expediente_ral.querySelectorAll('a')[1].setAttribute('href', expediente.PDF_RAL);

                    this.template_expediente_ral.querySelectorAll('h4')[1].textContent = `Notificaciones del Expediente ${expediente.Toca}`;
                    let acuerdos = '';
                    this.template_expediente_ral
                    expediente.acuerdos.forEach(acuerdo => {
                        acuerdos += `
                        <div class="callout callout-navy">
                            <h6>${acuerdo.Fecha}</h6>
                            <p>${acuerdo.Acuerdo}</p>
                        </div>
                        `;
                    });

                    this.template_expediente_ral.querySelector('.card-navy .card-body').innerHTML = acuerdos;

                    const clone_expedientes_RAL = this.template_expediente_ral.cloneNode(true);
                    this.fragment_expediente_ral.appendChild(clone_expedientes_RAL);
                });
                this.template_busqueda_ral.querySelector('p').textContent = 'No. de Resultados: ' + busqueda_RAL.expedientes.length;
                this.template_expediente_ral.innerHTML = '';
                this.content_expediente_ral.appendChild(this.fragment_expediente_ral);
            } else {
                this.template_busqueda_ral.querySelector('p').textContent = 'No hay resultados. Por favor verifique los criterios de búsqueda.';
                this.template_busqueda_ral.querySelector('a').style.display = 'inline-block';
                this.template_busqueda_ral.querySelector('a').setAttribute('href', 'https://rrhh-ingenia.com.mx/formato/ral&candidato=' + candidato_datos.folio);
            }
        } else if (busqueda_RAL.status == 0) {
            this.template_busqueda_ral.querySelector('h6').innerHTML = '';
            this.template_busqueda_ral.querySelector('p').textContent = '';
        } else if (busqueda_RAL.status == 2) {
            this.template_busqueda_ral.querySelector('h6').innerHTML = `Resultados de búsqueda: <b>${candidato_datos.Nombres} ${candidato_datos.Apellido_Paterno} ${candidato_datos.Apellido_Materno}</b>`;
            this.template_busqueda_ral.querySelector('p').textContent = 'Algo salió mal. No se pudo obtener información de esa consulta. ¡Inténtalo de nuevo!';
        } else if (busqueda_RAL.status == 3) {
            this.template_busqueda_ral.querySelector('h6').innerHTML = `Búsqueda de <b>${busqueda_RAL.Nombres} ${busqueda_RAL.Apellidos}</b> realizada anteriormente para <b>${busqueda_RAL.Nombre_Cliente}</b> por <b>${busqueda_RAL.Creado}</b> el ${busqueda_RAL.Fecha}`;
            if (busqueda_RAL.expedientes.length > 0) {
                this.template_busqueda_ral.querySelector('a').style.display = 'inline-block';
                this.template_busqueda_ral.querySelector('a').setAttribute('href', busqueda_RAL.PDF_RAL);
                busqueda_RAL.expedientes.forEach(expediente => {
                    this.template_expediente_ral.querySelectorAll('a')[0].setAttribute('href', '#collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('h4')[0].innerHTML = `<b>${expediente.Actor}</b> | ${expediente.Demandado} | Exp ${expediente.Toca}`;
                    this.template_expediente_ral.querySelectorAll('b')[1].textContent = `${expediente.Estado} > ${expediente.Ciudad} > ${expediente.Juzgado}`;
                    this.template_expediente_ral.querySelectorAll('div')[2].setAttribute('id', 'collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('p')[0].textContent = `${expediente.Ciudad} > ${expediente.Juzgado}`;

                    this.template_expediente_ral.querySelectorAll('dd')[0].textContent = expediente.Actor;
                    this.template_expediente_ral.querySelectorAll('dd')[1].textContent = expediente.Demandado;
                    this.template_expediente_ral.querySelectorAll('dd')[2].textContent = expediente.Tipo;

                    this.template_expediente_ral.querySelectorAll('p')[1].innerHTML = `<b>RESUMEN: </b>El expediente <b>${expediente.Toca}</b> ${expediente.Tipo} fue promovido por <b>${expediente.Actor}</b> en contra de ${expediente.Demandado} en el ${expediente.Juzgado} en ${expediente.Ciudad}, ${expediente.Estado}. El proceso inició el ${expediente.Fecha} y cuenta con <b>${expediente.acuerdos.length}</b> notificaciones.`;
                    this.template_expediente_ral.querySelectorAll('a')[1].setAttribute('href', expediente.PDF_RAL);

                    this.template_expediente_ral.querySelectorAll('h4')[1].textContent = `Notificaciones del Expediente ${expediente.Toca}`;
                    let acuerdos = '';
                    this.template_expediente_ral
                    expediente.acuerdos.forEach(acuerdo => {
                        acuerdos += `
                        <div class="callout callout-navy">
                            <h6>${acuerdo.Fecha}</h6>
                            <p>${acuerdo.Acuerdo}</p>
                        </div>
                        `;
                    });

                    this.template_expediente_ral.querySelector('.card-navy .card-body').innerHTML = acuerdos;

                    const clone_expedientes_RAL = this.template_expediente_ral.cloneNode(true);
                    this.fragment_expediente_ral.appendChild(clone_expedientes_RAL);
                });
                this.template_busqueda_ral.querySelector('p').textContent = 'No. de Resultados: ' + busqueda_RAL.expedientes.length;
                this.template_expediente_ral.innerHTML = '';
                this.content_expediente_ral.appendChild(this.fragment_expediente_ral);
            }
        } else if (busqueda_RAL.status == 4) {
            this.template_busqueda_ral.querySelector('h6').innerHTML = `Búsqueda de <b>${busqueda_RAL.Nombres} ${busqueda_RAL.Apellidos}</b> realizada anteriormente para <b>${busqueda_RAL.Nombre_Cliente}</b> por <b>${busqueda_RAL.Creado}</b> el ${busqueda_RAL.Fecha}`;
            this.template_busqueda_ral.querySelectorAll('button')[0].style.display = 'none';
            if (busqueda_RAL.expedientes.length > 0) {
                this.template_busqueda_ral.querySelector('a').style.display = 'inline-block';
                this.template_busqueda_ral.querySelector('a').setAttribute('href', busqueda_RAL.PDF_RAL);
                busqueda_RAL.expedientes.forEach(expediente => {
                    this.template_expediente_ral.querySelectorAll('a')[0].setAttribute('href', '#collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('h4')[0].innerHTML = `<b>${expediente.Actor}</b> | ${expediente.Demandado} | Exp ${expediente.Toca}`;
                    this.template_expediente_ral.querySelectorAll('b')[1].textContent = `${expediente.Estado} > ${expediente.Ciudad} > ${expediente.Juzgado}`;
                    this.template_expediente_ral.querySelectorAll('div')[2].setAttribute('id', 'collapse' + expediente.ID);
                    this.template_expediente_ral.querySelectorAll('p')[0].textContent = `${expediente.Ciudad} > ${expediente.Juzgado}`;

                    this.template_expediente_ral.querySelectorAll('dd')[0].textContent = expediente.Actor;
                    this.template_expediente_ral.querySelectorAll('dd')[1].textContent = expediente.Demandado;
                    this.template_expediente_ral.querySelectorAll('dd')[2].textContent = expediente.Tipo;

                    this.template_expediente_ral.querySelectorAll('p')[1].innerHTML = `<b>RESUMEN: </b>El expediente <b>${expediente.Toca}</b> ${expediente.Tipo} fue promovido por <b>${expediente.Actor}</b> en contra de ${expediente.Demandado} en el ${expediente.Juzgado} en ${expediente.Ciudad}, ${expediente.Estado}. El proceso inició el ${expediente.Fecha} y cuenta con <b>${expediente.acuerdos.length}</b> notificaciones.`;
                    this.template_expediente_ral.querySelectorAll('a')[1].setAttribute('href', expediente.PDF_RAL);

                    this.template_expediente_ral.querySelectorAll('h4')[1].textContent = `Notificaciones del Expediente ${expediente.Toca}`;
                    let acuerdos = '';
                    this.template_expediente_ral
                    expediente.acuerdos.forEach(acuerdo => {
                        acuerdos += `
                        <div class="callout callout-navy">
                            <h6>${acuerdo.Fecha}</h6>
                            <p>${acuerdo.Acuerdo}</p>
                        </div>
                        `;
                    });

                    this.template_expediente_ral.querySelector('.card-navy .card-body').innerHTML = acuerdos;

                    const clone_expedientes_RAL = this.template_expediente_ral.cloneNode(true);
                    this.fragment_expediente_ral.appendChild(clone_expedientes_RAL);
                });
                this.template_busqueda_ral.querySelector('p').textContent = 'No. de Resultados: ' + busqueda_RAL.expedientes.length;
                this.template_expediente_ral.innerHTML = '';
                this.content_expediente_ral.appendChild(this.fragment_expediente_ral);
            } else {
                this.template_busqueda_ral.querySelector('p').textContent = 'No hay resultados. Por favor verifique los criterios de búsqueda.';
                this.template_busqueda_ral.querySelector('a').style.display = 'inline-block';
                this.template_busqueda_ral.querySelector('a').setAttribute('href', 'http://reclutamiento.rrhh-ingenia.com/formato/ral&candidato=' + busqueda_RAL.Candidato);
            }
        }

        const clone_busqueda_RAL = this.template_busqueda_ral.cloneNode(true);
        this.fragment_busqueda_ral.appendChild(clone_busqueda_RAL);
        this.content_busqueda_ral.innerHTML = '';
        this.content_busqueda_ral.appendChild(this.fragment_busqueda_ral);
    }


    cargarPropioRAL(candidato_datos, busqueda_RAL, display) {
        if (busqueda_RAL.length > 0) {

            /* 
                        let nombre_estados = [];
                        busqueda_RAL.forEach(expediente => {
                            if (!nombre_estados.includes(expediente.Estado)) {
                                nombre_estados.push(expediente.Estado)
                                this.template_propio_ral_estados.querySelectorAll('a')[0].setAttribute('href', '#collapsestados' + expediente.id_estado);
                                this.template_propio_ral_estados.querySelectorAll('h4')[0].textContent = expediente.Estado
                                this.template_propio_ral_estados.querySelector('div .collapsestados').setAttribute('id', 'collapsestados' + expediente.id_estado);

                                const clone_expedientes_RAL = this.template_propio_ral_estados.cloneNode(true);
                                this.fragment_propio_ral.appendChild(clone_expedientes_RAL);
                            }
                        }); 
            */

            busqueda_RAL.forEach(expediente => {
                this.template_propio_ral.querySelectorAll('a')[0].setAttribute('href', '#collapseral' + expediente.id);

                if (expediente.Estado == 'San Luis Potosi') {
                    this.template_propio_ral.querySelectorAll('h4')[0].innerHTML = `<b>${expediente.Actor}| ${expediente.Demandado} | Exp ${expediente.Expediente}`;
                } else if (expediente.Estado == 'Tamaulipas') {
                    this.template_propio_ral.querySelectorAll('h4')[0].innerHTML = `<b>${expediente.Resumen} | Exp ${expediente.Expediente}`;
                }

                this.template_propio_ral.querySelectorAll('b')[1].textContent = `${expediente.Estado} > ${expediente.Municipio!=''?expediente.Municipio+'>':''} ${expediente.Juzgado}`;
                this.template_propio_ral.querySelector('div .collapseral').setAttribute('id', 'collapseral' + expediente.id);

                this.template_propio_ral.querySelectorAll('p')[0].textContent = `${expediente.Actor!=''?'Actor: '+expediente.Actor:''}`;
                this.template_propio_ral.querySelectorAll('p')[1].textContent = `${expediente.Demandado!=''?'Demandado: '+expediente.Demandado:''}`;
                this.template_propio_ral.querySelectorAll('p')[2].textContent = `${expediente.Municipio!=''?expediente.Municipio+'>':''} ${expediente.Juzgado}`;

                if (expediente.Estado == 'San Luis Potosi') {
                    this.template_propio_ral.querySelectorAll('p')[3].innerHTML = `<b>RESUMEN: </b>${expediente.Resumen} fue promovido en el ${expediente.Juzgado} en ${expediente.Municipio}, ${expediente.Estado}. El proceso inició el ${expediente.Fecha} y cuenta con <b>${expediente.Acuerdos.length}</b> notificaciones.`;
                } else if (expediente.Estado == 'Tamaulipas') {
                    this.template_propio_ral.querySelectorAll('p')[3].innerHTML = `<b>RESUMEN: </b>El expediente <b>${expediente.Expediente}</b> ${expediente.Resumen} fue promovido en el ${expediente.Juzgado} en ${expediente.Municipio}, ${expediente.Estado}. El proceso inició el ${expediente.Fecha} y cuenta con <b>${expediente.Acuerdos.length}</b> notificaciones.`;
                }

                this.template_propio_ral.querySelectorAll('h4')[1].textContent = `Notificaciones del Expediente ${expediente.Expediente}`;
                let acuerdos = '';
                this.template_propio_ral
                expediente.Acuerdos.forEach(acuerdo => {
                    acuerdos += `
                    <div class="callout callout-navy">
                        <h6>${acuerdo.Fecha}</h6>
                        <p>${acuerdo.Resumen}</p>
                    </div>
                    `;
                });

                this.template_propio_ral.querySelector('.card-navy .card-body').innerHTML = acuerdos;
                const clone_expedientes_RAL = this.template_propio_ral.cloneNode(true);
                this.fragment_propio_ral.appendChild(clone_expedientes_RAL);
            });

            //this.template_busqueda_ral.querySelector('p').textContent = 'No. de Resultados: '+busqueda_RAL.expedientes.length;
            this.content_propio_ral.innerHTML = '';
            let p = document.createElement('p');
            p.textContent = 'No. de Resultados de encontrados: ' + busqueda_RAL.length;
            this.content_propio_ral.appendChild(p);
            this.content_propio_ral.appendChild(this.fragment_propio_ral);
        }
    }



    cargarComentariosRAL(data, display) {
        this.template_comentarios_ral.querySelectorAll('p')[0].innerText = data.Comentarios;

        const clone_comentarios_ral = this.template_comentarios_ral.cloneNode(true);

        this.fragment_comentarios_ral.appendChild(clone_comentarios_ral);

        this.content_comentarios_ral.innerHTML = '';
        this.content_comentarios_ral.appendChild(this.fragment_comentarios_ral);

    }

    cargarValidacionLicencia(data, display) {
        this.template_licencia.querySelectorAll('p')[0].textContent = data.Tipo_Licencia == 1 ? 'Federal' : (data.Tipo_Licencia == 2 ? 'Estatal' : '');
        this.template_licencia.querySelectorAll('p')[1].textContent = data.Numero_Licencia;
        this.template_licencia.querySelectorAll('p')[2].textContent = ((data.CategoriaA == 1 ? 'A, ' : '') + (data.CategoriaB == 1 ? 'B, ' : '') + (data.CategoriaC == 1 ? 'C, ' : '') + (data.CategoriaD == 1 ? 'D, ' : '') + (data.CategoriaE == 1 ? 'E, ' : '') + (data.CategoriaF == 1 ? 'F, ' : ''));
        this.template_licencia.querySelectorAll('p')[3].textContent = data.Licencia_Vigente_Del;
        this.template_licencia.querySelectorAll('p')[4].textContent = data.Licencia_Vigente_Hasta;
        this.template_licencia.querySelector('button').style.display = display.Account;

        this.template_examen_medico.querySelectorAll('p')[0].textContent = data.Numero_Examen;
        this.template_examen_medico.querySelectorAll('p')[1].textContent = data.Tipo_Examen;
        this.template_examen_medico.querySelectorAll('p')[2].textContent = data.Resultado_Examen;
        this.template_examen_medico.querySelectorAll('p')[3].textContent = data.Fecha_Dictamen_Examen;
        this.template_examen_medico.querySelectorAll('p')[4].textContent = data.Vigente_Hasta_Examen;
        this.template_examen_medico.querySelector('button').style.display = display.Account;

        this.template_resultado_licencia.querySelectorAll('p')[0].textContent = data.Caracteristicas;
        this.template_resultado_licencia.querySelectorAll('p')[1].textContent = data.Resultado;
        this.template_resultado_licencia.querySelector('button').style.display = display.Account;

        if (data.Tipo_Licencia == 1) {
            this.template_licencia.querySelectorAll('.row')[0].style.display = 'block';
            this.template_licencia.querySelectorAll('.row')[1].style.display = 'none';
        } else if (data.Tipo_Licencia == 2) {
            this.template_licencia.querySelectorAll('.row')[0].style.display = 'none';
            this.template_licencia.querySelectorAll('.row')[1].style.display = 'block';
        }

        const clone_licencia = this.template_licencia.cloneNode(true);
        this.fragment_licencia.appendChild(clone_licencia);
        this.content_licencia.innerHTML = '';
        this.content_licencia.appendChild(this.fragment_licencia);

        const clone_examen_medico = this.template_examen_medico.cloneNode(true);
        this.fragment_examen_medico.appendChild(clone_examen_medico);
        this.content_examen_medico.innerHTML = '';
        this.content_examen_medico.appendChild(this.fragment_examen_medico);

        const clone_resultado_licencia = this.template_resultado_licencia.cloneNode(true);
        this.fragment_resultado_licencia.appendChild(clone_resultado_licencia);
        this.content_resultado_licencia.innerHTML = '';
        this.content_resultado_licencia.appendChild(this.fragment_resultado_licencia);

        document.querySelectorAll('#content_botones a')[0].style.display = data && display.Account == 'block' ? 'block' : 'none';
    }

    cargarCapturasRAL(data, display) {
        console.log(data);
        data.forEach(element => {
            this.template_captura_ral.querySelectorAll('td')[0].textContent = element.Folio;
            this.template_captura_ral.querySelectorAll('td')[1].textContent = element.Archivo;
            this.template_captura_ral.querySelectorAll('button')[1].style.display = display.Account;
            this.template_captura_ral.querySelectorAll('.btn-success')[0].dataset.id = element.Imagen;
            this.template_captura_ral.querySelectorAll('.btn-info')[0].dataset.id = element.Imagen;
            this.template_captura_ral.querySelectorAll('.btn-danger')[0].dataset.id = element.Imagen;

            const clone_captura_ral = this.template_captura_ral.cloneNode(true);
            this.fragment_captura_ral.appendChild(clone_captura_ral);
        });
        this.content_capturas_ral.innerHTML = '';
        this.content_capturas_ral.appendChild(this.fragment_captura_ral);
    }

    cargarDatosGenerales(data, display) {
        var clones_datos_generales = new Array();
        this.template_datos_generales.querySelectorAll('p')[0].textContent = data.Nacimiento;
        this.template_datos_generales.querySelectorAll('p')[1].textContent = data.Edad;
        this.template_datos_generales.querySelectorAll('p')[2].textContent = data.Sexo;
        this.template_datos_generales.querySelectorAll('p')[3].textContent = data.Lugar_Nacimiento;
        this.template_datos_generales.querySelectorAll('p')[4].textContent = data.Estado_Civil;
        this.template_datos_generales.querySelectorAll('p')[5].textContent = data.Fecha_Matrimonio;
        this.template_datos_generales.querySelectorAll('p')[6].textContent = data.Hijos;
        this.template_datos_generales.querySelectorAll('p')[7].textContent = data.Nacionalidad;
        this.template_datos_generales.querySelectorAll('p')[8].textContent = data.Vive_con;
        this.template_datos_generales.querySelectorAll('p')[9].textContent = data.CURP;
        this.template_datos_generales.querySelectorAll('p')[10].textContent = data.IMSS;
        this.template_datos_generales.querySelectorAll('p')[11].textContent = data.RFC;

        if (data.ID_Empresa == 413) {
            this.template_datos_generales.querySelectorAll('b')[12].style.display = 'block'
            this.template_datos_generales.querySelectorAll('p')[12].textContent = data.Numero_Licencia;
        }
        for (let i = 0; i < this.content_datos_generales.length; i++) {
            clones_datos_generales[i] = this.template_datos_generales.cloneNode(true);
            this.fragment_datos_generales[i].appendChild(clones_datos_generales[i]);

            this.content_datos_generales[i].innerHTML = '';
            this.content_datos_generales[i].appendChild(this.fragment_datos_generales[i]);
        }


    }

    cargarContacto(data) {
        var clones_contacto = new Array();
        this.template_contacto.querySelectorAll('p')[0].textContent = data.Telefono_fijo;
        this.template_contacto.querySelectorAll('p')[1].textContent = data.Celular;
        this.template_contacto.querySelectorAll('p')[2].textContent = data.Otro_Contacto;
        this.template_contacto.querySelectorAll('p')[3].textContent = data.Correos;
        this.template_contacto.querySelectorAll('p')[4].textContent = data.Linkedin;
        this.template_contacto.querySelectorAll('p')[5].textContent = data.Facebook;

        this.template_contacto.querySelectorAll('b')[0].style.display = data.Telefono_fijo ? 'block' : 'none';
        this.template_contacto.querySelectorAll('p')[0].style.display = data.Telefono_fijo ? 'block' : 'none';

        this.template_contacto.querySelectorAll('b')[4].style.display = data.Linkedin ? 'block' : 'none';
        this.template_contacto.querySelectorAll('p')[4].style.display = data.Linkedin ? 'block' : 'none';

        this.template_contacto.querySelectorAll('b')[5].style.display = data.Facebook ? 'block' : 'none';
        this.template_contacto.querySelectorAll('p')[5].style.display = data.Facebook ? 'block' : 'none';

        this.template_contacto.querySelectorAll('p')[6].textContent = data.Domicilio;

        for (let i = 0; i < this.content_contacto.length; i++) {
            clones_contacto[i] = this.template_contacto.cloneNode(true);
            this.fragment_contacto[i].appendChild(clones_contacto[i]);
            this.content_contacto[i].innerHTML = '';
            this.content_contacto[i].appendChild(this.fragment_contacto[i]);
        }

    }

    cargarReferenciasLaborales(data, display, Empresa, Cliente) {
        data.forEach(element => {
            this.template_referencia_laboral.querySelectorAll('div')[0].setAttribute('renglon', element.Renglon);
            this.template_referencia_laboral.querySelectorAll('p')[0].textContent = element.Empresa;
            this.template_referencia_laboral.querySelectorAll('p')[1].textContent = element.Giro;
            this.template_referencia_laboral.querySelectorAll('p')[2].textContent = element.Domicilio;
            this.template_referencia_laboral.querySelectorAll('p')[3].textContent = element.Telefono;
            this.template_referencia_laboral.querySelectorAll('p')[4].textContent = element.Fecha_Ingreso;
            this.template_referencia_laboral.querySelectorAll('p')[5].textContent = element.Fecha_Baja;
            this.template_referencia_laboral.querySelectorAll('p')[6].textContent = element.Puesto_Inicial;
            this.template_referencia_laboral.querySelectorAll('p')[7].textContent = element.Puesto_Final;
            this.template_referencia_laboral.querySelectorAll('p')[8].textContent = element.Jefe;
            this.template_referencia_laboral.querySelectorAll('p')[9].textContent = element.Puesto_Jefe;
            this.template_referencia_laboral.querySelectorAll('p')[10].textContent = element.Motivo_Separacion;
            this.template_referencia_laboral.querySelectorAll('p')[11].textContent = element.Dopaje == 1 ? 'Sí' : 'No';
            this.template_referencia_laboral.querySelectorAll('p')[12].textContent = element.Recontratable == 1 ? 'Sí' : 'No';
            this.template_referencia_laboral.querySelectorAll('p')[13].textContent = element.Recontratable_PorQue;
            this.template_referencia_laboral.querySelectorAll('p')[14].textContent = element.Informante;
            this.template_referencia_laboral.querySelectorAll('p')[15].innerText = element.Comentarios;
            this.template_referencia_laboral.querySelector('.btn-info').dataset.id = element.Renglon;
            this.template_referencia_laboral.querySelector('.btn-danger').dataset.id = element.Renglon;
            this.template_referencia_laboral.querySelector('.btn-info').style.display = display.Account;
            this.template_referencia_laboral.querySelector('.btn-danger').style.display = display.Account;

            if (element.Calif == 1) {
                this.template_referencia_laboral.querySelector('.table-responsive').style.display = "none";
            } else {
                this.template_referencia_laboral.querySelector('.table-responsive').style.display = "block";
                if (element.Desempeno == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Desempeno == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Desempeno == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Desempeno == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[1].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

                if (element.Honradez == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Honradez == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Honradez == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Honradez == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[2].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

                if (element.Puntualidad == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Puntualidad == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Puntualidad == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Puntualidad == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[3].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

                if (element.Relacion == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Relacion == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Relacion == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Relacion == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[4].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

                if (element.Responsabilidad == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Responsabilidad == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Responsabilidad == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Responsabilidad == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[5].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

                if (element.Adaptacion == 260) {
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[1].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Adaptacion == 261) {
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-info'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Adaptacion == 262) {
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-warning'></i>";
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[3].innerHTML = '';
                } else if (element.Adaptacion == 263) {
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[0].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[1].innerHTML = "";
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[2].innerHTML = '';
                    this.template_referencia_laboral.querySelectorAll('tr')[6].querySelectorAll('td')[3].innerHTML = "<i class='fas fa-circle text-danger'></i>";
                }

            }

            if (Cliente == 314) {
                this.template_referencia_laboral.querySelectorAll('.col-sm-6')[11].style.display = 'block';
            }

            //if (element.Sindicalizado && Empresa == 190)
            this.template_referencia_laboral.querySelector('.sindicato-cementin').style.display = 'none';
            if (Empresa == 190) {
                //document.querySelectorAll('.sindicato-cementin')[0].style.display = 'block';
                //document.querySelectorAll('.sindicato-cementin')[1].style.display = 'block';
                this.template_referencia_laboral.querySelector('.sindicato-cementin').style.display = 'block';
                document.querySelector('#modal_referencia_laboral .sindicato-cementin').style.display = 'block';
            }

            this.template_referencia_laboral.querySelectorAll('p')[16].textContent = element.Sindicalizado == 1 ? 'Sí' : (element.Sindicalizado == 0 ? 'No' : '');
            this.template_referencia_laboral.querySelectorAll('p')[17].textContent = element.Sindicato;
            this.template_referencia_laboral.querySelectorAll('p')[18].textContent = element.Comite_Sindical == 1 ? 'Sí' : (element.Comite_Sindical == 0 ? 'No' : '');
            this.template_referencia_laboral.querySelectorAll('p')[19].textContent = element.Puesto_Sindical;
            this.template_referencia_laboral.querySelectorAll('p')[20].textContent = element.Funciones_Sindicato;
            this.template_referencia_laboral.querySelectorAll('p')[21].textContent = element.Tiempo_Sindicato;

            const clone = this.template_referencia_laboral.cloneNode(true);
            this.fragment_referencia_laboral.appendChild(clone);
        });
        this.content_referencias_laborales.innerHTML = '';
        this.content_referencias_laborales.appendChild(this.fragment_referencia_laboral);
    }

    cargarDocumentos(data, display, comentario = false, Redes_Sociales = false) {
        var clones_documento = new Array();
        data.forEach(element => {
            this.template_documento.querySelectorAll('td')[0].textContent = element.Descripcion;
            this.template_documento.querySelector('.btn-info').dataset.id = element.Foto;
            this.template_documento.querySelector('.btn-danger').dataset.id = element.Foto;
            this.template_documento.querySelector('.btn-success').dataset.id = element.Foto;
            //this.template_documento.querySelector('.btn-success').style.display = display.SA;
            this.template_documento.querySelector('.btn-info').style.display = display.SA;
            this.template_documento.querySelector('.btn-danger').style.display = display.SA;

            for (let i = 0; i < this.content_documentos.length; i++) {
                clones_documento[i] = this.template_documento.cloneNode(true);
                this.fragment_documento[i].appendChild(clones_documento[i]);
            }
        });

        for (let i = 0; i < this.content_documentos.length; i++) {
            this.content_documentos[i].innerHTML = '';
            this.content_documentos[i].appendChild(this.fragment_documento[i]);

            if (comentario) {
                this.content_documentos[i].parentElement.parentElement.parentElement.children[5].textContent = comentario;
            }

            if (Redes_Sociales) {
                this.content_documentos[i].parentElement.parentElement.parentElement.children[8].textContent = Redes_Sociales;
            }
        }
    }

    cargarInvestigacion(data, display, Empresa) {
        this.template_investigacion.querySelectorAll('p')[0].textContent = data.Circunstancias_Laborales;
        this.template_investigacion.querySelectorAll('p')[1].textContent = data.Proporciono_Datos_Empleos;
        this.template_investigacion.querySelectorAll('p')[2].textContent = data.Motivo_No_Proporciono_Datos;
        this.template_investigacion.querySelectorAll('p')[3].textContent = data.Demanda_Laboral;
        this.template_investigacion.querySelectorAll('p')[4].textContent = data.Motivo_Demanda;
        this.template_investigacion.querySelectorAll('p')[5].textContent = data.No_Empleos;
        this.template_investigacion.querySelector('button').style.display = display.Account;


        if (Empresa == 190) {
            //document.querySelectorAll('.sindicato-cementin')[0].style.display = 'block';
            //document.querySelectorAll('.sindicato-cementin')[1].style.display = 'block';
            this.template_investigacion.querySelector('.sindicato-cementin').style.display = 'block';
            document.querySelector('#modal_investigacion .sindicato-cementin').style.display = 'block';
        }

        if (Empresa == 130) {
            this.template_investigacion.querySelector('.trabajo-ternium').style.display = 'block';
            document.querySelector('#modal_investigacion .trabajo-ternium').style.display = 'block';
        }

        if (Empresa == 167) {
            this.template_investigacion.querySelector('.preguntas-operador').style.display = 'block';
            document.querySelector('#modal_investigacion .preguntas-operador').style.display = 'block';
        }

        this.template_investigacion.querySelectorAll('p')[6].textContent = data.Sindicalizado == 1 ? 'Sí' : (data.Sindicalizado == 0 ? 'No' : '');
        this.template_investigacion.querySelectorAll('p')[7].textContent = data.Sindicato;
        this.template_investigacion.querySelectorAll('p')[8].textContent = data.Comite_Sindical == 1 ? 'Sí' : (data.Comite_Sindical == 0 ? 'No' : '');
        this.template_investigacion.querySelectorAll('p')[9].textContent = data.Puesto_Sindical;
        this.template_investigacion.querySelectorAll('p')[10].textContent = data.Funciones_Sindicato;
        this.template_investigacion.querySelectorAll('p')[11].textContent = data.Tiempo_Sindicato;
        this.template_investigacion.querySelectorAll('p')[12].textContent = data.Trabajo_Ternium;
        this.template_investigacion.querySelectorAll('p')[13].textContent = data.Alta_Ternium;
        this.template_investigacion.querySelectorAll('p')[14].textContent = data.Veto_Ternium;

        this.template_investigacion.querySelectorAll('p')[15].textContent = data.Positivo_Antidoping;
        this.template_investigacion.querySelectorAll('p')[16].textContent = data.Sustancia_Antidoping;
        this.template_investigacion.querySelectorAll('p')[17].textContent = data.Accidentes_Empresa;
        this.template_investigacion.querySelectorAll('p')[18].textContent = data.Abandono_Unidad;
        const clone_investigacion = this.template_investigacion.cloneNode(true);
        this.fragment_investigacion.appendChild(clone_investigacion);

        this.content_investigacion.innerHTML = '';
        this.content_investigacion.appendChild(this.fragment_investigacion);
    }

    cargarComentariosGeneralesInv(observaciones) {
        if (observaciones.Info_Proporcionada_Candidato == 242) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Info_Proporcionada_Candidato == 241) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Info_Proporcionada_Candidato == 240) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        if (observaciones.Referencias_Laborales == 242) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Referencias_Laborales == 241) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Referencias_Laborales == 240) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        if (observaciones.Info_Confiable == 242) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Info_Confiable == 241) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = '';
        } else if (observaciones.Info_Confiable == 240) {
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = '';
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "";
            this.template_comentarios_generales_inv.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        this.template_comentarios_generales_inv.querySelectorAll('p')[0].innerText = observaciones.Comentario_General_il;
        this.template_comentarios_generales_inv.querySelectorAll('p')[1].innerText = observaciones.Viable == 0 ? 'Viable' : (observaciones.Viable == 1 ? 'No viable' : (observaciones.Viable == 2 ? 'Viable con reservas' : (observaciones.Viable == 4 ? 'Sin viabilidad' : (observaciones.Viable == 5 ? 'Viable con observaciones' : ''))));

        const clone_comentarios_generales_inv = this.template_comentarios_generales_inv.cloneNode(true);
        this.fragment_comentarios_generales_inv.appendChild(clone_comentarios_generales_inv);
        this.content_comentarios_generales_inv.innerHTML = "";
        this.content_comentarios_generales_inv.appendChild(this.fragment_comentarios_generales_inv);
    }

    cargarConociendoCandidato(data, display) {
        this.template_conociendo_candidato.querySelectorAll('p')[0].textContent = data.Interes_Puesto;
        this.template_conociendo_candidato.querySelectorAll('p')[1].textContent = data.Que_Esperas_Lograr;
        this.template_conociendo_candidato.querySelectorAll('p')[2].textContent = data.Caracteristicas_Empleo;
        this.template_conociendo_candidato.querySelectorAll('p')[3].textContent = data.Objetivo_Laboral;
        this.template_conociendo_candidato.querySelectorAll('p')[4].textContent = data.Que_Esperas_Empresa;
        this.template_conociendo_candidato.querySelectorAll('p')[5].textContent = data.Cualidades;
        this.template_conociendo_candidato.querySelectorAll('p')[6].textContent = data.Trabajo_Equipo;
        this.template_conociendo_candidato.querySelectorAll('p')[7].textContent = data.Ultimos_Jefes;
        this.template_conociendo_candidato.querySelectorAll('p')[8].textContent = data.Que_Esperas_Aportar;
        this.template_conociendo_candidato.querySelectorAll('p')[9].textContent = data.Jornada_Laboral;
        this.template_conociendo_candidato.querySelectorAll('p')[10].textContent = data.Motivacion;
        this.template_conociendo_candidato.querySelectorAll('p')[11].textContent = data.Que_Dirian_Jefes_Anteriores;
        this.template_conociendo_candidato.querySelectorAll('p')[12].textContent = data.Orgullo_Trayectoria_Laboral;
        this.template_conociendo_candidato.querySelectorAll('p')[13].textContent = data.No_Te_Gusto_Empleos_Anteriores;
        this.template_conociendo_candidato.querySelectorAll('p')[14].textContent = data.Estas_Otros_Procesos;
        this.template_conociendo_candidato.querySelector('button').style.display = display.Logistics;

        const clone_conociendo_candidato = this.template_conociendo_candidato.cloneNode(true);
        this.fragment_conociendo_candidato.appendChild(clone_conociendo_candidato);

        this.content_conociendo_candidato.innerHTML = '';
        this.content_conociendo_candidato.appendChild(this.fragment_conociendo_candidato);
    };

    cargarEscolaridad(data, comentario) {
        var clones_escolaridad = new Array();
        data.forEach(escolaridad => {
            this.template_escolaridad.querySelectorAll('p')[0].textContent = escolaridad.Grado;
            this.template_escolaridad.querySelectorAll('p')[1].textContent = escolaridad.Institucion;
            this.template_escolaridad.querySelectorAll('p')[2].textContent = escolaridad.Localidad;
            this.template_escolaridad.querySelectorAll('p')[3].textContent = escolaridad.Periodo;
            this.template_escolaridad.querySelectorAll('p')[4].textContent = escolaridad.Documento;
            this.template_escolaridad.querySelectorAll('p')[5].textContent = escolaridad.Folio;

            for (let i = 0; i < this.content_escolaridad.length; i++) {
                this.content_escolaridad[i].parentElement.children[0].dataset.id = escolaridad.Renglon;
                clones_escolaridad[i] = this.template_escolaridad.cloneNode(true);
                this.fragment_escolaridad[i].appendChild(clones_escolaridad[i]);
            }

        });
        for (let i = 0; i < this.content_escolaridad.length; i++) {
            this.content_escolaridad[i].innerHTML = "";
            this.content_escolaridad[i].appendChild(this.fragment_escolaridad[i]);

            const b = document.createElement('b');
            b.textContent = 'Comentarios';
            const p = document.createElement('p');
            p.innerText = comentario;
            this.content_escolaridad[i].appendChild(b);
            this.content_escolaridad[i].appendChild(p);
        }

    }

    cargarCohabitantes(data, display, comentario = false) {
        var clones_cohabitantes = new Array();
        data.forEach(element => {
            this.template_cohabitante.querySelectorAll('td')[0].textContent = element.Nombre;
            this.template_cohabitante.querySelectorAll('td')[1].textContent = element.Parentesco;
            this.template_cohabitante.querySelectorAll('td')[2].textContent = `${element.Edad} ${element.Edad_2}`;
            this.template_cohabitante.querySelectorAll('td')[3].textContent = element.Estado_Civil;
            this.template_cohabitante.querySelectorAll('td')[4].textContent = element.Ocupacion;
            this.template_cohabitante.querySelectorAll('td')[5].textContent = element.Empresa;
            this.template_cohabitante.querySelectorAll('td')[6].textContent = element.Dependiente == 1 ? 'Sí' : 'No';
            this.template_cohabitante.querySelectorAll('td')[7].textContent = element.Telefono;
            this.template_cohabitante.querySelector('.btn-info').dataset.id = element.Renglon;
            this.template_cohabitante.querySelector('.btn-danger').dataset.id = element.Renglon;
            this.template_cohabitante.querySelector('.btn-info').style.display = display.SA;
            this.template_cohabitante.querySelector('.btn-danger').style.display = display.SA;

            for (let i = 0; i < this.content_cohabitantes.length; i++) {
                clones_cohabitantes[i] = this.template_cohabitante.cloneNode(true);
                this.fragment_cohabitante[i].appendChild(clones_cohabitantes[i]);

            }

        });

        for (let i = 0; i < this.content_cohabitantes.length; i++) {
            this.content_cohabitantes[i].innerHTML = "";
            this.content_cohabitantes[i].appendChild(this.fragment_cohabitante[i]);


            if (comentario) {
                this.content_cohabitantes[i].parentElement.parentElement.parentElement.children[5].textContent = comentario
            }
        }
    }

    cargarCirculoFamiliar(data, display) {
        data.forEach(element => {
            this.template_circulo_familiar.querySelectorAll('td')[0].textContent = element.Nombre_Parentesco;
            this.template_circulo_familiar.querySelectorAll('td')[1].textContent = element.Parentesco;
            this.template_circulo_familiar.querySelectorAll('td')[2].textContent = element.Telefono_Parentesco;
            this.template_circulo_familiar.querySelector('.btn-info').dataset.id = element.Id;
            this.template_circulo_familiar.querySelector('.btn-danger').dataset.id = element.Id;
            this.template_circulo_familiar.querySelector('.btn-info').style.display = display.Logistics;
            this.template_circulo_familiar.querySelector('.btn-danger').style.display = display.Logistics;
            if (element.Estatus == 'Finado') {
                this.template_circulo_familiar.querySelectorAll('td')[3].textContent = '';
                this.template_circulo_familiar.querySelectorAll('td')[4].textContent = 'X';
            } else {
                this.template_circulo_familiar.querySelectorAll('td')[3].textContent = 'X';
                this.template_circulo_familiar.querySelectorAll('td')[4].textContent = '';
            }
            const clone_circulo_familiar = this.template_circulo_familiar.cloneNode(true);
            this.fragment_circulo_familiar.appendChild(clone_circulo_familiar);
        });

        this.content_circulo_familiar.innerHTML = '';
        this.content_circulo_familiar.appendChild(this.fragment_circulo_familiar);

        if (data.length == 0) {
            document.querySelector('#vert-tabs-circulo_familiar-tab').hidden = true;
            document.querySelector('#vert-tabs-circulo_familiar').hidden = true;
        }
    }

    cargarHistorialSalud(historial_salud, salud_seguros) {
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[0].querySelectorAll('td')[0].textContent = historial_salud.Diabetes;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[1].querySelectorAll('td')[0].textContent = historial_salud.Cancer;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[2].querySelectorAll('td')[0].textContent = historial_salud.Hipertension;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[3].querySelectorAll('td')[0].textContent = historial_salud.Disfuncion_Renal;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[4].querySelectorAll('td')[0].textContent = historial_salud.Fibrosis_Quistica;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[5].querySelectorAll('td')[0].textContent = historial_salud.Miopia;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[6].querySelectorAll('td')[0].textContent = historial_salud.Asma;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[7].querySelectorAll('td')[0].textContent = historial_salud.Migranas;
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[8].querySelectorAll('td')[0].textContent = historial_salud.Esclerosis_Multiple;

        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[0].querySelectorAll('td')[1].textContent = historial_salud.Diabetes == 'Si' ? historial_salud.Diabetes_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[1].querySelectorAll('td')[1].textContent = historial_salud.Cancer == 'Si' ? historial_salud.Cancer_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[2].querySelectorAll('td')[1].textContent = historial_salud.Hipertension == 'Si' ? historial_salud.Hipertension_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[3].querySelectorAll('td')[1].textContent = historial_salud.Disfuncion_Renal == 'Si' ? historial_salud.Disfuncion_Renal_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[4].querySelectorAll('td')[1].textContent = historial_salud.Fibrosis_Quistica == 'Si' ? historial_salud.Fibrosis_Quistica_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[5].querySelectorAll('td')[1].textContent = historial_salud.Miopia == 'Si' ? historial_salud.Miopia_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[6].querySelectorAll('td')[1].textContent = historial_salud.Asma == 'Si' ? historial_salud.Asma_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[7].querySelectorAll('td')[1].textContent = historial_salud.Migranas == 'Si' ? historial_salud.Migranas_Familiar : 'No aplica';
        this.template_historial_salud.querySelectorAll('table')[0].querySelectorAll('tbody tr')[8].querySelectorAll('td')[1].textContent = historial_salud.Esclerosis_Multiple == 'Si' ? historial_salud.Esclerosis_Multiple_Familiar : 'No aplica';

        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[0].querySelectorAll('td')[0].textContent = historial_salud.Fuma == 1 ? 'Sí' : 'No';
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[1].querySelectorAll('td')[0].textContent = historial_salud.Bebe == 1 ? 'Sí' : 'No';
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[2].querySelectorAll('td')[0].textContent = historial_salud.Consume_Droga;
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[3].querySelectorAll('td')[0].textContent = salud_seguros ? 'Sí' : 'No';
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[4].querySelectorAll('td')[0].textContent = historial_salud.Deportes == 1 ? 'Sí' : 'No';

        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[0].querySelectorAll('td')[1].textContent = historial_salud.Fuma_Cuanto;
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[1].querySelectorAll('td')[1].textContent = historial_salud.Bebe_Frecuencia;
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[2].querySelectorAll('td')[1].textContent = historial_salud.Cual_Droga;
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[3].querySelectorAll('td')[1].textContent = salud_seguros ? salud_seguros : 'Ninguno';
        this.template_historial_salud.querySelectorAll('table')[1].querySelectorAll('tbody tr')[4].querySelectorAll('td')[1].textContent = historial_salud.Deportes_Frecuencia;

        const clone_historial_salud = this.template_historial_salud.cloneNode(true);
        this.fragment_historial_salud.appendChild(clone_historial_salud);

        this.content_historial_salud.innerHTML = "";
        this.content_historial_salud.appendChild(this.fragment_historial_salud);

        if (!historial_salud) {
            document.querySelector('#vert-tabs-historial_salud-tab').hidden = true;
            document.querySelector('#vert-tabs-historial_salud').hidden = true;
        }
    }

    cargarUbicacion(ubicacion, vivienda, comentario) {
        this.template_ubicacion.querySelectorAll('p')[0].textContent = vivienda.Tiempo_Viviendo;
        this.template_ubicacion.querySelectorAll('p')[1].textContent = ubicacion.Calle;
        this.template_ubicacion.querySelectorAll('p')[2].textContent = ubicacion.Exterior;
        this.template_ubicacion.querySelectorAll('p')[3].textContent = ubicacion.Interior;
        this.template_ubicacion.querySelectorAll('p')[4].textContent = ubicacion.Colonia;
        this.template_ubicacion.querySelectorAll('p')[5].textContent = ubicacion.Entre_Calles;
        this.template_ubicacion.querySelectorAll('p')[6].textContent = ubicacion.Municipio;
        this.template_ubicacion.querySelectorAll('p')[7].textContent = ubicacion.Estado;
        this.template_ubicacion.querySelectorAll('p')[8].textContent = ubicacion.Codigo_Postal;
        this.template_ubicacion.querySelectorAll('p')[9].textContent = ubicacion.Fachada;
        this.template_ubicacion.querySelectorAll('p')[10].textContent = vivienda.Tipo_Vivienda;
        this.template_ubicacion.querySelectorAll('p')[11].textContent = vivienda.Plantas;
        this.template_ubicacion.querySelectorAll('p')[12].textContent = vivienda.Sanitarios;
        this.template_ubicacion.querySelectorAll('p')[13].textContent = vivienda.Recamaras;
        this.template_ubicacion.querySelectorAll('p')[14].textContent = vivienda.Capacidad_Cochera;
        this.template_ubicacion.querySelectorAll('p')[15].textContent = vivienda.Domicilio_es;
        this.template_ubicacion.querySelectorAll('p')[16].textContent = vivienda.Propietario;
        this.template_ubicacion.querySelectorAll('p')[17].textContent = vivienda.Parentesco;
        this.template_ubicacion.querySelectorAll('p')[18].textContent = vivienda.Telefono_Parentesco;
        this.template_ubicacion.querySelectorAll('p')[19].textContent = vivienda.Contrato_Arrendamiento;
        this.template_ubicacion.querySelectorAll('p')[20].textContent = vivienda.Tiempo_Contrato;

        this.template_ubicacion.querySelectorAll('p')[21].textContent = comentario.Comentario_Vivienda;
        this.template_ubicacion.querySelectorAll('p')[22].textContent = ubicacion.Maps;

        const clone_ubicacion = this.template_ubicacion.cloneNode(true);
        this.fragment_ubicacion.appendChild(clone_ubicacion);

        this.content_ubicacion.innerHTML = '';
        this.content_ubicacion.appendChild(this.fragment_ubicacion);
    }

    cargarUbicacionFotos(ubicacion_exterior, ubicacion_no_exterior, ubicacion_interior, ubicacion, vivienda) {
        this.template_ubicacion_fotos.querySelectorAll('img')[0].src = ubicacion_exterior ? ubicacion_exterior[0] : '../dist/img/image_unavailable.jpg';
        this.template_ubicacion_fotos.querySelectorAll('img')[1].src = ubicacion_no_exterior ? ubicacion_no_exterior[0] : '../dist/img/image_unavailable.jpg';
        this.template_ubicacion_fotos.querySelectorAll('img')[2].src = ubicacion_interior ? ubicacion_interior[0] : '../dist/img/image_unavailable.jpg';

        this.template_ubicacion_fotos.querySelectorAll('.btn-success')[0].dataset.id = ubicacion.Foto;
        this.template_ubicacion_fotos.querySelectorAll('.btn-success')[1].dataset.id = ubicacion.Foto1;
        this.template_ubicacion_fotos.querySelectorAll('.btn-success')[2].dataset.id = vivienda.Foto;

        this.template_ubicacion_fotos.querySelectorAll('.btn-info')[0].dataset.id = ubicacion.Foto;
        this.template_ubicacion_fotos.querySelectorAll('.btn-info')[1].dataset.id = ubicacion.Foto1;
        this.template_ubicacion_fotos.querySelectorAll('.btn-info')[2].dataset.id = vivienda.Foto;

        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[0].dataset.id = ubicacion.Foto;
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[1].dataset.id = ubicacion.Foto1;
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[2].dataset.id = vivienda.Foto;

        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[0].dataset.Folio_Origen = folio;
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[1].dataset.Folio_Origen = 115;
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[2].dataset.Folio_Origen = folio;

        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[0].dataset.Tabla = 'Candidatos_Ubicacion';
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[1].dataset.Tabla = 'Candidatos_Ubicacion';
        this.template_ubicacion_fotos.querySelectorAll('.btn-danger')[2].dataset.Tabla = 'Candidatos_Vivienda';

        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[0].dataset.id = folio;
        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[1].dataset.id = 115;
        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[2].dataset.id = folio;

        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[0].dataset.tabla = 'Candidatos_Ubicacion';
        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[1].dataset.tabla = 'Candidatos_Ubicacion';
        this.template_ubicacion_fotos.querySelectorAll('.btn-orange')[2].dataset.tabla = 'Candidatos_Vivienda';

        this.template_ubicacion_fotos.querySelectorAll('.btn-group')[0].style.display = ubicacion_exterior ? 'block' : 'none';
        this.template_ubicacion_fotos.querySelectorAll('.btn-group')[1].style.display = ubicacion_no_exterior ? 'block' : 'none';
        this.template_ubicacion_fotos.querySelectorAll('.btn-group')[2].style.display = ubicacion_interior ? 'block' : 'none';

        const clone_ubicacion_fotos = this.template_ubicacion_fotos.cloneNode(true);
        this.fragment_ubicacion_fotos.appendChild(clone_ubicacion_fotos);

        this.content_ubicacion_fotos.innerHTML = '';
        this.content_ubicacion_fotos.appendChild(this.fragment_ubicacion_fotos);
    }

    cargarEnseres(data) {
        this.template_enseres.querySelectorAll('tr')[0].querySelectorAll('td')[1].textContent = data.Computadoras;
        this.template_enseres.querySelectorAll('tr')[1].querySelectorAll('td')[1].textContent = data.Pantallas;
        this.template_enseres.querySelectorAll('tr')[2].querySelectorAll('td')[1].textContent = data.Laptop;
        this.template_enseres.querySelectorAll('tr')[3].querySelectorAll('td')[1].textContent = data.Impresoras;
        this.template_enseres.querySelectorAll('tr')[4].querySelectorAll('td')[1].textContent = data.Refrigerador;
        this.template_enseres.querySelectorAll('tr')[5].querySelectorAll('td')[1].textContent = data.Estufa;
        this.template_enseres.querySelectorAll('tr')[6].querySelectorAll('td')[1].textContent = data.Aire_Acondicionado;
        this.template_enseres.querySelectorAll('tr')[7].querySelectorAll('td')[1].textContent = data.Lavadora;
        this.template_enseres.querySelectorAll('tr')[8].querySelectorAll('td')[1].textContent = data.Secadora;
        this.template_enseres.querySelectorAll('tr')[9].querySelectorAll('td')[2].textContent = data.Otros;
        this.template_enseres.querySelectorAll('tr')[10].querySelectorAll('td')[2].textContent = data.Mobiliario == 1 ? 'Sí' : 'No';
        this.template_enseres.querySelectorAll('tr')[11].querySelectorAll('td')[1].textContent = data.Comentarios;

        const clone_enseres = this.template_enseres.cloneNode(true);
        this.fragment_enseres.appendChild(clone_enseres);
        this.content_enseres.innerHTML = "";
        this.content_enseres.appendChild(this.fragment_enseres);

        if (!data) {
            document.querySelector('#vert-tabs-enseres-tab').hidden = true;
            document.querySelector('#vert-tabs-enseres').hidden = true;
        }
    }

    cargarReferencias(data, display) {
        var clones_referencias = new Array();
        data.forEach(element => {
            this.template_referencia.querySelectorAll('p')[0].textContent = element.Tipo == 1 ? 'Personal' : (element.Tipo == 2 ? 'Vecinal' : (element.Tipo == 3 ? 'Familiar' : ''));
            this.template_referencia.querySelectorAll('p')[1].textContent = element.Relacion;
            this.template_referencia.querySelectorAll('p')[2].textContent = element.Nombre;
            this.template_referencia.querySelectorAll('p')[3].textContent = element.Telefono;
            this.template_referencia.querySelectorAll('p')[4].textContent = element.Domicilio;
            this.template_referencia.querySelectorAll('p')[5].textContent = element.Domicilio_Candidato;
            this.template_referencia.querySelectorAll('p')[6].textContent = element.Tiempo_Viviendo;
            this.template_referencia.querySelectorAll('p')[7].textContent = element.Tiempo_Conocerlo;
            this.template_referencia.querySelectorAll('p')[8].textContent = element.Tiene_Hijos;
            this.template_referencia.querySelectorAll('p')[9].textContent = element.Dedicacion;
            this.template_referencia.querySelectorAll('p')[10].textContent = element.Estado_Civil;
            this.template_referencia.querySelectorAll('p')[11].textContent = element.Comentarios;
            this.template_referencia.querySelector('.btn-info').dataset.id = element.Renglon;
            this.template_referencia.querySelector('.btn-danger').dataset.id = element.Renglon;
            this.template_referencia.querySelector('.btn-info').style.display = display.SA;
            this.template_referencia.querySelector('.btn-danger').style.display = display.SA;

            for (let i = 0; i < this.content_referencias.length; i++) {
                clones_referencias[i] = this.template_referencia.cloneNode(true);
                this.fragment_referencia[i].appendChild(clones_referencias[i]);
            }
        });
        for (let i = 0; i < this.content_referencias.length; i++) {
            this.content_referencias[i].innerHTML = "";
            this.content_referencias[i].appendChild(this.fragment_referencia[i]);
        }
    }

    cargarEconomiaFamiliar(ingresos, egresos, display, comentario) {
        let total_ingresos = 0;
        let total_egresos = 0;
        ingresos.forEach(ingreso => {
            this.template_ingreso.querySelectorAll('th')[0].textContent = ingreso.Aporta;
            this.template_ingreso.querySelectorAll('th')[1].textContent = ingreso.Fuente;
            this.template_ingreso.querySelectorAll('td')[0].textContent = `$ ${Math.round(ingreso.Monto)}`;
            this.template_ingreso.querySelector('.btn-info').dataset.id = ingreso.Renglon;
            this.template_ingreso.querySelector('.btn-danger').dataset.id = ingreso.Renglon;
            this.template_ingreso.querySelector('.btn-info').style.display = display.Logistics;
            this.template_ingreso.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_ingreso = this.template_ingreso.cloneNode(true);
            this.fragment_ingreso.appendChild(clone_ingreso);
            total_ingresos += Math.round(ingreso.Monto);
        });
        egresos.forEach(egreso => {
            this.template_egreso.querySelectorAll('th')[0].textContent = egreso.Descripcion;
            this.template_egreso.querySelectorAll('td')[0].textContent = `$ ${Math.round(egreso.Monto)}`;
            this.template_egreso.querySelector('.btn-info').dataset.id = egreso.Egreso;
            this.template_egreso.querySelector('.btn-danger').dataset.id = egreso.Egreso;
            this.template_egreso.querySelector('.btn-info').style.display = display.Logistics;
            this.template_egreso.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_egreso = this.template_egreso.cloneNode(true);
            this.fragment_egreso.appendChild(clone_egreso);
            total_egresos += Math.round(egreso.Monto);
        });
        this.template_totales_economia.querySelectorAll('p')[0].textContent = `$ ${Math.round(total_ingresos)}`;
        this.template_totales_economia.querySelectorAll('p')[1].textContent = `$ ${Math.round(total_egresos)}`;
        this.template_totales_economia.querySelectorAll('p')[2].textContent = `$ ${Math.round(total_ingresos - total_egresos)}`;

        if ((total_ingresos - total_egresos) < 0) {
            this.template_totales_economia.querySelectorAll('p')[2].classList.add('text-danger');
        } else {
            this.template_totales_economia.querySelectorAll('p')[2].classList.remove('text-danger');
        }

        const clone_totales_economia = this.template_totales_economia.cloneNode(true);
        this.fragment_totales_economia.appendChild(clone_totales_economia);

        this.content_ingresos.innerHTML = "";
        this.content_egresos.innerHTML = "";

        this.content_ingresos.appendChild(this.fragment_ingreso);
        this.content_egresos.appendChild(this.fragment_egreso);
        this.content_totales_economia.innerHTML = "";
        this.content_totales_economia.appendChild(this.fragment_totales_economia);

        if (comentario) {
            this.content_totales_economia.parentElement.children[4].textContent = comentario
        }
    }

    cargarInformacionFinanciera(creditos, cuentas_bancarias, seguros, INFONAVIT, display) {
        creditos.forEach(credito => {
            this.template_credito.querySelectorAll('th')[0].textContent = credito.Institucion;
            this.template_credito.querySelectorAll('td')[0].textContent = credito.Limite_Credito;
            this.template_credito.querySelectorAll('td')[1].textContent = credito.Saldo_Actual;
            this.template_credito.querySelectorAll('td')[2].textContent = credito.Vencimiento;
            this.template_credito.querySelectorAll('td')[3].textContent = credito.Abono_Mensual;
            this.template_credito.querySelector('.btn-info').dataset.id = credito.Renglon;
            this.template_credito.querySelector('.btn-danger').dataset.id = credito.Renglon;
            this.template_credito.querySelector('.btn-info').style.display = display.Logistics;
            this.template_credito.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_credito = this.template_credito.cloneNode(true);
            this.fragment_credito.appendChild(clone_credito);
        });

        cuentas_bancarias.forEach(cuenta => {
            this.template_cuenta_bancaria.querySelectorAll('th')[0].textContent = cuenta.Institucion;
            this.template_cuenta_bancaria.querySelectorAll('td')[0].textContent = cuenta.Tipo_Cuenta;
            this.template_cuenta_bancaria.querySelectorAll('td')[1].textContent = cuenta.Objetivo;
            this.template_cuenta_bancaria.querySelectorAll('td')[2].textContent = cuenta.Deposito_Mensual;
            this.template_cuenta_bancaria.querySelector('.btn-info').dataset.id = cuenta.Renglon;
            this.template_cuenta_bancaria.querySelector('.btn-danger').dataset.id = cuenta.Renglon;
            this.template_cuenta_bancaria.querySelector('.btn-info').style.display = display.Logistics;
            this.template_cuenta_bancaria.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_cuenta_bancaria = this.template_cuenta_bancaria.cloneNode(true);
            this.fragment_cuenta_bancaria.appendChild(clone_cuenta_bancaria);
        });

        seguros.forEach(seguro => {
            this.template_seguro.querySelectorAll('th')[0].textContent = seguro.Institucion;
            this.template_seguro.querySelectorAll('td')[0].textContent = seguro.Tipo_Seguro;
            this.template_seguro.querySelectorAll('td')[1].textContent = seguro.Forma_Pago;
            this.template_seguro.querySelectorAll('td')[2].textContent = seguro.Prima;
            this.template_seguro.querySelectorAll('td')[3].textContent = seguro.Vigencia;
            this.template_seguro.querySelector('.btn-info').dataset.id = seguro.Renglon;
            this.template_seguro.querySelector('.btn-danger').dataset.id = seguro.Renglon;
            this.template_seguro.querySelector('.btn-info').style.display = display.Logistics;
            this.template_seguro.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_seguro = this.template_seguro.cloneNode(true);
            this.fragment_seguro.appendChild(clone_seguro);
        });
        this.content_creditos.innerHTML = "";
        this.content_cuentas_bancarias.innerHTML = "";
        this.content_seguros.innerHTML = "";
        this.content_creditos.appendChild(this.fragment_credito);
        this.content_cuentas_bancarias.appendChild(this.fragment_cuenta_bancaria);
        this.content_seguros.appendChild(this.fragment_seguro);

        if (INFONAVIT) {
            this.content_creditos.parentElement.parentElement.parentElement.parentElement.children[2].textContent = INFONAVIT == 1 ? 'Sí' : (INFONAVIT == 2 ? 'No' : '');
        }
    }

    cargarInformacionPatrimonial(inmuebles, vehiculos, display) {
        inmuebles.forEach(inmueble => {
            this.template_inmueble.querySelectorAll('th')[0].textContent = inmueble.Tipo_Inmueble;
            this.template_inmueble.querySelectorAll('td')[0].textContent = inmueble.Ubicacion;
            this.template_inmueble.querySelectorAll('td')[1].textContent = inmueble.Valor;
            this.template_inmueble.querySelectorAll('td')[2].textContent = inmueble.Pagado == 1 ? 'Sí' : 'No';
            this.template_inmueble.querySelectorAll('td')[3].textContent = inmueble.Abono_Mensual;
            this.template_inmueble.querySelector('.btn-info').dataset.id = inmueble.Renglon;
            this.template_inmueble.querySelector('.btn-danger').dataset.id = inmueble.Renglon;
            this.template_inmueble.querySelector('.btn-info').style.display = display.Logistics;
            this.template_inmueble.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_inmueble = this.template_inmueble.cloneNode(true);
            this.fragment_inmueble.appendChild(clone_inmueble);
        });
        vehiculos.forEach(vehiculo => {
            this.template_vehiculo.querySelectorAll('td')[0].textContent = vehiculo.Marca;
            this.template_vehiculo.querySelectorAll('td')[1].textContent = vehiculo.Modelo;
            this.template_vehiculo.querySelectorAll('td')[2].textContent = vehiculo.Valor;
            this.template_vehiculo.querySelectorAll('td')[3].textContent = vehiculo.Pagado == 1 ? 'Sí' : 'No';
            this.template_vehiculo.querySelectorAll('td')[4].textContent = vehiculo.Abono_Mensual;
            this.template_vehiculo.querySelector('.btn-info').dataset.id = vehiculo.Renglon;
            this.template_vehiculo.querySelector('.btn-danger').dataset.id = vehiculo.Renglon;
            this.template_vehiculo.querySelector('.btn-info').style.display = display.Logistics;
            this.template_vehiculo.querySelector('.btn-danger').style.display = display.Logistics;

            const clone_vehiculo = this.template_vehiculo.cloneNode(true);
            this.fragment_vehiculo.appendChild(clone_vehiculo);
        });
        this.content_inmuebles.innerHTML = "";
        this.content_vehiculos.innerHTML = "";

        this.content_inmuebles.appendChild(this.fragment_inmueble);
        this.content_vehiculos.appendChild(this.fragment_vehiculo);
    }

    cargarConclusiones(observaciones) {
        this.template_conclusiones.querySelectorAll('p')[0].textContent = observaciones.Sobre_Candidato;
        this.template_conclusiones.querySelectorAll('p')[1].textContent = observaciones.Sobre_Casa;
        this.template_conclusiones.querySelectorAll('p')[2].textContent = observaciones.Conclusiones_Entrevistador;
        if (observaciones.Participacion_Candidato == 243 || observaciones.Participacion_Candidato == 242) {
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Participacion_Candidato == 241) {
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Participacion_Candidato == 240) {
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[1].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        if (observaciones.Entorno_Familiar == 243 || observaciones.Entorno_Familiar == 242) {
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Entorno_Familiar == 241) {
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Entorno_Familiar == 240) {
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[2].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        if (observaciones.Referencias_Vecinales == 243 || observaciones.Referencias_Vecinales == 242) {
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = "<i class='fas fa-circle text-success'></i>";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Referencias_Vecinales == 241) {
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "<i class='fas fa-circle text-warning'></i>";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = "";
        } else if (observaciones.Referencias_Vecinales == 240) {
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[0].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[1].innerHTML = "";
            this.template_conclusiones.querySelectorAll('tr')[3].querySelectorAll('td')[2].innerHTML = "<i class='fas fa-circle text-danger'></i>";
        }

        const clone_conclusiones = this.template_conclusiones.cloneNode(true);
        this.fragment_conclusiones.appendChild(clone_conclusiones);

        this.content_conclusiones.innerHTML = "";
        this.content_conclusiones.appendChild(this.fragment_conclusiones);
    }

    cargarComentariosGenerales(observaciones) {
        this.template_comentarios_generales.querySelectorAll('p')[0].innerText = observaciones.Comentarios_Generales;
        //this.template_comentarios_generales.querySelectorAll('p')[1].innerText = observaciones.Califica_como;
        // this.template_comentarios_generales.querySelectorAll('p')[1].innerText = observaciones.Viabilidad == '0' ? 'Viable para su contratación' : (observaciones.Viabilidad == 1 ? 'No viable para su contratación' : (observaciones.Viabilidad == 2 ? 'Viable con reservas' :
        //  (observaciones.Viabilidad == 4 ? 'Sin viabilidad' : (observaciones.Viabilidad == 5 ? 'Viable con observaciones' : ''))));
        this.template_comentarios_generales.querySelectorAll('p')[1].innerText = observaciones.Viabilidad;

        const clone_comentarios_generales = this.template_comentarios_generales.cloneNode(true);
        this.fragment_comentarios_generales.appendChild(clone_comentarios_generales);
        this.content_comentarios_generales.innerHTML = "";
        this.content_comentarios_generales.appendChild(this.fragment_comentarios_generales);
    }

    cargarNotas(data, display) {
        data.forEach(element => {
            this.template_notas.querySelectorAll('.username')[0].textContent = element.first_name + ' ' + element.last_name;
            this.template_notas.querySelectorAll('.description')[0].textContent = element.Fecha;
            this.template_notas.querySelectorAll('p')[0].innerText = element.Nota;
            this.template_notas.querySelector('img').src = element.avatar;
            this.template_notas.querySelector('.btn-info').dataset.id = element.Id;
            this.template_notas.querySelector('.btn-danger').dataset.id = element.Id;

            const clone_notas = this.template_notas.cloneNode(true);
            this.fragment_notas.appendChild(clone_notas);
        });

        this.content_notas.innerHTML = '';
        this.content_notas.appendChild(this.fragment_notas);
        this.content_notas.parentElement.style.display = display.SA;
    }
}
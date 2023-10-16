class Administracion {

	constructor() {
		this.id = null;

	}

	bill_manage() {
		var form = document.querySelector("#bill-manage-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/bill_follow_up');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#bill-manage-form #submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Gestión creada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#bill-manage-form #submit").disabled = false;
				} else {
					document.querySelector("#bill-manage-form #submit").disabled = false;
				}
			}
		}
	}

	editar_factura() {
		var form = document.querySelector("#bill-edit-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/update_bill');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#bill-edit-form #submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Factura actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = './cobranza';
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#bill-edit-form #submit").disabled = false;
				} else {
					document.querySelector("#bill-edit-form #submit").disabled = false;
				}
			}
		}
	}

	gestionar_factura() {
		var form = document.querySelector("#bill-edit-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/bill_follow_up');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#bill-edit-form #submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Factura gestionada exitosamente', 'success');
						setTimeout(() => {
							window.location.href = './cobranza';
						}, 3000);

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#bill-edit-form #submit").disabled = false;
					} else {
						document.querySelector("#bill-edit-form #submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#bill-edit-form #submit").disabled = false;
				}

			}
		}
	}

	gestionar_orden() {
		var form = document.querySelector("#po-manage-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/purchase_order_follow_up');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#po-manage-form #submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Gestión de orden de compra actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#po-manage-form #submit").disabled = false;
				} else {
					document.querySelector("#po-manage-form #submit").disabled = false;
				}
			}
		}
	}

	getServicio(folio) {
		this.folio = folio;
		let xhr = new XMLHttpRequest();
		let data = `folio=${this.folio}`;
		let form = document.querySelector('#modal_edit form');
		xhr.open('POST', '../Administracion_SA/getServicio');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r != 0) {
					let json_app = JSON.parse(this.responseText);
					console.log(json_app);

					let razones = '';
					json_app.razones.forEach(razon => {
						razones +=
							`
						<option value="${razon.Razon.trim()}">${razon.Razon}</option>
						`;
					});
					razones += '<option value="Pendiente">Pendiente</option>';

					form.querySelectorAll('select')[0].innerHTML = razones;


					document.querySelector("#update-form").reset();
					document.querySelector(".modal-title").textContent = json_app.candidato_datos.Nombre_Candidato;
					document.querySelector("#Cliente").value = json_app.candidato_datos.Cliente;
					form.querySelectorAll('input')[0].value = json_app.candidato_datos.Folio;
					form.querySelectorAll('input')[1].value = json_app.candidato_datos.ID_Cliente;
					form.querySelector('#Fase').value = json_app.candidato_datos.Servicio;
					document.querySelector("#Comentario_Cliente").value = json_app.candidato_datos.Comentario_Cliente;
					document.querySelector("#Comentario_Cancelado").value = json_app.candidato_datos.Comentario_Cancelado;
					document.querySelector("#Factura").value = json_app.candidato_datos.Factura;
					form.querySelectorAll('select')[0].value = json_app.candidato_datos.Razon;
					$('#modal_edit').modal('show');
				}
			}
		}
	}

	update_folio() {
		var form = document.querySelector("#modal_edit form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/update_folio');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id = form.querySelectorAll('input')[0].value;
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
					} else {
						document.getElementById("folio" + xhr.id).textContent = json_app.factura;
						document.getElementById('razon' + xhr.id).textContent = json_app.razon;
						$('#modal_edit').modal('hide');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}

			}
		}
	}

	update_folio_new(Candidato, Cliente, ID_Cliente, Razon_Social, Factura) {
		let data = `Candidato=${Candidato}&Cliente=${Cliente}&ID_Cliente=${ID_Cliente}&Razon_Social=${Razon_Social}&Factura=${Factura}`;

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/update_folio');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('No se guardó', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}

			}
		}
	}

	getFactura(folio) {
		let xhr = new XMLHttpRequest();
		let data = `Folio_Factura=${folio}`;
		xhr.open('POST', '../Administracion_SA/getFactura');
		let form = document.querySelector('#modal_factura form');
		form.querySelectorAll('.btn')[1].disabled = false;
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
		xhr.clase = this;
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					if (r != 0) {
						let json_app = JSON.parse(r);

						let razones = '';
						json_app.razones.forEach(razon => {
							razones +=
								`
		<option value="${razon.Razon.trim()}" ${json_app.factura_datos.Razon_Social==razon.Razon?'selected':''}>${razon.Razon}</option>
                            `;
						});
						razones += '<option value="Pendiente">Pendiente</option>';

						let $Fecha = `${json_app.factura_datos.Fecha_Emision} ${json_app.factura_datos.Hora_Emision}`;
						let Hora_Emision = new Date($Fecha);
						console.log(Hora_Emision);

						form.querySelectorAll('select')[0].innerHTML = razones;
						form.querySelectorAll('input')[0].value = folio;
						form.querySelectorAll('input')[1].value = folio;
						form.querySelectorAll('input')[2].value = json_app.factura_datos.Fecha_Emision;
						form.querySelectorAll('input')[3].value = `${("0"+(Hora_Emision.getHours())).slice(-2)}:${("0" + Hora_Emision.getMinutes()).slice(-2)}:${("0" + Hora_Emision.getSeconds()).slice(-2)}`;
						form.querySelectorAll('input')[4].value = json_app.factura_datos.Cliente;
						//form.querySelectorAll('select')[0].value = json_app.factura_datos.Razon_Social.trim();
						form.querySelectorAll('select')[1].value = json_app.factura_datos.Estado;
						form.querySelectorAll('input')[5].value = json_app.factura_datos.Promesa_Pago;
						form.querySelectorAll('input')[6].value = Math.round(json_app.factura_datos.Monto);
						if (Math.round(Number.parseFloat(json_app.factura_datos.Monto_IVA), 2) == Math.round(Number.parseFloat(json_app.factura_datos.Monto * 1.1), 2)) {
							form.querySelectorAll('input[type=radio]')[0].checked = true;
						} else {
							form.querySelectorAll('input[type=radio]')[1].checked = true;
						}if (json_app.factura_datos.Tipo == null || json_app.factura_datos.Tipo == 0) {
							form.querySelectorAll('input[type=radio]')[3].checked = true;
						} else {
							form.querySelectorAll('input[type=radio]')[2].checked = true;
						}
						form.querySelectorAll('input')[7].value = json_app.factura_datos.Fecha_de_Pago;

					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}

			}
		}
	}
	
	static tabla_formato(facturas, tabla) {

		let statusclass;
		let class_color_days;

		let factu = '';
		facturas.forEach(Factura => {

			if (tabla == 'tb_unpaid_bills') {
				(parseInt(Factura.Dias_Transcurridos) > parseInt(Factura.Plazo_Credito)) ? class_color_days = ' bg-danger' : class_color_days = '';
			}
			(Factura.Estado == 'Pagada') ? statusclass = 'bg-success' : (Factura.Estado == 'Pendiente de pago') ? statusclass = 'bg-orange' : (Factura.Estado == 'Cancelada') ? statusclass = 'bg-danger' : statusclass = '';

			factu += `
				<tr id='factura${Factura.Folio_Factura}'>
					<td class="text-center align-middle"><b>${Factura.Folio_Factura}</b></td>
					<td class="text-center align-middle">${Factura.Fecha_Emision}</td>
					<td class="text-center align-middle">${Factura.Plazo_Credito}</td>
					<td class="text-center align-middle ${class_color_days}">${Factura.Dias_Transcurridos}</td>
					<td class="text-center align-middle">${Factura.Nombre_Empresa}</td>
					<td class="text-center align-middle">${Factura.Cliente}</td>
					<td class="text-center align-middle">${Factura.Razon_Social}</td>
					<td class="text-center align-middle">$ ${Factura.Monto}</td>
					<td class="text-center align-middle">$ ${Factura.Monto_IVA}</td>
					<td class="text-center align-middle">${Factura.Fecha_de_Pago}</td>
					<td class="text-center align-middle ${statusclass}">${Factura.Estado}</td>`;

			if (tabla == 'tb_paid_bills_canhcel') {

				factu += `<td class="text-center align-middle">${Factura.fecha_cancelacion}</td>
					<td class="text-center align-middle">${Factura.comentarios}</td>`;
			} else {
				factu += `<td class="text-center align-middle">${Factura.Fecha_Ultima_Gestion}</td>
				<td class="text-center align-middle">${Factura.Proxima_Gestion}</td>
				<td class="text-center align-middle">${Factura.Promesa_Pago}</td>
				<td class="text-center align-middle">${Factura.Ultima_Gestion}</td>`;
			}

			factu += `<td class="text-center py-0 align-middle">
			           <div class="btn-group btn-group-sm">`;
			if (tabla == 'tb_paid_bills_canhcel') {
				factu += ` <a href="editar_factura&folio=${Factura.Folio_Factura_Encrypytado}" class="btn btn-success btn-sm mr-1"> <i class="fas fa-eye"></i> </a>
				          <button class="btn btn-info btn-sm mr-1" data-id="${Factura.Folio_Factura_Encrypytado}"><i class="fas fa-pencil-alt"></i></button>`;
			} else {
				factu += `<a href="editar_factura&folio=${Factura.Folio_Factura_Encrypytado}" class="btn btn-success btn-sm mr-1"><i class="fas fa-eye"></i></a>
	                  <button class="btn btn-info btn-sm mr-1" data-id="${Factura.Folio_Factura}"><i class="fas fa-pencil-alt"></i> </button>
	                 <button class="btn btn-secondary btn-sm mr-1" data-id="${Factura.Folio_Factura}"> <i class="fas fa-cog"></i></button>`;
			}
			factu += `</div>
			           </td>
				</tr>
			`;
		});

		return factu;

	}

	update_factura() {
		var form = document.querySelector("#modal_factura form");
		var formData = new FormData(form);
		let factura = form.querySelectorAll('input')[0].value;
		form.querySelectorAll('.btn')[1].disabled = true;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/update_bill');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;
					} else if (json_app.status == 1) {
						
						utils.destruir_datatable('#tb_unpaid_bills', '#tb_unpaid_bills tbody', Administracion.tabla_formato(json_app.facturas_pendientes, 'tb_unpaid_bills'));
                                                utils.destruir_datatable('#tb_paid_bills', '#tb_paid_bills tbody', Administracion.tabla_formato(json_app.facturas_pagadas, 'tb_paid_bills'));
                                                utils.destruir_datatable('#tb_paid_bills_canhcel', '#tb_paid_bills_canhcel tbody', Administracion.tabla_formato(json_app.facturas_canceladas, 'tb_paid_bills_canhcel'));
						utils.destruir_datatable('#tb_paid_bills_incobrables', '#tb_paid_bills_incobrables tbody', Administracion.tabla_formato(json_app.facturas_incobrables, 'facturas_incobrables'));

						utils.showToast('Factura actualizada exitosamente', 'success');

						$('#modal_factura').modal('hide');
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;
					} else {
						form.querySelectorAll('.btn')[1].disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					form.querySelectorAll('.btn')[1].disabled = false;
				}

			}
		}
	}

	getFacturaGestion(folio) {
		let xhr = new XMLHttpRequest();
		let data = `Folio_Factura=${folio}`;
		xhr.open('POST', '../Administracion_SA/getFactura');
		let form = document.querySelector('#modal_factura_gestion form');
		form.reset();
		form.querySelectorAll('.btn')[1].disabled = false;
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
		xhr.clase = this;
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					if (r != 0) {
						let json_app = JSON.parse(r);

						let razones = '';
						json_app.razones.forEach(razon => {
							razones +=
								`
                            <option value="${razon.Razon.trim()}">${razon.Razon}</option>
                            `;
						});
						razones += '<option value="Pendiente">Pendiente</option>';

						let $Fecha = `${json_app.factura_datos.Fecha_Emision} ${json_app.factura_datos.Hora_Emision}`;
						let Hora_Emision = new Date($Fecha);

						form.querySelectorAll('select')[0].innerHTML = razones;
						form.querySelectorAll('input')[0].value = folio;
						form.querySelectorAll('input')[1].value = folio;
						form.querySelectorAll('input')[2].value = json_app.factura_datos.Fecha_Emision;
						form.querySelectorAll('input')[3].value = json_app.factura_datos.Cliente;
						form.querySelectorAll('select')[0].value = json_app.factura_datos.Razon_Social.trim();
						form.querySelectorAll('select')[1].value = json_app.factura_datos.Estado;
						form.querySelectorAll('input')[4].value = json_app.factura_datos.Promesa_Pago;
						form.querySelectorAll('input')[6].value = json_app.factura_datos.Proxima_Gestion;

					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				}

			}
		}
	}

	update_factura_gestion() {
		var form = document.querySelector("#modal_factura_gestion form");
		var formData = new FormData(form);
		let factura = form.querySelectorAll('input')[0].value;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/bill_follow_up');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						form.querySelectorAll(".btn")[1].disabled = false;
					} else if (json_app.status == 1) {
						
						   utils.destruir_datatable('#tb_unpaid_bills', '#tb_unpaid_bills tbody', Administracion.tabla_formato(json_app.facturas_pendientes, 'tb_unpaid_bills'));
                                               
                                        utils.destruir_datatable('#tb_paid_bills', '#tb_paid_bills tbody', Administracion.tabla_formato(json_app.facturas_pagadas, 'tb_paid_bills'));
                                                      
                                        utils.destruir_datatable('#tb_paid_bills_canhcel', '#tb_paid_bills_canhcel tbody', Administracion.tabla_formato(json_app.facturas_canceladas, 'tb_paid_bills_canhcel'));

						utils.showToast('Factura gestionada exitosamente', 'success');
						$('#modal_factura_gestion').modal('hide');
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll(".btn")[1].disabled = false;
					} else {
						form.querySelectorAll(".btn")[1].disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					form.querySelectorAll(".btn")[1].disabled = false;
				}

			}
		}
	}
	//============================[Ulises Febrero 17]=========================================

	
	getFacturasRazonPorCliente(ID_Cliente, modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/getFacturasRazonPorCliente');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					} else if (json_app.status == 1) {

						let razones = '<option disabled value="" selected>Selecciona razon</option>';
						json_app.razones.forEach(element => {
							razones +=
								`			
                            <option value="${element.Razon}">${element.Razon}</option>`
						});
						razones += '<option value="Pendiente" selected>Pendiente</option>';

						let facturas = ''
						json_app.facturas.forEach(element => {
							facturas +=
								`			
                            <option value="${element.Folio_Factura}">${element.Folio_Factura} Monto + iva: $${element.Monto_IVA}</option>`
						});

						$(modal + " form [name='facturas[]']").val(null).trigger('change');
						form.querySelector('[name="Razon_Social"]').innerHTML = razones
						form.querySelector('[name="Estado"]').value = 'Pendiente de pago'
						if (modal == '#modal_afectar_facturas') {
							document.querySelector(modal + ' form [name="Fecha_de_Pago"]').value = ''
							document.querySelector(modal + ' form [name="monto"]').value = 0
						}
						form.querySelector('[name="facturas[]"]').innerHTML = facturas
					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
				}
			}
		}
	}

	updateEstadoFacturas() {
		var form = document.querySelector("#modal_afectar_facturas form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/updateEstadoFacturas');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;

						$('#modal_indicators').modal('hide');
					} else if (json_app.status == 1) {
						utils.showToast('Facturas actualizadas con exito', 'success');
						form.querySelectorAll('.btn')[1].disabled = false;

						$("#modal_afectar_facturas [name='Empresa']").val(null).trigger('change');
						$("#modal_afectar_facturas [name='facturas[]']").val(null).trigger('change');

						form.querySelector('[name="Estado"]').value = 'Pendiente de pago'

						form.querySelector('[name="ID_Cliente"]').innerHTML = ''
						form.querySelector('[name="Razon_Social"]').innerHTML = ''
						form.reset()

						let facturas_pendientes = ''
						json_app.facturas_pendientes.forEach(element => {
							facturas_pendientes += `
						<tr id="factura${element.Folio_Factura}">
							<td class="text-center align-middle"><b>${element.Folio_Factura}</b></td>
							<td class="text-center align-middle">${element.Fecha_Emision}</td>
							<td class="text-center align-middle">${element.Plazo_Credito}</td>
							<td class="text-center align-middle${element.class_color_days}">${element.Dias_Transcurridos}</td>
							<td class="text-center align-middle">${element.Nombre_Empresa}</td>
							<td class="text-center align-middle">${element.Cliente}</td>
							<td class="align-middle">${element.Razon_Social}</td>
							<td class="text-right align-middle">$ ${element.Monto}</td>
							<td class="text-right align-middle">$ ${element.Monto_IVA}</td>
							<td class="text-center align-middle">${element.Fecha_de_Pago}</td>
							<td class="text-center align-middle ${element.class_color}">${element.Estado}</td>
							<td class="text-center align-middle">${element.Fecha_Ultima_Gestion}</td>
							<td class="text-center align-middle">${element.Proxima_Gestion}</td>
							<td class="text-center align-middle">${element.Promesa_Pago}</td>
							<td>${element.Ultima_Gestion}</td>
							<td class="text-center py-0 align-middle">
								<div class="btn-group btn-group-sm">
									<a href="${element.url_editar}" class="btn btn-success btn-sm mr-1">
										<i class="fas fa-eye"></i>
									</a>
									<button class="btn btn-info btn-sm mr-1" data-id="${element.Folio_Factura}">
										<i class="fas fa-pencil-alt"></i>
									</button>
									<button class="btn btn-secondary btn-sm mr-1" data-id="${element.Folio_Factura}">
										<i class="fas fa-cog"></i>
									</button>
								</div>
							</td>
						</tr>
                        `
						});
						document.querySelector('#tb_unpaid_bills tbody').innerHTML = facturas_pendientes
					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
					form.querySelectorAll('.btn')[1].disabled = false;

				}
			}
		}
	}


	updateProximaGestionFacturas() {
		var form = document.querySelector("#modal_afectar_factura_gestion form");
		var formData = new FormData(form);
		form.querySelectorAll('.btn')[1].disabled = true

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/updateProximaGestionFacturas');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;

						$('#modal_indicators').modal('hide');
					} else if (json_app.status == 1) {
						utils.showToast('Proximas gestiones actualizadas con exito', 'success');
						form.querySelectorAll('.btn')[1].disabled = false;

						$("#modal_afectar_factura_gestion [name='facturas[]']").val(null).trigger('change');
						form.querySelector('[name="ID_Cliente"]').value = ''
						form.querySelector('[name="Razon_Social"]').innerHTML = '<option disabled value="" selected>Selecciona razon</option>'
						form.reset()

						let facturas_pendientes = ''
						json_app.facturas_pendientes.forEach(element => {
							facturas_pendientes += `
						<tr id="factura${element.Folio_Factura}">
							<td class="text-center align-middle"><b>${element.Folio_Factura}</b></td>
							<td class="text-center align-middle">${element.Fecha_Emision}</td>
							<td class="text-center align-middle">${element.Plazo_Credito}</td>
							<td class="text-center align-middle${element.class_color_days}">${element.Dias_Transcurridos}</td>
							<td class="text-center align-middle">${element.Nombre_Empresa}</td>
							<td class="text-center align-middle">${element.Cliente}</td>
							<td class="align-middle">${element.Razon_Social}</td>
							<td class="text-right align-middle">$ ${element.Monto}</td>
							<td class="text-right align-middle">$ ${element.Monto_IVA}</td>
							<td class="text-center align-middle">${element.Fecha_de_Pago}</td>
							<td class="text-center align-middle ${element.class_color}">${element.Estado}</td>
							<td class="text-center align-middle">${element.Fecha_Ultima_Gestion}</td>
							<td class="text-center align-middle">${element.Proxima_Gestion}</td>
							<td class="text-center align-middle">${element.Promesa_Pago}</td>
							<td>${element.Ultima_Gestion}</td>
							<td class="text-center py-0 align-middle">
								<div class="btn-group btn-group-sm">
									<a href="${element.url_editar}" class="btn btn-success btn-sm mr-1">
										<i class="fas fa-eye"></i>
									</a>
									<button class="btn btn-info btn-sm mr-1" data-id="${element.Folio_Factura}">
										<i class="fas fa-pencil-alt"></i>
									</button>
									<button class="btn btn-secondary btn-sm mr-1" data-id="${element.Folio_Factura}">
										<i class="fas fa-cog"></i>
									</button>
								</div>
							</td>
						</tr>
                        `
						});
						document.querySelector('#tb_unpaid_bills tbody').innerHTML = facturas_pendientes
					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						form.querySelectorAll('.btn')[1].disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
					form.querySelectorAll('.btn')[1].disabled = false;

				}
			}
		}
	}
	//=========================================================================================


	//============================[Ulises Marzo 07]============================================
	getFacturasEmpresa(modal, flag) {
		var form = document.querySelector(modal + " form");
		let xhr = new XMLHttpRequest();

		xhr.open('POST', '../administracion_SA/getTotalEmpresaConPorPrefacturar');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('flag=' + flag);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					} else if (json_app.status == 1) {
						let factura_empresa = ''
						factura_empresa += '<option disabled value="" selected>Selecciona cliente</option>';

						json_app.factura_empresa.forEach(element => {
							factura_empresa +=
								`			
						<option value="${element.Empresa}" >${element.Nombre_Empresa}</option>`;
						});

						form.querySelector('[name="Empresa"]').innerHTML = factura_empresa

					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
				}
			}
		}
	}

	getClientePorEmpresa(Empresa, modal, flag) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();

		xhr.open('POST', '../administracion_SA/getTotalClienteByEmpresaConPorPrefacturar');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					} else if (json_app.status == 1) {

						let clientes = ''
						clientes += '<option disabled value="" selected>Selecciona Cliente</option>';
						json_app.clientes.forEach(element => {
							clientes +=
								`			
						<option value="${element.Cliente}">${element.Nombre_Cliente}</option>`
						});

						form.querySelector('[name="ID_Cliente"]').innerHTML = clientes

					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
				}
			}
		}
	}


	getRazonPorCliente(ID_Cliente, modal) {
		var form = document.querySelector(modal + " form");
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/getFacturasRazonPorCliente');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('ID_Cliente=' + ID_Cliente);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					} else if (json_app.status == 1) {

						let razones = ''
						razones += '<option disabled value="" selected>Selecciona razon</option>';
						json_app.razones.forEach(element => {
							razones +=
								`			
							<option value="${element.Razon}">${element.Razon}</option>`
						});

						razones += '<option value="Pendiente" selected>Pendiente</option>';
						form.querySelector('[name="Razon_Social"]').innerHTML = razones

					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
				}
			}
		}
	}


	getPrefacturaPorCliente(ID_Cliente, modal) {
		var form = document.querySelector(modal + " form");
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/getPrefacturaPorCliente');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('ID_Cliente=' + ID_Cliente);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					} else if (json_app.status == 1) {
						let preFactura = ''
						preFactura += '<option disabled value="" selected>Selecciona prefactura</option>';
						json_app.preFactura.forEach(element => {
							preFactura +=
								`			
							<option value="${element.Factura}">${element.Factura} (${element.Numero_prefacturas})</option>`
						});
						form.querySelector('[name="Prefactura"]').innerHTML = preFactura
					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
				}
			}
		}
	}

	updatePrefolioAFolio(modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);
		form.querySelector('[name="submit"]').disabled = true

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/updatePrefolioAFolio');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
						form.querySelector('[name="submit"]').disabled = false
					} else if (json_app.status == 1) {
						utils.showToast('Facturadas con exito :D', 'success');
						form.querySelector('[name="ID_Cliente"]').innerHTML = ''
						form.querySelector('[name="Razon_Social"]').innerHTML = ''
						form.querySelector('[name="Prefactura"]').innerHTML = ''
						form.querySelector('[name="Factura"]').innerHTML = ''
						form.reset()
						form.querySelector('[name="submit"]').disabled = false
					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
						form.querySelector('[name="submit"]').disabled = false
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
					form.querySelector('[name="submit"]').disabled = false
				}
			}
		}
	}


	getCandidatosSinPrefacturaPorCliente(Cliente, modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/getCandidatosSinPrefacturaPorCliente');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send('Cliente=' + Cliente);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					} else if (json_app.status == 1) {
						let candidatos = ''
						json_app.candidatos.forEach(element => {
							candidatos +=
								`			
                            <option value="${element.Folio}">${element.Nombre_Candidato} > ${element.Fase}</option>`
						});

						form.querySelector('[name="Candidatos[]"]').innerHTML = candidatos
					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
				}
			}
		}
	}



	updateSinFolioAPrefolio(modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);
		form.querySelector('[name="submit"]').disabled = true
		
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/updateSinFolioAPrefolio');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
						form.querySelector('[name="submit"]').disabled = false
					} else if (json_app.status == 1) {
						$(modal + ' form [name="Empresa"]').val(null).trigger('change');
						form.querySelector('[name="ID_Cliente"]').innerHTML = ''
						form.querySelector('[name="Razon_Social"]').innerHTML = ''
						$(modal + " form [name='Candidatos[]']").empty();
						form.querySelector('[name="Prefactura"]').innerHTML = ''
						form.reset()
						form.querySelector('[name="submit"]').disabled = false

						utils.showToast('Facturadas con exito :D', 'success');
					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas :(', 'error');
						form.querySelector('[name="submit"]').disabled = false
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
					form.querySelector('[name="submit"]').disabled = false
				}
			}
		}
	}


	//====================================[Ulises 21 Marzo]======================================================
	getFacturaPendienteEmpresaPorEstatus(modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/getFacturaPendienteEmpresaPorEstatus');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						$('#modal_indicators').modal('hide');
					} else if (json_app.status == 1) {

						let facturas = ''
						json_app.facturas_totales_Empresa.forEach(element => {
							facturas +=
								`			
                            <option value="${element.Folio_Factura}">${element.Folio_Factura} Monto + iva: $${element.Monto_IVA}</option>`
						});


						let razones = '<option disabled value="" selected>Selecciona razon</option>';
						json_app.razonSocialEmpresa.forEach(razon => {
							razones += `<option value="${razon.Razon.trim()}">${razon.Razon}</option>`;
						});
						razones += '<option value="Pendiente">Pendiente</option>';

						form.querySelector('[name="facturas[]"]').innerHTML = facturas
						form.querySelector('[name="Razon_Social"]').innerHTML = razones

					} else {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
				}
			}
		}
	}
	
		//============================[Ulises Marzo 31 Vetar cliente]===============================
	updateVetarcliente(modal) {
		var form = document.querySelector(modal + " form");
		var formData = new FormData(form);
		form.querySelector('[name="submit"]').disabled = true

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion_SA/updateVetarcliente');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Hablale a sistemas', 'error');
						form.querySelector('[name="submit"]').disabled = false
					} else if (json_app.status == 1) {
						utils.showToast('Accion con exito.', 'success');
						form.querySelector('[name="submit"]').disabled = false
					} else {
						utils.showToast('Algo salió mal. Hablale a sistemas ', 'error');
						form.querySelector('[name="submit"]').disabled = false
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Hablale a sistemas :(' + error, 'error');
					form.querySelector('[name="submit"]').disabled = false
				}
			}
		}
	}
	//==============================================================================================
getInfoCancel(factura) {

		const data = new FormData();
		data.append('factura', factura);

		fetch('../administracion_SA/getInfoCancel', {
			method: 'POST',
			body: data
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
				console.log(r);
				try {
					const json_app = JSON.parse(r);
					if (json_app.status == 1) {
						console.log(json_app)
						document.querySelector('#modal_info_cancelados [name="factura"]').value = json_app.factura.Folio_Factura_encryptado
						document.querySelector('#modal_info_cancelados [name="fecha_cancelacion"]').value = json_app.factura.fecha_cancelacion
						document.querySelector('#modal_info_cancelados [name="comentarios"]').innerHTML = json_app.factura.comentarios;
						document.querySelector('#titulo').innerHTML = json_app.factura.Folio_Factura;

					} else if (json_app.status == 0) {
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

	updateInfoCancelados() {
		var form = document.querySelector("#form-info-cancelados");
		var formData = new FormData(form);
		document.querySelector('#form-info-cancelados [name="submit"]').disabled = true;

		fetch('../administracion_SA/updateInfoCancelados', {
			method: 'POST',
			body: formData
		})
			.then(response => {
				//console.log(response.json());
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
						document.querySelector("#form-info-cancelados").reset();
						utils.destruir_datatable('#tb_paid_bills_canhcel', '#tb_paid_bills_canhcel tbody', Administracion.tabla_formato(json_app.facturas_canceladas, 'tb_paid_bills_canhcel'));
						utils.showToast('Información guardada correctamente', 'success');
						document.querySelector('#form-info-cancelados [name="submit"]').disabled = false;
						$('#modal_info_cancelados').modal('hide');
					} else if (json_app.status == 0) {
						utils.showToast('No se pudo consultar la informacion dentro', 'error');
						document.querySelector('#form-info-cancelados [name="submit"]').disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector('#form-info-cancelados [name="submit"]').disabled = false;
				}
			})
			.catch(error => {
				utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
				document.querySelector('#form-info-cancelados [name="submit"]').disabled = false;

			});
	}

	
	
	chagueCliente(cliente) {
		const formData = new FormData();
		formData.append('Cliente', cliente);
		fetch('../administracion_SA/chagueCliente', {
				method: 'POST',
				body: formData
			})
			.then(response => {
				//console.log(response.json());
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
						let form = document.querySelector('#modal_edit form');

						let razones = '';
						json_app.razones.forEach(razon => {
							razones +=
								`
							<option value="${razon.Razon.trim()}">${razon.Razon}</option>
							`;
						});
						razones += '<option value="Pendiente">Pendiente</option>';
						form.querySelectorAll('select')[0].innerHTML = razones;
						form.querySelector('[name="ID_Cliente"]').value = json_app.cliente.Cliente;
						form.querySelector('[name="Cliente"]').value = json_app.cliente.Nombre_Cliente;
					} else if (json_app.status == 0) {
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
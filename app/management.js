class Management {

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

	bill_update() {
		var form = document.querySelector("#bill-edit-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/update_bill');
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
						window.location.reload();
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

	po_manage() {
		var form = document.querySelector("#po-manage-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/purchase_order_follow_up');
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
					utils.showToast('Gestión creada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#po-manage-form #submit").disabled = false;
				} else if (r == 3) {
					utils.showToast('Orden de compra actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);

				} else {
					document.querySelector("#po-manage-form #submit").disabled = false;
				}
			}
		}
	}


	//=========================================[gabo 20/02/2022]============================================================================================
	bill_manage_modal() {
		var form = document.querySelector("#bill-gestion-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../administracion/bill_follow_up_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('Gestión creada exitosamente', 'success');
						$('#modal_gestionar_factura').modal('hide');
					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					} else {
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
					form.querySelectorAll('.btn')[1].disabled = false;
				}
			}
		}
	}


	bill_update_modal(type) { //gabo 20/02/2022
		var form = document.querySelector("#bill-edit-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		document.querySelector("#bill-edit-form #submit").disabled = true
		xhr.open('POST', '../administracion/update_bill_modal');
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
						utils.showToast('Factura actualizada exitosamente', 'success');
						document.querySelector('#tboodyFacturaPaid').innerHTML = '';
						let bills = '';
						json_app.bills.forEach(element => {
							let clase_dias = '';
							if (element.days_elapsed > element.credit_days) {
								clase_dias = 'bg-danger';
							}

							let clase_estado = '';
							if (element.status == 1) {
								clase_estado = 'bg-orange';
							} else if (element.status == 2) {
								clase_estado = 'bg-success';
							} else {
								clase_estado = '';
							}

							bills += `
						<tr>
						<td><b> ${element.folio}</b></td>
						<td> ${element.emit_date}</td>
						<td class="text-center">${element.credit_days}</td>
						<td class="text-center ` + clase_dias + `">${element.days_elapsed}</td>
						<td class="text-center">${element.customer}</td>
						<td>${element.business_name} </td>
						<td class="text-right">${element.total==null?'':element.total}</td>
						<td class="text-right">${element.total_IVA==null?'':element.total_IVA}</td>
						<td>${element.payment_date==null?'':element.payment_date}</td>
						<td class="text-center ` + clase_estado + `">  ${element.estado}</td>
						<td>${element.payment_promise_date==null?'':element.payment_promise_date}</td>
						<td>${element.last_follow_up_date==null?'':element.last_follow_up_date}</td>
						<td>${element.last_follow_up_comments==null?'':element.last_follow_up_comments}</td>
						<td class="text-center py-0">
						<div class="btn-group btn-group-sm">
						  <a href="${element.url_editar_factura}" class="btn btn-success btn-sm mr-1">
							<i class="fas fa-eye"></i>
						  </a>
	
						  <button class="btn btn-orange btn-fact mr-1" id="btn-editar-factura" value="${element.idE}">
							<i class="fas fa-pencil-alt"></i>
						  </button>
	
						  <button class="btn btn-secondary btn-gestionar-fact mr-1" id="btn-gestionar-factura" value="${element.idE}">
							<i class="fas fa-cog"></i>
						  </button>
						</div>
						  </td>
	
					</tr>
					`});


						//Pagadas    
						let bills_paid = '';
						json_app.bills_paid.forEach(element => {
							let clase_dias = '';
							if (element.days_elapsed > element.credit_days) {
								clase_dias = 'bg-danger';
							}

							let clase_estado = '';
							if (element.status == 1) {
								clase_estado = 'bg-orange';
							} else if (element.status == 2) {
								clase_estado = 'bg-success';
							} else {
								clase_estado = '';
							}

							bills_paid += `
						<tr>
						<td><b> ${element.folio}</b></td>
						<td> ${element.emit_date}</td>
						<td class="text-center">${element.credit_days}</td>
						<td class="text-center ` + clase_dias + `">${element.days_elapsed}  </td>
						<td class="text-center">${element.customer}</td>
						<td>${element.business_name} </td>
						<td class="text-right">${element.total==null?'':element.total}</td>
						<td class="text-right">${element.total_IVA==null?'':element.total_IVA}</td>
						<td>${element.payment_date==null?'':element.payment_date}</td>
						<td class="text-center ` + clase_estado + `">  ${element.estado}</td>
						<td>${element.payment_promise_date==null?'':element.payment_promise_date}</td>
						<td>${element.last_follow_up_date==null?'':element.last_follow_up_date}</td>
						<td>${element.last_follow_up_comments==null?'':element.last_follow_up_comments}</td>
						<td class="text-center py-0">
						<div class="btn-group btn-group-sm">
						  <a href="${element.url_editar_factura}" class="btn btn-success btn-sm mr-1">
							<i class="fas fa-eye"></i>
						  </a>
	
						  <button class="btn btn-orange btn-fact mr-1" id="btn-editar-factura" value="${element.idE}">
							<i class="fas fa-pencil-alt"></i>
						  </button>
	
						  <button class="btn btn-secondary btn-gestionar-fact mr-1" id="btn-gestionar-factura" value="${element.idE}">
							<i class="fas fa-cog"></i>
						  </button>
						</div>
						  </td>
						</tr>
					`
						});
						document.querySelector('#tboodyFacturaPaid').innerHTML = bills_paid;
						document.querySelector('#tboodyFactura').innerHTML = bills;
						document.querySelector("#bill-edit-form #submit").disabled = false;
						$('#modal_editar_factura').modal('hide');
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#bill-edit-form #submit").disabled = false;
					} else {
						document.querySelector("#bill-edit-form #submit").disabled = false;
					}

				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
					form.querySelectorAll('.btn')[1].disabled = false;

				}
			}
		}
		//=====================================================================================================================================



	}
}
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
				let json_app = JSON.parse(r);
				try {
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#bill-gestion-form #submit").disabled = false;
					} else if (json_app.status == 1) {
						
							utils.destruir_datatable('#tb_paid_bills', '#tb_paid_bills tbody', Management.table_format(json_app.paid_bills, 'paid_bills'));
					utils.destruir_datatable('#tb_unpaid_bills', '#tb_unpaid_bills tbody', Management.table_format(json_app.unpaid_bills, 'unpaid_bills'));
					utils.destruir_datatable('#tb_cancelled_bills', '#tb_cancelled_bills tbody', Management.table_format(json_app.cancelled_bills, 'cancelled_bills'));
					document.querySelector("#bill-gestion-form #submit").disabled = false;

						utils.showToast('Gestión creada exitosamente', 'success');
						$('#modal_gestionar_factura').modal('hide');
					} else if (json_app.status == 2) {
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
					console.log(json_app)
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#bill-edit-form #submit").disabled = false;
					} else if (json_app.status == 1) {
						
						
							utils.destruir_datatable('#tb_paid_bills', '#tb_paid_bills tbody', Management.table_format(json_app.paid_bills, 'paid_bills'));
					utils.destruir_datatable('#tb_unpaid_bills', '#tb_unpaid_bills tbody', Management.table_format(json_app.unpaid_bills, 'unpaid_bills'));
					utils.destruir_datatable('#tb_cancelled_bills', '#tb_cancelled_bills tbody', Management.table_format(json_app.cancelled_bills, 'cancelled_bills'));

						
						utils.showToast('Factura actualizada exitosamente', 'success');

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
			}//=====================================================================================================================================

getInfoCancel(id) {

		const data = new FormData();
		data.append('id', id);

		fetch('../administracion/getInfoCancel', {
			method: 'POST',
			body: data
		})
			.then(response => {
				//	console.log(response.json());
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
						document.querySelector('#modal_info_cancelled [name="id"]').value = json_app.bill.id_encrypted
						document.querySelector('#modal_info_cancelled [name="cancellation_date"]').value = json_app.bill.cancellation_date
						document.querySelector('#modal_info_cancelled [name="comments"]').innerHTML = json_app.bill.comments;
						document.querySelector('#titulo').innerHTML = json_app.bill.folio;

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
	updateInfoCancelled() {
		var form = document.querySelector("#form-info-cancelled");
		var formData = new FormData(form);
		document.querySelector('#form-info-cancelled [name="submit"]').disabled = true;

		fetch('../administracion/updateInfoCancelled', {
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
						document.querySelector("#form-info-cancelled").reset();
						utils.destruir_datatable('#tb_cancelled_bills', '#tb_cancelled_bills tbody', Management.table_format(json_app.cancelled_bills, 'cancelled_bills'));
						utils.showToast('Información guardada correctamente', 'success');
						document.querySelector('#form-info-cancelled [name="submit"]').disabled = false;
						$('#modal_info_cancelled').modal('hide');
					} else if (json_app.status == 0) {
						utils.showToast('No se pudo consultar la informacion dentro', 'error');
						document.querySelector('#form-info-cancelled [name="submit"]').disabled = false;

					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector('#form-info-cancelled [name="submit"]').disabled = false;
				}
			})
		// .catch(error => {
		// 	utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
		// 	document.querySelector('#form-info-cancelled [name="submit"]').disabled = false;

		// });
	}
	static table_format(bills, tabla) {


		let factu = '';
		let statusclass = '';
		let days_style = '';
		bills.forEach(bill => {

			(bill.status == 1) ? statusclass = 'bg-orange' : (bill.status == 2) ? statusclass = 'bg-success' : (bill.status == 3) ? statusclass = 'bg-danger' : statusclass = '';
			parseInt(bill.days_elapsed) > parseInt(bill.credit_days) ? days_style = 'bg-danger' : '';

			factu += `
				<tr id='factura${bill.folio}'>
					<td class="text-center align-middle"><b>${bill.folio}</b></td>
					<td class="text-center align-middle">${bill.emit_date}</td>
					<td class="text-center align-middle">${bill.credit_days}</td>
					<td class="text-center align-middle ${days_style}">${bill.days_elapsed}</td>
					<td class="text-center align-middle">${bill.customer}</td>
					<td class="text-center align-middle">${bill.business_name}</td>
					<td class="text-center align-middle">$ ${bill.total}</td>
					<td class="text-center align-middle">$ ${bill.total_IVA}</td>
					<td class="text-center align-middle">${bill.payment_date}</td>
					<td class="text-center align-middle ${statusclass}">${bill.estado}</td>`;

			if (tabla == 'cancelled_bills') {

				factu += `<td class="text-center align-middle">${bill.cancellation_date}</td>
					<td class="text-center align-middle">${bill.comments}</td>`;
			} else {
				factu += `<td class="text-center align-middle">${bill.payment_promise_date}</td>
				<td class="text-center align-middle">${bill.last_follow_up_date}</td>
				<td class="text-center align-middle">${bill.last_follow_up_comments}</td>`;

			}
			if (tabla == 'unpaid_bills') {
				factu += `<td class="text-center align-middle">${bill.name_vacancy}</td> `;
			}

			factu += `<td class="text-center py-0 ">
			           <div class="btn-group btn-group-sm">`;
			if (tabla == 'cancelled_bills') {
				factu += ` <a href="editar_factura&folio=${bill.id_encrypted}" class="btn btn-success btn-sm mr-1"> <i class="fas fa-eye"></i> </a>
				<button class="btn btn-info btn-sm mr-1" data-id="${bill.id_encrypted}"><i class="fas fa-pencil-alt"></i></button>`;
			} else {
				factu += `          
					 <a href="administracion/editar_factura&id=${bill.id_encrypted}" class="btn btn-success btn-sm mr-1"><i class="fas fa-eye"></i></a>
				     <button class="btn btn-orange btn-fact mr-1" id="btn-editar-factura" value="${bill.id_encrypted}"><i class="fas fa-pencil-alt"></i></button>
				     <button class="btn btn-secondary btn-gestionar-fact mr-1" id="btn-gestionar-factura" value="${bill.id_encrypted}"><i class="fas fa-cog"></i></button>
					 `;
			}
			factu += `</div>
			           </td>
				</tr>
			`;
		});

		return factu;


	}
}
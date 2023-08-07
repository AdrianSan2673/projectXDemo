class Preparation {

	create() {
		this.id = document.querySelector("#preparation-form #id").value;
		this.id_candidate = document.querySelector("#preparation-form #id_candidate").value;

		var form = document.querySelector("#preparation-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../formacion/create');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#preparation-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Formación adicional creada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#preparation-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	update() {
		this.id = document.querySelector("#preparation-form #id").value;
		this.id_candidate = document.querySelector("#preparation-form #id_candidate").value;

		var form = document.querySelector("#preparation-form");
		var formData = new FormData(form);
		formData.append('id', this.id);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../formacion/update');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#preparation-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Formación actualizada exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#preparation-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	// === [gabo 24 abril ver candidato] === 
	update_modal() {
		var form = document.querySelector("#save-preparation-form");
		var formData = new FormData(form);
		document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = true;


		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../formacion/update_modal');
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
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						let preparations = json_app.preparations;
						let exp = "";
						preparations.forEach((element) => {

							exp += `
	         	<div class="col-md-6">
	        	<b class="text-muted">` + element.course + `</b>
				<button value="eliminar" onclick="delete_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
		        <button value="update_preparation" onclick="update_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button> `;

							if (element.level != "") {
								exp += `<p>` + element.level + `</p>`;
							}

							exp += `
	     	    <p> ` + element.institution + `</p>
	    	    <p>` + element.start_date + ` - ` + element.end_date + `</p>
	            </div>`;
						});
						document.querySelector("#div_preparation").innerHTML = exp;
						utils.showToast('Formación actualizada exitosamente', 'success');
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
						$('#modal_preparation_candidato').modal('hide');
					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
				}
			} 
		}
	}

	create_modal() {
		var form = document.querySelector("#save-preparation-form");
		var formData = new FormData(form);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../formacion/create_modal');
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
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						let preparations = json_app.preparations;
						let exp = "";
						preparations.forEach((element) => {
							exp += `
	         	<div class="col-md-6">
	        	<b class="text-muted">` + element.course + `</b>
				<button value="eliminar" onclick="delete_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
		        <button value="update_preparation" onclick="update_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button> `;

							if (element.level != "") {
								exp += `<p>` + element.level + `</p>`;
							}

							exp += `
	     	    <p> ` + element.institution + `</p>
	    	    <p>` + element.start_date + ` - ` + element.end_date + `</p>
	            </div>`;

						});

						document.querySelector("#div_preparation").innerHTML = exp;
						utils.showToast('Formación adicional creada exitosamente', 'success');
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
						$('#modal_preparation_candidato').modal('hide');

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
				}
			} 
		}
	}



	fill_modal(id_preparation) {
		this.id_preparation = id_preparation;
		let xhr = new XMLHttpRequest();
		let data = `id_preparation=${this.id_preparation}`;
		xhr.open('POST', '../formacion/getOne');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						$("#level").val(json_app.preparation.id_level);
						$('#level').trigger('change');
						document.querySelector('#modal_preparation_candidato [name="course"]').value = json_app.preparation.course;
						document.querySelector('#modal_preparation_candidato [name="institution_preparation"]').value = json_app.preparation.institution;
						document.querySelector('#modal_preparation_candidato [name="start_date_preparation"]').value = json_app.preparation.start_date;
						document.querySelector('#modal_preparation_candidato [name="end_date_preparation"]').value = json_app.preparation.end_date;
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
				}

			}
		}
	}



	delete_preparation(id_preparation) {

		this.id_preparation = id_preparation;
		let xhr = new XMLHttpRequest();
		let data = `id_preparation=${this.id_preparation}`;
		xhr.open('POST', '../formacion/delete_preparation');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);


		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-education-form #preparation_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						let preparations = json_app.preparations;
						let exp = "";
						preparations.forEach((element) => {

							exp += `
					 <div class="col-md-6">
					<b class="text-muted">` + element.course + `</b>
					<button value="eliminar" onclick="delete_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
					<button value="update_preparation" onclick="update_preparation('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button> `;

							if (element.level != "") {
								exp += `<p>` + element.level + `</p>`;
							}

							exp += `
					 <p> ` + element.institution + `</p>
					<p>` + element.start_date + ` - ` + element.end_date + `</p>
					</div>`;

						});
						document.querySelector("#div_preparation").innerHTML = exp;
						document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
						$('#modal_preparation_candidato').modal('hide');
						utils.showToast('Formación eliminada exitosamente', 'success');
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-preparation-form #preparation_candidate_submit").disabled = false;
				}

			} 
		}
	}

	// === [FIN] === 

}
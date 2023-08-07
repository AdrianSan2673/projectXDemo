class Aptitude {

	create() {
		this.id = document.querySelector("#aptitude-form #id").value;
		this.id_candidate = document.querySelector("#aptitude-form #id_candidate").value;

		var form = document.querySelector("#aptitude-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../aptitud/create');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#aptitude-form #candidate_submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('Aptitud creada exitosamente', 'success');
						setTimeout(() => {
							window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
						}, 3000);

					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#aptitude-form #candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#aptitude-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	update() {
		this.id = document.querySelector("#aptitude-form #id").value;
		this.id_candidate = document.querySelector("#aptitude-form #id_candidate").value;

		var form = document.querySelector("#aptitude-form");
		var formData = new FormData(form);
		formData.append('id', this.id);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../aptitud/update');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				try {
					if (r == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#aptitude-form #candidate_submit").disabled = false;
					} else if (r == 1) {
						utils.showToast('Aptitud actualizada exitosamente', 'success');
						setTimeout(() => {
							window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
						}, 3000);

					} else if (r == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#aptitude-form #candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#aptitude-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	// ==[gabo 26 abril ver candidato]===

	fill_modal(id_aptitude) {

		this.id_aptitude = id_aptitude;
		let xhr = new XMLHttpRequest();
		let data = `id_aptitude=${this.id_aptitude}`;
		xhr.open('POST', '../aptitud/getOne');
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
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						$("#level_aptitude").val(json_app.aptitude.level);
						$('#level_aptitude').trigger('change');
						document.querySelector('#modal_aptitude_candidato [name="aptitude"]').value = json_app.aptitude.aptitude;

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
				}
			}
		}
	}

	update_modal() {

		var form = document.querySelector("#save-aptitude-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../aptitud/update_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {


						let aptitudes = json_app.aptitudes;
						let exp = "";
						aptitudes.forEach((element) => {


							exp += `<div class="col-md-4">
						<button value="eliminar" onclick="delete_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
						<button value="update_aptitude" onclick="update_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <p>` + element.aptitude + `</p>
						<h6 class="text-muted">	`;
							for (let i = 1; i <= 10; i++) {
								if (i <= element.level) {
									exp += `<i class="fas fa-circle"></i>`;
								} else {
									exp += `<i class="far fa-circle"></i>`;
								}
							}

							exp += `</h6></div>`;

						});

						document.querySelector("#div_aptitude").innerHTML = exp;
						$('#modal_aptitude_candidato').modal('hide');
						utils.showToast('Aptitud actualizada exitosamente', 'success');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
				}
			}
		}
	}


	create_modal() {

		var form = document.querySelector("#save-aptitude-form");
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../aptitud/create_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						let aptitudes = json_app.aptitudes;
						let exp = "";
						aptitudes.forEach((element) => {

							exp += `<div class="col-md-4">
						<button value="eliminar" onclick="delete_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
						<button value="update_aptitude" onclick="update_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <p>` + element.aptitude + `</p>
						<h6 class="text-muted">	`;
							for (let i = 1; i <= 10; i++) {
								if (i <= element.level) {
									exp += `<i class="fas fa-circle"></i>`;
								} else {
									exp += `<i class="far fa-circle"></i>`;
								}
							}

							exp += `</h6></div>`;

						});

						document.querySelector("#div_aptitude").innerHTML = exp;
						$('#modal_aptitude_candidato').modal('hide');
						utils.showToast('Aptitud añadida exitosamente', 'success');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
				}
			}
		}
	}




	delete_aptitude(id_aptitude) {

		this.id_aptitude = id_aptitude;
		let xhr = new XMLHttpRequest();
		let data = `id_aptitude=${this.id_aptitude}`;
		xhr.open('POST', '../aptitud/delete_aptitude');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {

						let aptitudes = json_app.aptitudes;
						let exp = "";
						aptitudes.forEach((element) => {

							exp += `<div class="col-md-4">
						<button value="eliminar" onclick="delete_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button>
						<button value="update_aptitude" onclick="update_aptitude('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
                        <p>` + element.aptitude + `</p>
						<h6 class="text-muted">	`;
							for (let i = 1; i <= 10; i++) {
								if (i <= element.level) {
									exp += `<i class="fas fa-circle"></i>`;
								} else {
									exp += `<i class="far fa-circle"></i>`;
								}
							}

							exp += `</h6></div>`;

						});

						document.querySelector("#div_aptitude").innerHTML = exp;
						$('#modal_aptitude_candidato').modal('hide');
						utils.showToast('Aptitud eliminada exitosamente', 'success');
						document.querySelector("#save-aptitude-form #aptitude_candidate_submit").disabled = false;


					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#update_candidate_submit").disabled = false;
				}
			}
		}
	}

	// ===[fin]===
}
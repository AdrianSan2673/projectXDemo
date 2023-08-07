class Language {

	create() {
		this.id = document.querySelector("#language-form #id").value;
		this.id_candidate = document.querySelector("#language-form #id_candidate").value;

		var form = document.querySelector("#language-form");
		var formData = new FormData(form);
		formData.append('id_candidate', this.id_candidate);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../idioma/create');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#language-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Idioma creado exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#language-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	update() {
		this.id = document.querySelector("#language-form #id").value;
		this.id_candidate = document.querySelector("#language-form #id_candidate").value;

		var form = document.querySelector("#language-form");
		var formData = new FormData(form);
		formData.append('id', this.id);

		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../idioma/update');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);
		xhr.id_candidate = this.id_candidate;

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if (r == 0) {
					utils.showToast('Omitiste algún dato', 'error');
					document.querySelector("#language-form #candidate_submit").disabled = false;
				} else if (r == 1) {
					utils.showToast('Idioma actualizado exitosamente', 'success');
					setTimeout(() => {
						window.location.href = `../candidato/ver&id=${xhr.id_candidate}`;
					}, 3000);

				} else if (r == 2) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
					document.querySelector("#language-form #candidate_submit").disabled = false;
				}
			}
		}
	}

	// ===[GABO 25 ABRIL VER CANDIDATO]===
	fill_modal(id_language) {
		this.id_language = id_language;
		let xhr = new XMLHttpRequest();
		let data = `id_language=${this.id_language}`;

		document.querySelector("#save-language-form #language_candidate_submit").disabled = true;

		xhr.open('POST', '../idioma/getOne');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);
		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						$("#language").val(json_app.language.id_language);
						$('#language').trigger('change');
						$("#level_language").val(json_app.language.level);
						$('#level_language').trigger('change');

						document.querySelector('#modal_language_candidato [name="institution_language"]').value = json_app.language.institution;
						document.querySelector('#modal_language_candidato [name="start_date_language"]').value = json_app.language.start_date;
						document.querySelector('#modal_language_candidato [name="end_date_language"]').value = json_app.language.end_date;
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					}

				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
				}
			}
		}
	}


	update_modal() {
		var form = document.querySelector("#save-language-form");
		document.querySelector("#save-language-form #language_candidate_submit").disabled = true;
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../idioma/update_modal');
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(formData);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				let json_app = JSON.parse(r);
				try {
					if (json_app.status == 0) {
						utils.showToast('Omitiste algún dato', 'error');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Idioma actualizado exitosamente', 'success');

						let languages = json_app.languages;
						let exp = "";
						languages.forEach((element) => {
							exp += `<div class="col-md-6" >
			                	 <b class="text-muted">` + element.language + ` / ` + element.language_level + `</b>
			                	 <button value="eliminar" onclick="delete_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
		   	                	 <button value="update_language" onclick="update_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
			                	 <p>` + element.institution + `</p>`;
							if (element.start_date != "") {
								exp += `<p>` + element.texto + `</p>`;
							}
							exp += `</div> `;
						});
						console.log(exp);
						document.querySelector("#div_language").innerHTML = exp;
						$('#modal_language_candidato').modal('hide');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-education-form #candidate_education_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
				}
			}
		}


	}


	save_modal() {
		var form = document.querySelector("#save-language-form");
		document.querySelector("#save-language-form #language_candidate_submit").disabled = true;
		var formData = new FormData(form);
		let xhr = new XMLHttpRequest();
		xhr.open('POST', '../idioma/create_modal');
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
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Idioma añadido exitosamente', 'success');

						let languages = json_app.languages;
						let exp = "";
						languages.forEach((element) => {


							exp += `<div class="col-md-6" >
				               <b class="text-muted">` + element.language + ` / ` + element.language_level + `</b>
				               <button value="eliminar" onclick="delete_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
		   		               <button value="update_language" onclick="update_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
				               <p>` + element.institution + `</p>`;
							if (element.start_date != "") {
								exp += `<p>` + element.texto + `</p>`;
							}
							exp += `</div> `;
						});

						document.querySelector("#div_language").innerHTML = exp;
						$('#modal_language_candidato').modal('hide');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;

					} else if (json_app.status == 2) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					} else if (json_app.status == 3) {
						utils.showToast('Idioma repetido', 'error');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
				}
			} 
		}


	}

	delete_language(id_language) {

		this.id_language = id_language;
		let xhr = new XMLHttpRequest();
		let data = `id_language=${this.id_language}`;
		xhr.open('POST', '../idioma/delete_language');
		xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xhr.send(data);

		xhr.onreadystatechange = function () {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;

				try {
					let json_app = JSON.parse(r);
					if (json_app.status == 0) {
						utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					} else if (json_app.status == 1) {
						utils.showToast('Idioma eliminado exitosamente', 'success');

						let languages = json_app.languages;
						let exp = "";
						languages.forEach((element) => {
							exp += `<div class="col-md-6" >
				                <b class="text-muted">` + element.language + ` / ` + element.language_level + `</b>
				                <button value="eliminar" onclick="delete_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-trash"></i> </button> 
		   		                <button value="update_language" onclick="update_language('` + element.id + `')" class="btn" style="font-size: 1.2rem; margin:-0.75rem 0; float:right; margin-right:-0.625rem;"><i class="fas fa-pen"></i> </button>
				                <p>` + element.institution + `</p>`;
							if (element.start_date != "") {
								exp += ` <p>` + element.texto + `</p>`;
							}
							exp += `</div> `;
						});
						document.querySelector("#div_language").innerHTML = exp;
						$('#modal_language_candidato').modal('hide');
						document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
					}
				} catch (error) {
					utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
					document.querySelector("#save-language-form #language_candidate_submit").disabled = false;
				}
			} 
		}
	}
	// ===[fin]===

}
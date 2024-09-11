class Department {
  save() {
    var form = document.querySelector("#modal_create form");
    var formData = new FormData(form);
    form.querySelectorAll('.btn')[1].disabled = true;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../proyecto/save');
    xhr.send(formData);
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let r = this.responseText;
        console.log(r);
        try {
          if (r == 0) {
            utils.showToast('Omitiste algún dato', 'warning');
          } else {
            let json_app = JSON.parse(r);
            if (json_app.status == 2) {
              utils.showToast('Hubo un error al guardar, intenta de nuevo.', 'error');
              form.querySelectorAll('.btn')[1].disabled = false;
            } else if (json_app.status == 1) {
              form.querySelectorAll('.btn')[1].disabled = true;
              let departamentos = '';
              json_app.departamentos.forEach(element => {

                departamentos += `
                          <div class="col-md-4 ">
                            <div class="small-box bg-info">
                              <button class="btn text-white btn-delete" value="${element.id}">X</button>
                              <div class="inner">
                                <h4>${element.department}</h4>
                                <div class="row">
                                  <div class="col-6">
                                    <p style="font-size: small;">${element.no_employees} empleados</p>
                                  </div>
                                  <div class="col-6">
                                    <p style="font-size: small;">${element.no_positions} puestos</p>
                                  </div>
                                </div>
                              </div>
                              <a class="small-box-footer" href="${element.url}">
                                Ver
                                <i class="fas fa-arrow-circle-right"></i>
                              </a>
                            </div>
                          </div>
                          `
              });
              document.querySelector('#all_departments').innerHTML = departamentos;
              utils.showToast('Se agregó el departamento', 'success');
              $('#modal_create').modal('hide');
              form.querySelectorAll('.btn')[1].disabled = false;
            } else {
              utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
              form.querySelectorAll('.btn')[1].disabled = false;
            }
          }
        } catch (error) {
          utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
          form.querySelectorAll('.btn')[1].disabled = false;
        }

      }
    }
  }

  updateProyecto() {
    var form = document.querySelector("#modal_editar_proyecto form");
    var formData = new FormData(form);

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../proyecto/updateDepartamento');
    xhr.send(formData);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let r = xhr.responseText;
        console.log(r);
        echo(r);
        try {
          let json_app = JSON.parse(r);
          if (json_app.status == 0) {
            utils.showToast('Omitiste algún dato', 'error');
          } else if (json_app.status == 1) {
            let title = document.querySelectorAll('.title-departament')
            for (let i = 0; i < title.length; i++) {
              title[i].textContent = json_app.departments
            }
            utils.showToast('Fue actualizado', 'success');
            $('#modal_editar_proyecto').modal('hide');

          } else if (json_app.status == 2) {
            form.querySelectorAll('.btn')[1].disabled = false;
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
          } else {
            form.querySelectorAll('.btn')[1].disabled = false;
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
          }
        } catch (error) {
          // form.querySelectorAll('.btn')[1].disabled = false;
          utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
        }
      }
    }
  }


  delet(id) {

    let xhr = new XMLHttpRequest();
    let data = `id=${id}`;

    xhr.open('POST', '../proyecto/delete');
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
          } else if (json_app.status == 1) {
            let departamentos = '';
            json_app.departamentos.forEach(element => {
              departamentos += `
                                       <div class="col-md-4 ">
                                      <div class="small-box bg-info">

                                        <button class="btn text-white btn-delete" value="${element.id}"> X</button>

                                        <div class="inner">
                                          <h4>${element.department}</h4>
                                          <div class="row">
                                            <div class="col-6">
                                              <p style="font-size: small;">${element.no_employees} empleados</p>
                                            </div>
                                            <div class="col-6">
                                              <p style="font-size: small;">${element.no_positions} puestos</p>
                                            </div>
                                          </div>
                                        </div>
                                        <a class="small-box-footer" href="${json_app.base_url}proyecto/ver&id=${element.id}">
                                          Ver
                                          <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                      </div>
                                    </div>
                                    `
            });
            document.querySelector('#all_departments').innerHTML = departamentos;
            utils.showToast('Fue eliminado exitosamente.', 'success');
          } else if (json_app.status == 2) {
            utils.showToast('El departamento contiene empleados o puestos.', 'error');
          } else {
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
          }
        } catch (error) {
          utils.showToast('Algo salió mal. Inténtalo de nuevo ', 'error');
        }

      }
    }
  }

}
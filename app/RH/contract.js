class Contract {
  save() {
    var form = document.querySelector("#modal-contract form");
    var formData = new FormData(form);
    form.querySelectorAll('.btn')[1].disabled = true

    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../EmpleadoContrato/save');
    xhr.send(formData);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let r = xhr.responseText;
        console.log(r);
        try {
          let json_app = JSON.parse(r);
          if (json_app.status == 0) {
            form.querySelectorAll('.btn')[1].disabled = false;
            utils.showToast('Omitiste algún dato', 'error');
            $('#modal_indicators').modal('hide');
          } else if (json_app.status == 1) {

            let contract1= `
            <div class="col-sm-12 text-center">
                <b class="h5">Última contratacion</b>
            </div>
            <div class="col-sm-4 text-center">
               <b>Fecha de inicio</b>
               <p>${json_app.oneContractEmployee.contract_start}</p>
            </div>
            <div class="col-sm-4 text-center">
                <b>Fecha de finalizacion</b>
                <p>${json_app.oneContractEmployee.contract_end}</p>
            </div>
            <div class="col-sm-4 text-center">
                <b>Tipo de contrato</b>
                <p>${json_app.oneContractEmployee.type}</p>
            </div>
            `
            document.querySelectorAll('#datos_contrato .row')[1].innerHTML=contract1

            
            let contract = '';
            json_app.employeeContract.forEach(element => {
              contract +=
                `
                <tr>
                  <td class=" align-middle ">${element.contract_start}</td>
                  <td class=" align-middle ">${element.contract_end}</td>
                  <td class=" align-middle ">${element.type}</td>
                  <td class=" text-center ">
                      <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                  </td>
                </tr>
                `
            });
            document.querySelector('#tboodycontract').innerHTML = contract;


           
    


            document.querySelector('#divNumber').hidden = true
            document.querySelector('#divPeriodo').hidden = true
            document.querySelector('#number').required = false
            document.querySelector('#period').required = false

            form.reset();
            utils.showToast('Guardado con exito.', 'success');
            $('#modal-contract').modal('hide');

            form.querySelectorAll('.btn')[1].disabled = false;
          } else if (json_app.status == 2) {
            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
            form.querySelectorAll('.btn')[1].disabled = false;
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


  delete(id) {

    let xhr = new XMLHttpRequest();
    let data = `id=${id}`;

    xhr.open('POST', '../EmpleadoContrato/delete');
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
            
            
            let contract1= `
            <div class="col-sm-12 text-center">
                <b class="h5">Última contratacion</b>
            </div>
            <div class="col-sm-4 text-center">
               <b>Fecha de inicio</b>
               <p>${json_app.oneContractEmployee.contract_start}</p>
            </div>
            <div class="col-sm-4 text-center">
                <b>Fecha de finalizacion</b>
                <p>${json_app.oneContractEmployee.contract_end}</p>
            </div>
            <div class="col-sm-4 text-center">
                <b>Tipo de contrato</b>
                <p>${json_app.oneContractEmployee.type}</p>
            </div>
            `
            document.querySelectorAll('#datos_contrato .row')[1].innerHTML=contract1

            let contract = '';
            json_app.employeeContract.forEach(element => {
              contract +=
                `
                <tr>
                  <td class=" align-middle ">${element.contract_start}</td>
                  <td class=" align-middle ">${element.contract_end}</td>
                  <td class=" align-middle ">${element.type}</td>
                  <td class=" text-center ">
                      <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                  </td>
                </tr>
                `
            });
            document.querySelector('#tboodycontract').innerHTML = contract;

            utils.showToast('Eliminado con exito', 'success');
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
class Employee {

    save_empleado() {
        var form = document.querySelector("#employee-form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[0].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        //utils.showToast('El empleado fue registrada exitosamente', 'success');

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'El empleado fue registrada exitosamente',
                            showConfirmButton: false,
                            timer: 1750
                        })

                        form.reset();

                        document.querySelector('#select_razon_social').innerHTML = ''
                        //===[gabo 9 junio excel evaluaciones]===
                        $('#employee-form [name="id_boss"]').val("");
                        $('#employee-form [name="id_boss"]').trigger('change');
                        form.querySelectorAll('.btn')[0].disabled = false;
                        //===[gabo 9 junio excel evaluaciones fin]===

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Ya existe un empleado con ese curp', 'error');
                    }  else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }



    getContactosYRazonesPorCliente(Cliente) {
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `Cliente=${Cliente}`;
        let form = document.querySelector('#employee-form');
        xhr.open('POST', '../ServicioApoyo/getContactosYRazonesPorCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(r);
                    let contactos = '';
                    json_app.contactos.forEach(contacto => {
                        contactos +=
                            `
                        <option value="${contacto.ID}">${contacto.Razon}</option>
                        `;
                    });
                    contactos += '<option value="0">No asignado</option>';

                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones +=
                            `
                        <option value="${razon.Nombre_Razon.trim()}">${razon.Nombre_Razon}</option>
                        `;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';

                    form.querySelectorAll('select')[2].innerHTML = contactos;
                }
            }
        }
    }

    updateEmployee() {
        var form = document.querySelector("#modal_general form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../empleado/save');
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
                    } else if (json_app.status == 1) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        let employee =
                            `
                        <div class="row">
                              <div class="col-sm-4 text-center">
                                  <b>Nombre del empleado</b>
                                  <p class="title-empelado">${json_app.employee.first_name+ ' '+json_app.employee.surname+ ' '+json_app.employee.last_name}</p>
                              </div>

                              <div class="col-sm-4 text-center">
                                  <b>Titulo profesional</b>
                                  <p>${json_app.employee.scholarship==''||json_app.employee.scholarship==null?'Sin definir':json_app.employee.scholarship }</p>
                              </div>

                              <div class="col-sm-4 text-center">
                                  <b>Sexo</b>
                                  <p>${json_app.employee.id_gender}</p>                               
                              </div>
                        </div>

                        <div class="row">
                           <div class="col-sm-4 text-center">
                               <b>CURP</b>
                               <p>${json_app.employee.curp==''||json_app.employee.curp==null?'Sin definir':json_app.employee.curp}</p>
                           </div>

                           <div class="col-sm-4 text-center">
                               <b>NSS</b>
                               <p>${json_app.employee.nss==''||json_app.employee.nss==null?'Sin definir':json_app.employee.nss}</p>
                           </div>

                           <div class="col-sm-4 text-center">
                               <b>RFC</b>
                               <p>${json_app.employee.rfc==''||json_app.employee.rfc==null?'Sin definir':json_app.employee.rfc}</p>
                           </div>
                        </div>
						
					
						           <div class="row">
                           <div class="col-sm-12 text-center">
                               <b>Corrreo</b>
                               <p>${json_app.employee.email == '' || json_app.employee.email == null ? 'Sin definir' : json_app.employee.email}</p>
                           </div>
                        </div>
						
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Fecha de creación</b>
                                <p>${json_app.employee.created_at}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Fecha de nacimiento</b>
                                <p>${json_app.employee.date_birth}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Fecha de contratacion</b>
                                <p>${json_app.employee.start_date}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Puesto</b>
                                <p>${json_app.position.title}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Departamento</b>
                                <p>${json_app.position.department}</p>
                            </div>
                        
                            <div class="col-sm-4 text-center">
                                <b>A quien reporta</b>
                                <p>${json_app.employee.nameBoss==''||json_app.employee.nameBoss==null?'Sin definir':json_app.employee.nameBoss}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <b>Empresa contratante</b>
                                    <p>${json_app.employee.Cliente}</p>
                            </div>

                            <div class="col-sm-6 text-center">
                                <b>Razón social</b>
                                    <p>${json_app.employee.id_razon}</p>
                            </div>
                        </div>                        

                        
                        <div class="row divReasion" ${json_app.employee.reason_for_leaving!=null?'':'hidden'}>
                           <div class="col-sm-4 text-center">
                               <b>Fecha de terminacion</b>
                               <p class="end_date">${json_app.employee.end_date}</p>
                           </div>

                           <div class="col-sm-4 text-center"  >
                               <b>Motivo de baja</b>
                               <p class="reason_for_leaving">${json_app.employee.reason_for_leaving}</p>
                           </div>
                        
                           <div class="col-sm-4 text-center" >
                               <b>Comentario de baja</b>
                               <p class="comment_for_leaving">${json_app.employee.comment_for_leaving}</p>
                           </div>

                        </div>
                        
                        <div class="row divRe_entrry_date" ${json_app.employee.re_entry_date==null?'hidden':''} >
                        <div class="col-sm-4 text-center">
                            <b>Fecha de reingreso</b>
                            <p class="re_entry_dateP">${json_app.employee.re_entry_date}</p>
                        </div>
                    </div>`;


                        let hisotryPosition = ''
                        json_app.hisotryPosition.forEach(element => {
                            hisotryPosition += `
                            <tr>
                             <td class=" align-middle ">${element.title}</td>
                             <td class=" align-middle ">${element.department}</td>
                             <td class=" align-middle ">${element.start_date}</td>
                             <td class=" text-center ">
                                 <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                 <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                             </td>
                            </tr>
                            `
                        })
                        document.querySelector('#content-datos-general').innerHTML = employee;
                        document.querySelector('#tboodyHistory').innerHTML = hisotryPosition;
                        document.querySelector('.title-position').innerHTML = json_app.position.title
                        document.querySelector('#employee_number').innerHTML = json_app.employee.employee_number == null ? 'Sin definir' : json_app.employee.employee_number
                        document.querySelector('#civil_status').innerHTML = json_app.employee.civil_status == null ? 'Sin definir' : json_app.employee.civil_status
                        document.querySelector('#age').innerHTML = json_app.employee.age == null ? '0 Años' : json_app.employee.age + ' Años'


                        let title_empleado = document.querySelectorAll('.title-empelado')
                        for (let i = 0; i < title_empleado.length; i++) {
                            title_empleado[i].innerHTML = json_app.employee.first_name + ' ' + json_app.employee.surname + ' ' + json_app.employee.last_name;
                        }
                        utils.showToast('Fue editado', 'success');
                        $('#modal_general').modal('hide');
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }else if (json_app.status == 3) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('El CURP ya fue registrado', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }



    updateEnd_date() {
        var form = document.querySelector("#modal-baja form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/updateEnd_date');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;

                        document.querySelectorAll('.reason_for_leaving')[0].textContent = json_app.reason_for_leaving
                        document.querySelector('#selectreason_for_leaving').value = json_app.reason_for_leaving
                        document.querySelectorAll('.comment_for_leaving')[1].textContent = json_app.comment_for_leaving

                        for (let i = 0; i < 2; i++) {
                            document.querySelectorAll('.divReasion')[i].hidden = false
                            document.querySelectorAll('.comment_for_leaving')[i].textContent = json_app.comment_for_leaving
                        }
                        document.querySelector('.end_date').textContent = json_app.end_date
                        document.querySelector('.end_date2').textContent = json_app.end_date2
                        document.querySelector('.end_date2').value = json_app.end_date2


                        document.querySelector('#btn-debaja-empleado').classList.remove("btn-danger");
                        document.querySelector('#btn-debaja-empleado').classList.add("btn-success");
                        document.querySelector('#btn-debaja-empleado').textContent = 'Dar de alta'

                        $('#modal-baja').modal('hide');
                        setTimeout('document.location.reload()',2000);

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }

    updateRe_entry_date(id) {
        var form = document.querySelector("#modal-alta form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/updateRe_entry_date');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;

                        let divRe_entrry_date = document.querySelectorAll('.divRe_entrry_date')

                        for (let i = 0; i < divRe_entrry_date.length; i++) {
                            divRe_entrry_date[i].hidden = false
                            console.log(divRe_entrry_date[i]);
                        }
                        document.querySelector('#re_entry_date').value = json_app.re_entry_date
                        document.querySelector('#re_entry_dateP').textContent = json_app.re_entry_dateFullDate
                        $('#modal-alta').modal('hide');

                        document.querySelector('#btn-debaja-empleado').classList.remove("btn-success");
                        document.querySelector('#btn-debaja-empleado').classList.add("btn-danger");
                        document.querySelector('#btn-debaja-empleado').textContent = 'Dar de baja'

           			    location.reload();
                        setTimeout('document.location.reload()',1700);
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }



    updateDatacontact() {
        var form = document.querySelector("#modal-data-contact form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/updateDataContact');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        let employee =
                            `
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <b>Telefono 1</b>
                                <p>${json_app.employee_contacts.phone_number1==null||json_app.employee_contacts.phone_number1==''?'Sin definir':json_app.employee_contacts.phone_number1+' '+json_app.employee_contacts.label1 }</p>
                                </div>
                                
                                <div class="col-sm-6 text-center">
                                <b>Telefono 2</b>
                                <p>${json_app.employee_contacts.phone_number2==''||json_app.employee_contacts.phone_number2==null?'Sin definir': json_app.employee_contacts.phone_number2 +' '+json_app.employee_contacts.label2  } </p>
                            </div>
                        </div>
                                                   
                            <div class="row">
                                <div class="col-sm-6 text-center">
                                    <b>Correo</b>
                                    <p>${json_app.employee_contacts.email==null||json_app.employee_contacts.email==''?'Sin definir':json_app.employee_contacts.email}</p></div>
                                <div class="col-sm-6 text-center">
                                    <b>Correo empresarial</b>
                                    <p>${json_app.employee_contacts.institutional_email==null||json_app.employee_contacts.institutional_email==''?'Sin definir':json_app.employee_contacts.institutional_email}</p> </div>
                            </div>
                        </div>
                    
                        `

                        document.querySelector('#datos_Contacto').innerHTML = employee
                        $('#modal-data-contact').modal('hide');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }


    updateDatacontactEmergency() {
        var form = document.querySelector("#modal-data-emergency form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/updateDataEmergency');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        console.log(json_app.employee_contacts);
                        let employee =
                            `
                            <div class="row text-center">
                            <div class="col-12">
                                <b class="h6">Contacto 1</b>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Nombre</b>
                                <p>${json_app.employee_contacts.emergency_contact1==null||json_app.employee_contacts.emergency_contact1==''?'Sin definir':json_app.employee_contacts.emergency_contact1}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Parentesco</b>
                                <p>${json_app.employee_contacts.emergency_relationship1==null||json_app.employee_contacts.emergency_relationship1==''?'Sin definir':json_app.employee_contacts.emergency_relationship1}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Telefono</b>
                                <p>${json_app.employee_contacts.emergency_number1==null||json_app.employee_contacts.emergency_number1==''?'Sin definir':json_app.employee_contacts.emergency_number1}</p>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-12">
                                <b class="h6">Contacto 2</b>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Nombre</b>
                                <p>${json_app.employee_contacts.emergency_contact2==null||json_app.employee_contacts.emergency_contact2==''?'Sin definir':json_app.employee_contacts.emergency_contact2}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Parentesco</b>
                                <p>${json_app.employee_contacts.emergency_relationship2==null||json_app.employee_contacts.emergency_relationship2==''?'Sin definir':json_app.employee_contacts.emergency_relationship2}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b id="colores">Telefono</b>
                                <p>${json_app.employee_contacts.emergency_number2==null||json_app.employee_contacts.emergency_number2==''?'Sin definir':json_app.employee_contacts.emergency_number2}</p>
                            </div>
                        </div>
                      
                        `
                        document.querySelector('#datos_ContactoEmergency').innerHTML = employee
                        $('#modal-data-emergency').modal('hide');
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[0].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }




    updatePayroll() {
        var form = document.querySelector("#modal-payroll form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoNomina/save');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;

                        console.log(json_app);
                        let employee = `
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Fecha del último ajuste</b>
                                <p>${json_app.employeePayroll.created_at}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Salario actual o final</b>
                                <p>$${json_app.employeePayroll.gross_pay}</p>
                            </div>

                             <div class="col-sm-4 text-center">
                                <b>Salario inicial</b>
                                <p>$${json_app.employeePayroll.start_pay}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Banco</b>
                                <p>${json_app.employeePayroll.bank}</p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <b>Cuenta</b>
                                <p>${json_app.employeePayroll.account_number}</p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <b>CLABE</b>
                                <p>${json_app.employeePayroll.CLABE}</p>
                            </div>
                        </div>
                            `

                        let tableEmployee = ''
                        json_app.employeePayrollAll.forEach(element => {
                            tableEmployee +=
                                `
                            <tr role="row" class="odd">
                                <td class="text-center align-middle">$${element.gross_pay}</td>
                                <td class="text-center align-middle">${element.bank}</td>
                                <td class="text-center align-middle">${element.account_number}</td>
                                <td class="text-center align-middle">${element.CLABE}</td>
                                <td class="text-center align-middle">${element.created_at}</td>
                                <td class="text-center align-middle">${element.created_at}</td>
                                <td class=" text-center ">
                                <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                </td>
                            </tr>
                            `
                        })

                        document.querySelector('#divNomina').innerHTML = employee
                        document.querySelector('#tableRollPay').innerHTML = tableEmployee
                        $('#modal-payroll').modal('hide');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }


   
    deletePayroll(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoNomina/deletePayroll');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue eliminado', 'success');
                        let employee = `
                     <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Fecha del último ajuste</b>
                                <p>${json_app.employeePayroll!=''?json_app.employeePayroll.created_at:'Sin definir'}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Salario actual o final</b>
                                <p>$${json_app.employeePayroll!=''?json_app.employeePayroll.gross_pay:'Sin definir'}</p>
                            </div>

                            <div class="col-sm-4 text-center">
                                <b>Salario inicial</b>
                                <p>$${json_app.employeePayroll!=''?json_app.employeePayroll.start_pay:'Sin definir'}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <b>Banco</b>
                                <p>${json_app.employeePayroll!=''?json_app.employeePayroll.bank:'Sin definir'}</p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <b>Cuenta</b>
                                <p>${json_app.employeePayroll!=''?json_app.employeePayroll.account_number:'Sin definir'}</p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <b>CLABE</b>
                                <p>${json_app.employeePayroll!=''?json_app.employeePayroll.CLABE:'Sin definir'}</p>
                            </div>
                        </div>

                        `

                        let tableEmployee = ''

                        if (json_app.employeePayrollAll != '') {
                            json_app.employeePayrollAll.forEach(element => {
                                tableEmployee +=
                                    `
                        <tr role="row" class="odd">
                            <td class="text-center align-middle">$${element.gross_pay}</td>
                            <td class="text-center align-middle">${element.bank}</td>
                            <td class="text-center align-middle">${element.account_number}</td>
                            <td class="text-center align-middle">${element.CLABE}</td>
                            <td class="text-center align-middle">${element.created_at}</td>
                            <td class=" text-center ">
                            <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                            </td>
                        </tr>
                        `
                            })
                        }

                        document.querySelector('#divNomina').innerHTML = employee
                        document.querySelector('#tableRollPay').innerHTML = tableEmployee
 
                        if (json_app.employeePayroll=='') {
                            document.querySelector("#modal-payroll form").reset()
                        }
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }





    upload_file(dato) {
        var form = document.querySelector("#form_" + dato);
        var formData = new FormData(form);
        console.log(formData);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/upload_file');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        if (json_app.flag == 1)
                            document.querySelector('#cv_employee_url').innerHTML = `<a href="${json_app.routeDocu}"  target="_blank">${json_app.full_name_employee}.pdf</a>`
                        else if (json_app.flag == 2)
                            document.querySelector('#rfc_employee_url').innerHTML = `<a href="${json_app.routeDocu}"  target="_blank">${json_app.full_name_employee}.pdf</a>`

                        else if (json_app.flag == 3)
                            document.querySelector('#cfdi_employee_url').innerHTML = `<a href="${json_app.routeDocu}"  target="_blank">${json_app.full_name_employee}.pdf</a>`


                        utils.showToast('Archivo  agregado.', 'success');

                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }

    getFamily(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoFamilia/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        document.querySelector('#modal_family [name="id"]').value = 2

        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        document.querySelector('#modal_family [name="name"]').value = json_app.employeeFamily.name
                        document.querySelector('#modal_family [name="age"]').value = json_app.employeeFamily.age
                        document.querySelector('#modal_family select').value = json_app.employeeFamily.type
                        document.querySelector('#modal_family [name="id"]').value = json_app.employeeFamily.id
                        document.querySelector('#modal_family [name="flag"]').value = "2"


                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            }
        }
    }

    save_employee_family() {
        var form = document.querySelector("#modal_family form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoFamilia/save');
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
                    } else if (json_app.status == 1) {
                        utils.showToast('Se guardado con exito', 'success');

                        let employeeFamily = ''
                        json_app.employeeFamily.forEach(element => {
                            employeeFamily += `
                            <tr>
                              <td class="text-center align-middle text-bold">${element.type}</td>
                              <td class="text-center align-middle">${element.name==null||element.name==''?'Sin definir':element.name}</td>
                              <td class="text-center align-middle">${element.age==null||element.age==''?'Sin definir':element.age+' Años'}</td>
                              <td class="text-center align-middle">${element.created_at}</td>
                              <td class="text-center align-middle">
                                  <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                  <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                              </td>
                            </tr>
                            `
                        })

                        form.reset()
                        document.querySelector('#tboodyFamily').innerHTML = employeeFamily;
                        $('#modal_family').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;



                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }

    deleteFamily(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoFamilia/delete');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                //console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue eliminado', 'success');

                        let employeeFamily2 = ''
                        json_app.employeeFamily.forEach(element => {
                            employeeFamily2 += `
                            <tr>
                              <td class="text-center align-middle text-bold">${element.type}</td>
                              <td class="text-center align-middle">${element.name==null||element.name==''?'Sin definir':element.name}</td>
                              <td class="text-center align-middle">${element.age==null||element.age==''?'Sin definir':element.age+' Años'}</td>
                              <td class="text-center align-middle">${element.created_at}</td>
                              <td class="text-center align-middle">
                                  <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                  <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>
                              </td>
                            </tr>
                            `
                        })

                        document.querySelector('#tboodyFamily').innerHTML = employeeFamily2;
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }


    updateDeleteSatus(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Empleado/updateDeleteSatus');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);

                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Se guado con exito', 'success');

                        let employee = ''
                        json_app.employee.forEach(element => {
                            employee += `
                        <tr>
                            <td class="align-middle">${element.first_name+' '+element.surname+' '+element.last_name}</td>
                            <td class="text-center align-middle">${element.title==null?'':element.title}</td>
                            <td class="text-center align-middle">${element.date_birth} Años</td>
                            <td class="text-center align-middle">${element.Nombre_Cliente}</td>
                            <td class="text-center align-middle">${element.start_date}</td>
                            <td class="text-center align-middle">${element.modified_at}</td>
                            <td class="text-center align-middle">
                              <a href="<?= base_url ?>empleado/ver&id=${element.id_employee}" target="_blank" class="btn btn-success">
                                <i class="fas fa-eye"></i> Ver
                              </a>
                                <button class="btn btn-danger" value="${element.id_employee}" name="${element.first_name+' '+element.surname+' '+element.last_name}">Borrar</button>
                            </td>
                        </tr>
                            `
                        })

                        document.querySelector('#tb_employees_body').innerHTML = employee;


                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }


    getContactosYRazonesPorCliente(Cliente) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ServicioApoyo/getEjecutivosYRazonesPorCliente');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('Cliente=' + Cliente);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(r);
                    let razones = '';
                    json_app.razones.forEach(razon => {
                        razones +=
                            `<option value="${razon.ID_Razon}">${razon.Nombre_Razon}</option>`;
                    });
                    razones += '<option value="Pendiente">Pendiente</option>';
                    document.querySelector('#select_razon_social').innerHTML = razones;
                }
            }
        }
    }

    getEmailByIdEmployee(id_employee) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../EmpleadoContacto/getEmailsByIdEmployee');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id_employee=' + id_employee);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);

                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {

                        let json_app = JSON.parse(r);
                        let options = '<option value="">Escribir email</option>'

                        if (json_app.email_Employee.email != '') {
                            options += `<option value="${json_app.email_Employee.email}" selected>${json_app.email_Employee.email}</option>`
                        }

                        if (json_app.email_Employee.institutional_email != '') {
                            options += `<option value="${json_app.email_Employee.institutional_email}" selected>${json_app.email_Employee.institutional_email}</option>`
                        }

                        document.querySelector('#email_input').required = false
                        document.querySelector('#email_input').hidden = true

                        document.querySelector('#email_employee').required = true
                        document.querySelector('#email_employee').hidden = false

                        document.querySelector('#email_employee').innerHTML = options;

                        document.querySelector('#email_input').value = ''
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    // utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    let options = '<option value="">Escribir email</option>'
                    document.querySelector('#email_employee').innerHTML = options;

                }

            }
        }
    }

    getAllEmployeeByIdBoss(id_employee) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../empleado/getAllEmployeeByIdBoss');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id_employee=' + id_employee);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0) {
                    let json_app = JSON.parse(r);

                    let employees = ''
                    json_app.employees.forEach(element => {
                        employees += `
                        <option value='${element.id_employee}' >${element.employePosition}</option>
                        `;
                    });

                    document.querySelector('#modal_send_evalaution #select_employee').innerHTML = employees;

                    document.querySelectorAll('#select_employee option').forEach(element => {
                        json_app.employeesBoss.forEach(contact => {
                            if (element.value == contact.id_employee) {
                                element.setAttribute('selected', 'selected');
                            }
                        });
                    })

                }
            }
        }
    }

}
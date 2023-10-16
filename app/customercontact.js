class CustomerContact{

    constructor(){
        this.id_customer = null;
        this.first_name = '';
        this.last_name = '';
        this.position = '';
        this.email = '';
        this.telephone = '';
        this.extension = '';
        this.cellphone = '';
        this.username = '';
        this.password = '';
    }

    getContacts(){
        this.id_customer = document.querySelector('#customer').value;
        let xhr = new XMLHttpRequest();
        let data = `customer=${this.id_customer}`;
        xhr.open('POST', '../ClienteContacto/getContactsByCustomer');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_contacts = JSON.parse(this.responseText);
                    let contacts = '';
                    for (let i in json_contacts){
                        contacts += `<option value="${json_contacts[i].id}">${json_contacts[i].first_name} ${json_contacts[i].last_name}</option>`
                    }
                    document.querySelector("#customer_contact").innerHTML = contacts;
                }
            }
        }
    }

    getTbContacts(){
        this.id_customer = document.querySelector('#id').value;
        let xhr = new XMLHttpRequest();
        let data = `customer=${this.id_customer}`;
        xhr.open('POST', '../ClienteContacto/getContactsByCustomer');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_contacts = JSON.parse(this.responseText);
                    let contacts = '';
                    for (let i in json_contacts){
                        contacts += `<tr>
                                        <td>${json_contacts[i].first_name} ${json_contacts[i].last_name}</td>
                                        <td>${json_contacts[i].position}</td>
                                        <td>${json_contacts[i].email}</td>
                                        <td>${json_contacts[i].telephone}</td>
                                        <td>${json_contacts[i].extension}</td>
                                        <td>${json_contacts[i].cellphone}</td>
                                        <td>${json_contacts[i].username}</td>
                                        <td class="text-right py-0 align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-info">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>`
                    }
                    console.log();
                    document.querySelector("#tb_contacts tbody").innerHTML = contacts;
                }
            }
        }
    }

    save(){
        this.first_name = document.querySelector('#customer-contact-form #first_name').value;
        this.last_name = document.querySelector('#customer-contact-form #last_name').value;
        this.position = document.querySelector('#customer-contact-form #position').value;
        this.email = document.querySelector('#customer-contact-form #email').value;
        this.telephone = document.querySelector('#customer-contact-form #telephone').value;
        this.extension = document.querySelector('#customer-contact-form #extension').value;
        this.cellphone = document.querySelector('#customer-contact-form #cellphone').value;
        this.id_customer = document.querySelector('#customer-contact-form #id_customer').value;

        if (this.first_name.length > 0 && this.last_name.length > 0 && this.email.length > 0 && this.id_customer.length > 0) {
            
            /*let data = `first_name=${this.first_name}&last_name=${this.last_name}&position=${this.position}&email=${this.email}&telephone=${this.telephone}&extension=${this.extension}&cellphone=${this.cellphone}&id_customer=${this.id_customer}`;
            if (document.querySelector('#add_user').value == 1) {
                this.username = document.querySelector('#customer-contact-form #username').value;
                this.password = document.querySelector('#customer-contact-form #password').value;

                data += `&username=${this.username}&password=${this.password}`;
            }*/

            var form = document.querySelector("#customer-contact-form");
            var formData = new FormData(form);
            formData.append('id_customer', this.id_customer);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../ClienteContacto/create');
            //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(formData);

            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    if(r == 0){
                        utils.showToast('Omitiste algún dato','error');
                    } else if(r == 1){
                        utils.showToast('El contacto fue registrado exitosamente', 'success');
                        
                        document.querySelector('#customer-contact-form').reset();

                    }else if (r == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        
                    } else if (r == 3) {
                        utils.showToast('El correo o el usuario ya existe', 'error');

                    }
                }
            }
            
        }else {
            utils.showToast('Completa todos los campos', 'warning');
        }
    }

    update(){
        this.id = document.querySelector('#customer-contact-form #id').value;
        this.first_name = document.querySelector('#customer-contact-form #first_name').value;
        this.last_name = document.querySelector('#customer-contact-form #last_name').value;
        this.position = document.querySelector('#customer-contact-form #position').value;
        this.email = document.querySelector('#customer-contact-form #email').value;
        this.telephone = document.querySelector('#customer-contact-form #telephone').value;
        this.extension = document.querySelector('#customer-contact-form #extension').value;
        this.cellphone = document.querySelector('#customer-contact-form #cellphone').value;
        this.id_customer = document.querySelector('#customer-contact-form #id_customer').value;
        this.id_user = document.querySelector('#customer-contact-form #id_user').value;

        var form = document.querySelector("#customer-contact-form");
        var formData = new FormData(form);
        formData.append('id', this.id);
        formData.append('id_customer', this.id_customer);
        formData.append('id_user', this.id_user);
    
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './update');
        xhr.send(formData);
        xhr.id_customer = this.id_customer;

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');

                } else if(r == 1){
                    utils.showToast('El contacto fue actualizado exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../cliente/ver&id=${xhr.id_customer}`;
                    }, 3000);
                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }else if(r == 3){
                    utils.showToast('El usuario o la dirección de correo electrónico ya existe.', 'error');
                }else if (r == 4){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    
                }
            }
        }
            
    }  
    
	

    ///////////////////////////////////////// INICIO GABOOO[MARZO 4]  ///////////////////////////////////////////////////////
    getContacto(ID) { //gabo
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_contacto_reclu');

        xhr.open('POST', '../ClienteContacto/getContacto');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                let json_app = JSON.parse(r);
                try {
                    if (json_app.status == 1) {
                        form.querySelector('[name="id_user"]').value = json_app.contacto.id_user;
                        form.querySelector('[name="id_contact"]').value = json_app.contacto.id;
                        form.querySelector('[name="first_name"]').value = json_app.contacto.first_name;
                        form.querySelector('[name="last_name"]').value = json_app.contacto.last_name;
                        form.querySelector('[name="position"]').value = json_app.contacto.position;
                        form.querySelector('[name="email"]').value = json_app.contacto.email;
                        form.querySelector('[name="telephone"]').value = json_app.contacto.telephone;
                        form.querySelector('[name="extension"]').value = json_app.contacto.extension;

                        let cumple = json_app.contacto.birthday.split('/');
                        form.querySelectorAll('select')[0].value = Number(cumple[0]);
                        form.querySelectorAll('select')[1].value = Number(cumple[1]);
                        form.querySelector('[name="cellphone"]').value = json_app.contacto.cellphone;
                        form.querySelector('[name="username"]').value = json_app.contacto.username;
                        form.querySelector('[name="password"]').value = json_app.contacto.password;
                        form.querySelector('[name="id_customer"]').value = json_app.contacto.id_customer;
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió malll. Inténtalo de nuevo', 'error');
                }

            }
        }
    }


    deleteContacto_modal(ID) { //gabo 24/feb
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal_delete_contacto2');
        document.querySelectorAll('#modal_delete_contacto2 form .btn')[1].disabled = false;
        xhr.open('POST', '../ClienteContacto/getContacto');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        document.querySelector('#modal_delete_contacto2 [name="id"]').value = json_app.contacto.id;
                        document.querySelector('#modal_delete_contacto2 [name="username"]').value = json_app.contacto.username;
                        document.querySelector('#modal_delete_contacto2 [name="id_customer"]').value = json_app.contacto.id_customer;
                        form.querySelector('p').textContent = "¿Estás seguro de que deseas eliminar el usuario de " + json_app.contacto.first_name + " " + json_app.contacto.last_name + "?";
                    } else
                        form.querySelectorAll('input')[0].value = 0;
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
            }
        }
    }




   


    save_modal() { //gabo 23 feb
        var form = document.querySelector("#contacto-reclu-form");
        var formData = new FormData(form);
        form.querySelector("[name='submit']").disabled = true
        formData.append('id_customer', this.id_customer);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ClienteContacto/create_gabotest');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                        form.querySelector("[name='submit']").disabled = false
                    } else if (json_app.status == 1) {
                        let contactos = ";"
                        let json_app = JSON.parse(r);
                        console.log(r);

                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                            <td> ${element.first_name + " " + element.last_name}</td>
                            <td> ${element.position}</td>
                            <td> ${element.email}</td>
                            <td> ${element.telephone}</td>
                            <td> ${element.extension}</td>
                            <td> ${element.cellphone}</td>
                            <td> ${element.birthday}</td>
                            <td> ${element.username}</td>
                            <td class="text-center py-0 align-middle">
                            <a href="${element.url_editar_contacto}" class="btn btn-info">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button class="btn btn-danger" data-id="${element.idE}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <button class="btn btn-info btn-modal" data-id="${element.idE}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                
                          </div>
                        </td>
                        </tr>`
                        });
                        form.querySelector("[name='submit']").disabled = false
                        document.querySelector("#tb_contacts tbody").innerHTML = contactos;
                        $('#modal_contacto_reclu').modal('hide');
                        document.querySelector("#contacto-reclu-form #submit").disabled = false;
                        utils.showToast('El contacto fue registrado exitosamente', 'success');
                        form.reset();
                        //  document.querySelector('#customer-contact-form').reset();
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelector("[name='submit']").disabled = false

                    } else if (json_app.status == 3) {
                        utils.showToast(' El Usuario ó Email ya existe', 'error');
                        form.querySelector("[name='submit']").disabled = false
                    } else if (json_app.status == 3) {
                        utils.showToast('Ya existe el contacto', 'error');
                        form.querySelector("[name='submit']").disabled = false
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    form.querySelector("[name='submit']").disabled = false

                }
            }

        }

    }


    update_modal() { //gabo 24/feb
        var form = document.querySelector("#contacto-reclu-form");
        var formData = new FormData(form);
        form.querySelector('[name="submit"]').disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ClienteContacto/update_modal');
        xhr.send(formData);
        xhr.id_customer = this.id_customer;

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        let contactos = '';
                        json_app.contactos.forEach(element => {


                            contactos += `
                        <tr>
                            <td> ${element.first_name + " " + element.last_name}</td>
                            <td> ${element.position}</td>
                            <td> ${element.email}</td>
                            <td> ${element.telephone}</td>
                            <td> ${element.extension}</td>
                            <td> ${element.cellphone}</td>
                            <td> ${element.birthday}</td>
                            <td> ${element.username}</td>
                            <td class="text-center py-0 align-middle">
                            <div class="btn-group btn-group-sm">
							
							 <button class="btn btn-warning" data-id="${element.username}" data-nombre="${element.first_name} ${element.last_name}">
                            <i class="fas fa-envelope"></i>
                        </button>

                            <button class="btn btn-info btn-modal" data-id="${element.idE}">
                            <i class="fas fa-pencil-alt"></i>
                            </button> 
                            <button class="btn btn-danger" data-id="${element.idE}">
                                <i class="fas fa-trash"></i>
                            </button>
                             </div>
                            </td>
                        </tr>`
                        });

                        document.querySelector('#tb_contacts tbody').innerHTML = contactos;

                        $('#modal_contacto_reclu').modal('hide');
                        utils.showToast('El contacto fue actualizado exitosamente', 'success');
                        form.querySelector('[name="submit"]').disabled = false;
                    } else if (json_app.status == 2) {
                        utils.showToast('No se pudo actualizar el contacto. Inténtalo de nuevo', 'error');
                        form.querySelector('[name="submit"]').disabled = false;
                    } else if (json_app.status == 3) {
                        utils.showToast('El usuario o la dirección de correo electrónico ya existe.', 'error');
                        form.querySelector('[name="submit"]').disabled = false;
                    } else if (json_app.status == 4) {
                        utils.showToast('No se pudo actualizar el usuario. Inténtalo de nuevo', 'error');
                        form.querySelector('[name="submit"]').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    form.querySelector('[name="submit"]').disabled = false;
                }
            }

        }
    }


    delete_contacto_modal() { //gabo 27/feb
        var form = document.querySelector("#modal_delete_contacto2 form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ClienteContacto/delete_modal');
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
                        let contactos = '';
                        json_app.contactos.forEach(element => {

                            contactos += `
                            <tr>
                                <td> ${element.first_name + " " + element.last_name}</td>
                                <td> ${element.position}</td>
                                <td> ${element.email}</td>
                                <td> ${element.telephone}</td>
                                <td> ${element.extension}</td>
                                <td> ${element.cellphone}</td>
                                <td> ${element.birthday}</td>
                                <td> ${element.username}</td>
                                <td class="text-center py-0 align-middle">
                                <div class="btn-group btn-group-sm">
								
								 <button class="btn btn-warning" data-id="${element.username}" data-nombre="${element.first_name} ${element.last_name}">
                            <i class="fas fa-envelope"></i>
                        </button>

                                <button class="btn btn-info btn-modal" data-id="${element.idE}">
                                <i class="fas fa-pencil-alt"></i>
                                </button> 
                                <button class="btn btn-danger" data-id="${element.idE}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                 </div>
                                </td>
                            </tr>`
                            });

                        document.querySelector('#tb_contacts tbody').innerHTML = contactos;
                        utils.showToast('El contacto fue eliminado exitosamente', 'success');
                        $('#modal_delete_contacto2').modal('hide');
                        form.querySelectorAll('.btn')[1].disabled = false;
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

    duplicate_Contact() { //  01/marzo 2023 duplicar a sa
        var form = document.querySelector("#modal_contacto_reclu form");
        var formData = new FormData(form);
        form.querySelectorAll('.bn_duplicate').disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../ClienteContacto/duplicate_Contact');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);

                    if (json_app.status == 1) {
                        utils.showToast('Contacto Duplicado', 'success');
                        $('#modal_contacto_reclu').modal('hide');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    } else if (json_app.status == 2) {
                        utils.showToast('El usuario ya existe', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    } else if (json_app.status == 3) {
                        utils.showToast('El usuario no existe', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    } else if (json_app.status == 4) {
                        utils.showToast('Completa todos los campos', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    } else {
                        utils.showToast('Error', 'error');
                        form.querySelectorAll('.bn_duplicate').disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Error', 'error');
                    form.querySelectorAll('.bn_duplicate').disabled = false;
                }
            }
        }
    }


    ///////////////////////////////////////// FIN GABOOO  ///////////////////////////////////////////////////////
}
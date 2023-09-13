class User {

    constructor() {
        this.id = null;
        this.username = '';
        this.first_name = '';
        this.last_name = '';
        this.email = '';
        this.id_role = null;
    }

    checkUsername() {
        document.querySelector('#user_exists').style.display = 'block';
        this.username = document.querySelector('#username').value;
        if (this.username.length > 0) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../usuario/user_exists');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('username=' + this.username);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let user_exists = xhr.responseText;
                    if (user_exists == 1) {
                        document.querySelector('#user_exists').innerHTML = "<p class='text-danger'>Usuario no disponible.</p>";
                        //$("#user_exists").html("<div class='alert alert-danger'>Usuario not available.</div>");
                    } else {
                        document.querySelector('#user_exists').innerHTML = "<p class='text-success'>Usuario disponible.</p>";
                        //$("#user_exists").html("<div class='alert alert-success'>Usuario available.</div>");
                    }
                }
            }
        } else {
            document.querySelector('#user_exists').style.display = 'none';
        }
    }

    checkEmail() {
        document.querySelector('#email_exists').style.display = 'block';
        this.email = document.querySelector('#email').value;
        if (this.email.length > 0) {
            if (utils.isEmail(this.email)) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../usuario/email_exists');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('email=' + this.email);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let email_exists = xhr.responseText;
                        if (email_exists == 1) {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>La dirección de correo ya ha sido registrada anteriormente</p>";
                        } else {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-success'>Correo aceptado.</p>";
                        }
                    }
                }
            } else {
                document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>No es un correo</p>";
            }

        } else {
            document.querySelector('#email_exists').style.display = 'none';
        }
    }

    confirmPassword() {
        document.querySelector('#div_confirm_pass').style.display = 'block';
        this.password = document.querySelector('#register-user-form #password').value;
        this.password_confirm = document.querySelector('#register-user-form #password_confirm').value;
        if (this.password > 0 && this.password_confirm > 0) {
            if (this.password != this.password_confirm) {
                document.querySelector('#div_confirm_pass').innerHTML = "<p class='text-danger'>Las contraseñas no coinciden</p>";
            } else {
                document.querySelector('#div_confirm_pass').innerHTML = "<p class='text-success'>Las contraseñas coinciden</p>";
            }
        } else {
            document.querySelector('#div_confirm_pass').style.display = 'none';
        }
    }


    save() {
        this.first_name = document.querySelector('#register-user-form #first_name').value;
        this.last_name = document.querySelector('#register-user-form #last_name').value;
        this.username = document.querySelector('#register-user-form #username').value;
        this.password = document.querySelector('#register-user-form #password').value;
        this.password_confirm = document.querySelector('#register-user-form #password_confirm').value;
        this.email = document.querySelector('#register-user-form #email').value;
        this.id_user_type = document.querySelector('#register-user-form #id_user_type').value;

        if (this.first_name.length > 0 && this.last_name.length > 0 && this.username.length > 0 && this.password.length > 0 && this.password_confirm.length > 0 && this.email.length > 0 && this.id_user_type.length > 0) {
            if (this.password == this.password_confirm) {
                let data = `first_name=${this.first_name}&last_name=${this.last_name}&username=${this.username}&password=${this.password}&password_confirm=${this.password_confirm}&email=${this.email}&id_user_type=${this.id_user_type}`;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './save');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        if (r == 0) {
                            utils.showToast('Omitiste algún dato', 'error');
                        } else if (r == 1) {
                            utils.showToast('El usuario fue registrado exitosamente', 'success');

                            document.querySelector('#register-user-form').reset();
                            document.querySelector('#user_exists').style.display = 'none';
                            document.querySelector('#email_exists').style.display = 'none';
                            document.querySelector('#div_confirm_pass').style.display = 'none';

                        } else if (r == 2) {
                            utils.showToast('Las contraseñas no coinciden', 'warning');
                        } else if (r == 3) {
                            utils.showToast('El usuario o la dirección de correo electrónico ya existía', 'error');
                        } else if (r == 4) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');

                        }
                    }
                }
            } else {
                utils.showToast("Las contraseñas no coinciden", "warning");
            }
        } else {
            utils.showToast('Completa todos los campos', 'warning');
        }
    }



    getUser(id) {
        var form = document.querySelector("#modal-update-user form");
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../usuario/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);

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

                        document.querySelector('#modal-update-user [name="username"]').value = json_app.user.username
                        document.querySelector('#modal-update-user [name="first_name"]').value = json_app.user.first_name
                        document.querySelector('#modal-update-user [name="last_name"]').value = json_app.user.last_name
                        document.querySelector('#modal-update-user [name="email"]').value = json_app.user.email
                        document.querySelector('#modal-update-user [name="password"]').value = json_app.user.password
                        document.querySelector('#modal-update-user [name="id_user_type"]').value = json_app.user.id_user_type
                        document.querySelector('#modal-update-user [name="id"]').value = json_app.user.id
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[0].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else if (json_app.status == 3) {
                        utils.showToast('La fecha inicial es mayor que la final.', 'error');
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


    //===[gabo 4 agosto usuarios ]===
    updateUser() {
        var form = document.querySelector("#modal-update-user form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../usuario/updateUser');
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

                        utils.destruir_datatable('#tb_users', '#tb_users tbody', User.tabla_formato(json_app.usuarios, 1));

                        utils.showToast('Se guardó con éxito', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        //===[4 agosto usuarios ]===
                        $('#modal-update-user').modal('hide');
                        //===[4 agosto usuarios fin]===
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }

            }
        }
    }


    static tabla_formato(array, tabla) {
        let usuarios = '';
        let cont = array.length;
        array.forEach(usuario => {

            if (tabla == 1) { //tabla activos
                usuarios += `
                                   <tr>
                            <td class="image"><img class="img-circle img-fluid img-responsive elevation-2"
                                src="${usuario.avatar}" style="width:60px; height:auto;"></td>
                            <td>${usuario.username}</td>
                            <td>${usuario.first_name} ${usuario.last_name}</td>
                            <td>${usuario.password}</td>
                            <td>${usuario.email}</td>
                            <td>${usuario.last_session}</td>
                            <td>${usuario.user_type}</td>
                            <td style="display:flex;text-align:center">
                                    <button class="btn btn-info" value="${usuario.id}"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger" value="${usuario.id}"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>`;
                cont--;
            } else {  //tabla inactivos
                usuarios += `
                        <tr>
                            <td class="image"><img class="img-circle img-fluid img-responsive elevation-2"
                                src="${usuario.avatar}" style="width:60px; height:auto;"></td>
                            <td>${usuario.username}</td>
                            <td>${usuario.first_name} ${usuario.last_name}</td>
                            <td>${usuario.password}</td>
                            <td>${usuario.email}</td>
                            <td>${usuario.last_session}</td>
                            <td>${usuario.user_type}</td>
                            <td style="display:flex;text-align:center">
                                    <button class="btn btn-success" value="${usuario.id}"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>`;
                cont--;

            }

        });


        return usuarios;
    }


    activate_user(id_user) {
        var formData = new FormData();
        formData.append('id_user', id_user);
        fetch('../usuario/activate_user', {
            method: 'POST',
            body: formData
        })

            .then(response => {
                // console.log(response.json());
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
                        utils.destruir_datatable('#tb_users', '#tb_users tbody', User.tabla_formato(json_app.usuarios, 1));
                        utils.destruir_datatable('#tb_users_inactive', '#tb_users_inactive tbody', User.tabla_formato(json_app.usuarios_inactivos, 0));
                        utils.showToast('EL usuario se ha activado correctamente', 'success');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                document.querySelector("#profile-candidate-form [name='submit']").disabled = false
            });
    }

    //===[gabo 4 agosto usuarios fin]===
	 checkUsernameWithInfo() {
        var formData = new FormData();
        let username = document.querySelector('#username').value;
        formData.append('username', username);
        fetch('../usuario/getOneByUsername', {
            method: 'POST',
            body: formData
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
                    document.querySelector('#user_exists').style.display = 'block';
                    if (json_app.status == 1) {

                        let tr = `
                            <div class="table-responsive" style="margin-top:1rem">
                            <p class='text-danger'>  Este usuario no esta disponible</p>
                            <table class="table table-bordered table-responsive-sm">
                                <thead class="bg-warning">
                                    <tr>
                                        <th style="padding-top:0.25rem;">Nombre</th>
                                        <th style="padding-top:0.25rem;">Usuario</th>
                                        <th style="padding-top:0.25rem;">Correo</th>
                                        <th style="padding-top:0.25rem;">Empresa/Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding-top:0.25rem;">${json_app.user.first_name} ${json_app.user.last_name}</td>
                                        <td style="padding-top:0.25rem;">${json_app.user.username}</td>
                                        <td style="padding-top:0.25rem;">${json_app.user.email} </td>
                                        <td style="padding-top:0.25rem;">`;
                        (typeof json_app.info.Nombre_Empresa != 'undefined' && typeof json_app.info.Nombre_Empresa != 'null') ? tr += ` ${json_app.info.Nombre_Empresa}` : '';
                        (typeof json_app.info.Nombre_Cliente != 'undefined' && typeof json_app.info.Nombre_Cliente != 'null') ? tr += `/ ${json_app.info.Nombre_Cliente}` : '';
                        tr += `</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>`;

                        document.querySelector('#user_exists').innerHTML = tr;


                    } else {
                        document.querySelector('#user_exists').innerHTML = "<p class='text-success'>Usuario disponible.</p>";
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }

    checkEmailWithInfo() {
        var formData = new FormData();
        let email = document.querySelector('#email').value;
        formData.append('email', email);
        fetch('../usuario/getOneByEmail', {
            method: 'POST',
            body: formData
        })

            .then(response => {
                // console.log(response.json());
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                document.querySelector('#email_exists').style.display = 'block';
                try {

                    const json_app = JSON.parse(r);

                    if (json_app.status == 1) {
                        let tr = `
                        <div class="table-responsive" style="margin-top:1rem;">
                        <p class='text-danger'>  Este usuario no esta disponible</p>
                        <table class="table table-bordered table-responsive-sm">
                            <thead class="bg-warning">
                                <tr >
                                    <th style="padding-top:0.25rem;vertical-align:center">Nombre</th>
                                    <th style="padding-top:0.25rem;vertical-align:center">Usuario</th>
                                    <th style="padding-top:0.25rem;vertical-align:center">Correo</th>
                                    <th style="padding-top:0.25rem;vertical-align:center">Empresa/Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding-top:0.25rem;vertical-align:center">${json_app.user.first_name} ${json_app.user.last_name}</td>
                                    <td style="padding-top:0.25rem;vertical-align:center">${json_app.user.username}</td>
                                    <td style="padding-top:0.25rem;vertical-align:center">${json_app.user.email} </td>
                                    <td style="padding-top:0.25rem;vertical-align:center">`;
                        (typeof json_app.info.Nombre_Empresa != 'undefined' && typeof json_app.info.Nombre_Empresa != 'null') ? tr += ` ${json_app.info.Nombre_Empresa}` : '';
                        (typeof json_app.info.Nombre_Cliente != 'undefined' && typeof json_app.info.Nombre_Cliente != 'null') ? tr += `/ ${json_app.info.Nombre_Cliente}` : '';
                        tr += `</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`;

                        document.querySelector('#email_exists').innerHTML = tr;


                    } else {
                        document.querySelector('#email_exists').innerHTML = "<p class='text-success'>Correo disponible.</p>";
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
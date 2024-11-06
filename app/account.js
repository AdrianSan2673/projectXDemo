class Account {
    constructor() {
        this.username = '';
        this.password = '';
        this.password_confirm = '';
    }

    login() {
        this.username = document.querySelector('#login-form #username').value;
        this.password = document.querySelector('#login-form #password').value;
        //let login_url = window.location.href.substr(window.location.href.length - 13) === 'usuario/index' ? './login' : 'usuario/login';
        let login_url = './login';
        if (this.username.length > 0 && this.password.length > 0) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', login_url);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`username=${this.username}&password=${this.password}`);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let login = xhr.responseText;
                    console.log(login);
                    if (login == 0) {
                        $('#modal-login').modal('show');
                    } else {
                        window.location.reload();
                    }
                }
            }
        }
    }

    //===[gabo 7 julio  user_rh]===
    login_rh() {
        this.username = document.querySelector('#login_rh-form #username').value;
        this.password = document.querySelector('#login_rh-form #password').value;
        //let login_url = window.location.href.substr(window.location.href.length - 13) === 'usuario/index' ? './login' : 'usuario/login';
        let login_url = './login_rh';
        if (this.username.length > 0 && this.password.length > 0) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', login_url);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`username=${this.username}&password=${this.password}`);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let login = xhr.responseText;

                    console.log(login);
                    if (login == 0) {
                        $('#modal-login').modal('show');
                    } else {
                        window.location.reload();
                    }
                }
            }
        }
    }
    //===[gabo 26 junio  user_rh fin]===

    logout() {
        window.location = './logout';
    }

    checkEmail() {
        document.querySelector('#email_exists').style.display = 'block';
        this.email = document.querySelector('#email').value;
        if (this.email.length > 0) {
            if (utils.isEmail(this.email)) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './email_exists');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('email=' + this.email);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let email_exists = xhr.responseText;
                        if (email_exists == 1) {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-success'>Correo electrónico aceptado</p>";
                            document.querySelector('#recover_submit').disabled = false;
                        } else {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>Correo electrónico no registrado en el sistema</p>";
                            document.querySelector('#recover_submit').disabled = true;
                        }
                    }
                }
            } else {
                document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>No es un correo electrónico</p>";
            }

        } else {
            document.querySelector('#email_exists').style.display = 'none';
        }
    }

    recoverSubmit() {
        document.querySelector('#recover_submit').disabled = true;
        let email = document.querySelector('#recover-form #email').value;
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './recover');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('email=' + email);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let res = xhr.responseText;
                if (res == 1) {
                    utils.showToast('Enviamos un código de recuperación de contraseña a su dirección de correo electrónico', 'success');
                } else {
                    utils.showToast('Error al enviar correo', 'error');
                    document.querySelector('#recover_submit').disabled = false;
                }
            }
        }
    }

    submitNewPassword() {
        document.querySelector('#new_password_submit').disabled = true;
        let new_password = document.querySelector('#new_password').value;
        let confirm_new_password = document.querySelector('#confirm_new_password').value;
        let id = document.querySelector('#id').value;
        let token = document.querySelector('#token').value;
        if (new_password.length > 0 && confirm_new_password.length > 0) {
            if (new_password != confirm_new_password) {
                utils.showToast('Las contraseñas no coinciden', 'error');
                document.querySelector('#new_password_submit').disabled = true;
            } else {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './new_password');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(`new_password=${new_password}&confirm_new_password=${confirm_new_password}&id=${id}&token=${token}`);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        utils.showToast('Su contraseña fue actualizada exitosamente', 'success');
                        setTimeout("location.href='./index'", 3000);
                    }
                }
            }
        }
    }

    confirmNewPassword() {
        document.querySelector('#div_confirm_pass').style.display = 'block';
        let new_password = document.querySelector('#new_password').value;
        let confirm_new_password = document.querySelector('#confirm_new_password').value;
        if (new_password.length > 0 && confirm_new_password.length > 0) {
            if (new_password != confirm_new_password) {
                document.querySelector('#div_confirm_pass').innerHTML = "<p>Las contraseñas no coinciden<p/>";
                document.querySelector('#new_password_submit').disabled = true;
            } else {
                document.querySelector('#div_confirm_pass').innerHTML = "";
                document.querySelector('#new_password_submit').disabled = false;
            }
        } else {
            document.querySelector('#div_confirm_pass').style.display = 'none';
        }
    }

    create() {
        this.username = document.querySelector('#create_candidate_form #username').value;
        this.email = document.querySelector('#create_candidate_form #email').value;
        this.password = document.querySelector('#create_candidate_form #password').value;
        this.confirm_password = document.querySelector('#create_candidate_form #confirm_password').value;
        if (this.username.length > 0 && this.password.length > 0) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', './create');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`username=${this.username}&email=${this.email}&password=${this.password}&confirm_password=${this.confirm_password}`);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let login = xhr.responseText;
                    if (login == 0) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Falta algún dato!";
                        document.querySelector("#create_candidate_form").disabled = false;
                    } else if (login == 2) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Las contraseñas no coinciden!";
                        document.querySelector("#create_candidate_form").disabled = false;
                    } else if (login == 3) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡El nombre de usuario o la dirección de correo electrónico ya está registrado!";
                        document.querySelector("#create_candidate_form").disabled = false;
                    } else if (login == 4) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Algo salió mal!";
                        document.querySelector("#create_candidate_form").disabled = false;
                    } else {
                        utils.showToast('Gracias por registrarte en RRHH Ingenia. Ingresa a tu correo para activar tu cuenta', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 4000);
                    }
                }
            }
        }
    }

    register() {
        this.day = document.querySelector('#create_candidate_form #day').value;
        this.month = document.querySelector('#create_candidate_form #month').value;
        this.year = document.querySelector('#create_candidate_form #year').value;

        this.day = parseInt(this.day);
        this.month = parseInt(this.month);
        this.year = parseInt(this.year);

        //this.gender = document.querySelector('#create_candidate_form input[name="gender"]:checked');
        this.state = document.querySelector('#create_candidate_form #state').value;
        this.state = parseInt(this.state);

        if (!isNaN(this.day) && !isNaN(this.month) && !isNaN(this.year) && !isNaN(this.state)) {
            var form = document.querySelector("#create_candidate_form");
            var formData = new FormData(form);

            let xhr = new XMLHttpRequest();
            xhr.open('POST', './register');
            xhr.send(formData);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let login = xhr.responseText;
                    console.log(login);
                    if (login == 0) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Falta algún dato!";
                        document.querySelector("#submit").disabled = false;
                    } else if (login == 2) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Algo ocurrió! Inténtalo de nuevo";
                        document.querySelector("#submit").disabled = false;
                    } else if (login == 3) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡El nombre de usuario o la dirección de correo electrónico ya está registrado!";
                        document.querySelector("#submit").disabled = false;
                    } else if (login == 4) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡El archivo de tu cv excede el peso permitido o tiene un formato no admitido!";
                        document.querySelector("#submit").disabled = false;
                    } else if (login == 1) {
                        $('#modal-login').modal('show');
                        document.querySelector('#modal-login .modal-title').innerHTML = "Cuenta registrada exitosamente";
                        document.querySelector('#modal-login .modal-body p').innerHTML = "¡Gracias por registrarte en RRHH Ingenia!. Revisa tu bandeja de entrada o spam, recibirás un mensaje de verificación de correo electrónico.";
                        if (document.querySelector("#id_vacancy").value != '') {
                            document.querySelector("#login").href = 'http://' + location.hostname + '/usuario/index';
                        }
                    } else {
                        document.querySelector("#submit").disabled = false;
                    }
                }
            }
        } else {
            document.querySelector("#submit").disabled = false;
            if (isNaN(this.state)) {
                utils.showToast('Indica el estado donde resides', 'warning');
            }
            if (isNaN(this.day) || isNaN(this.month) || isNaN(this.year)) {
                utils.showToast('Completa tu fecha de nacimiento', 'warning');
            }
        }


    }

    change_password() {
        this.password = document.querySelector('#form-password #password').value;
        this.new_password = document.querySelector('#form-password #new_password').value;
        this.confirm_new_password = document.querySelector("#form-password #confirm_new_password").value;

        if (this.password.length > 0 && this.new_password.length > 0 && this.confirm_new_password.length > 0) {
            if (this.new_password == this.confirm_new_password) {
                let data = `password=${this.password}&new_password=${this.new_password}&confirm_new_password=${this.confirm_new_password}`;
                let xhr = new XMLHttpRequest();
                xhr.open('POST', './change_password');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        if (r == 0) {
                            utils.showToast('Omitiste algún dato', 'error');
                        } else if (r == 1) {
                            utils.showToast('Su contraseña ha sido cambiada', 'success');
                            document.querySelector("#form-password").reset();

                        } else if (r == 2) {
                            utils.showToast('Las contraseñas no coinciden', 'warning');
                        } else if (r == 3) {
                            utils.showToast('Contraseña anterior incorrecta', 'error');
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

    dark_mode(mode) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../usuario/dark_mode');
        let data = `mode=${mode}`;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
    }
}


var recover = {
    checkEmail: function () {
        $("#email_exists").show();
        let email = $("#email_recover").val();
        if (email.length > 0) {
            if (utils.isEmail(email)) {
                $.ajax({
                    type: "POST",
                    url: "./email_exists",
                    data: "email=" + email,
                    success: function (r) {
                        let email_exists = r;
                        $("#email_exists").attr("disabled", false);
                        if (email_exists == 1) {
                            $("#email_exists").html("<pre class='alert alert-success'>Existing email.</pre>");
                            $("#recover_submit").attr("disabled", false);
                        } else {
                            $("#email_exists").html("<pre class='alert alert-danger'>Email is not registered in the system.</pre>");
                            $("#recover_submit").attr("disabled", true);
                        }
                    }
                })
            } else {
                $("#email_exists").html("<pre class='alert alert-danger'>It is not an email.</pre>");
            }

        } else {
            $("#email_exists").hide();
        }
    },
    submit: function () {
        $("#recover_submit").attr("disabled", true);
        let email = $("#email_recover").val();
        $.ajax({
            type: "POST",
            url: "./recover",
            data: "email=" + email,
            success: function (r) {
                if (r == 1) {
                    utils.showMessage('top', 'center', "We send the password recovery code to your email address. Check your inbox or spam.", "success");
                } else {
                    utils.showMessage('top', 'center', 'Error to send email', 'danger');
                }
            }
        });
    },
    submitNewPassword: function () {
        $("#new_password_submit").attr("disabled", true);
        let new_password = $("#new_password").val();
        let confirm_new_password = $("#confirm_new_password").val();
        let id = $("#id").val();
        let token = $("#token").val();
        let data = new Array();
        if (new_password.length > 0 && confirm_new_password.length > 0) {
            if (new_password != confirm_new_password) {
                utils.showMessage('top', 'center', "Passwords do not match", 'danger');
                $("#new_password_submit").attr("disabled", true);
            } else {
                /* $("#div_confirm_pass").html("<div class='alert alert-success'>Las contraseñas coinciden</div>");
                $("#new_password_submit").attr("disabled", false); */
                data = {
                    new_password: new_password,
                    confirm_new_password: confirm_new_password,
                    id: id,
                    token: token
                };
                $.ajax({
                    url: "./new_password",
                    type: "POST",
                    data: data
                }).done(() => {
                    utils.showMessage('top', 'center', "Password changed successfully.", "success");
                    setTimeout("location.href='./index'", 3000);
                })
            }
        }
    },
    confirmNewPassword: function () {
        $("#div_confirm_pass").show();
        let new_password = $("#new_password").val();
        let confirm_new_password = $("#confirm_new_password").val();
        if (new_password.length > 0 && confirm_new_password.length > 0) {
            if (new_password != confirm_new_password) {
                $("#div_confirm_pass").html("<pre class='alert alert-danger'>Passwords do not match.</pre>");
                $("#new_password_submit").attr("disabled", true);
            } else {
                $("#div_confirm_pass").html("<pre class='alert alert-success'>Passwords match.</pre>");
                $("#new_password_submit").attr("disabled", false);
            }
        } else {
            $("#div_confirm_pass").hide();
        }
    }
};
function getNotifications() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../notifications/getNotificacionsByUser", true);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            try {
                var notifications = JSON.parse(this.responseText);
                if (notifications) {
                    if (notifications.activation == 1) {
                        if (notifications.new > 0) {
                            document.querySelector('#notifications-content span').textContent = notifications.new;
                            document.querySelector('#notifications-content .dropdown-header').textContent = notifications.new + ' notificaciones';
                        } else {
                            document.querySelector('#notifications-content span').textContent = '';
                            document.querySelector('#notifications-content .dropdown-header').textContent = 'Sin notificaciones';
                        }

                        if (notifications.notifications.length > 0) {
                            let notificaciones = '';
                            for (let i in notifications.notifications) {
                                notificaciones +=
                                    `<a href="${notifications.notifications[i].url}" data-id="${notifications.notifications[i].id}" class="dropdown-item" style="white-space: normal !important; ${notifications.notifications[i].status <= 3 ? 'background: rgb(112 181 249 / 20%);' : ''}">
                                    <div class="media">
                                        <img src="../dist/img/isotipo-colores.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <i class="${notifications.notifications[i].icon} position-absolute top-0 end-0"></i>
                                        <div class="media-body">
                                        <p>${notifications.notifications[i].message}</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${notifications.notifications[i].time_ago}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>`
                                if (notifications.notifications[i].status == 1) {
                                    var notification = new Notification(notifications.notifications[i].description, {
                                        body: notifications.notifications[i].message,
                                        icon: "../dist/img/isotipo-colores.png"
                                    });
                                }
                            }
                            document.querySelector('#notifications-content .dropdown-menu .notifications-list').innerHTML = notificaciones;
                        }
                    } else
                        window.location.reload();
                }
            } catch (error) {

            }

        }
    };
    xhr.send();
}

function checkedNotifications(event) {
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../notifications/checked", true);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            try {
                var notifications = JSON.parse(this.responseText);
                if (notifications.new > 0) {
                    document.querySelector('#notifications-content span').textContent = notifications.new;
                    document.querySelector('#notifications-content .dropdown-header').textContent = notifications.new + ' notificaciones';
                } else {
                    document.querySelector('#notifications-content span').textContent = '';
                    document.querySelector('#notifications-content .dropdown-header').textContent = 'Sin notificaciones';
                }

                if (notifications.notifications.length > 0) {
                    let notificaciones = '';
                    for (let i in notifications.notifications) {
                        notificaciones +=
                            `<a href="${notifications.notifications[i].url}" data-id="${notifications.notifications[i].id}" class="dropdown-item" style="white-space: normal !important; ${notifications.notifications[i].status <= 3 ? 'background: rgb(112 181 249 / 20%);' : ''}">
                            <div class="media">
                                <img src="../dist/img/isotipo-colores.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <i class="${notifications.notifications[i].icon} position-absolute top-0 end-0"></i>
                                <div class="media-body">
                                <p>${notifications.notifications[i].message}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${notifications.notifications[i].time_ago}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>`
                        if (notifications.notifications[i].status == 1) {
                            var notification = new Notification(notifications.notifications[i].description, {
                                body: notifications.notifications[i].message,
                                icon: "../dist/img/isotipo-colores.png"
                            });
                        }
                    }
                    document.querySelector('#notifications-content .dropdown-menu .notifications-list').innerHTML = notificaciones;
                }
            } catch (error) {

            }

        }
    };
    xhr.send();
}

function clickedNotification(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../notifications/clicked", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id);
    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            try {
                var notifications = JSON.parse(this.responseText);
                if (notifications.new > 0) {
                    document.querySelector('#notifications-content span').textContent = notifications.new;
                    document.querySelector('#notifications-content .dropdown-header').textContent = notifications.new + ' notificaciones';
                } else {
                    document.querySelector('#notifications-content span').textContent = '';
                    document.querySelector('#notifications-content .dropdown-header').textContent = 'Sin notificaciones';
                }

                if (notifications.notifications.length > 0) {
                    let notificaciones = '';
                    for (let i in notifications.notifications) {
                        notificaciones +=
                            `<a href="${notifications.notifications[i].url}" data-id="${notifications.notifications[i].id}" class="dropdown-item" style="white-space: normal !important; ${notifications.notifications[i].status <= 3 ? 'background: rgb(112 181 249 / 20%);' : ''}">
                            <div class="media">
                                <img src="../dist/img/isotipo-colores.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <i class="${notifications.notifications[i].icon} position-absolute top-0 end-0"></i>
                                <div class="media-body">
                                <p>${notifications.notifications[i].message}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${notifications.notifications[i].time_ago}</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>`
                        if (notifications.notifications[i].status == 1) {
                            var notification = new Notification(notifications.notifications[i].description, {
                                body: notifications.notifications[i].message,
                                icon: "../dist/img/isotipo-colores.png"
                            });
                        }
                    }
                    document.querySelector('#notifications-content .dropdown-menu .notifications-list').innerHTML = notificaciones;
                }
            } catch (error) {

            }

        }
    };
}

Notification.requestPermission().then(function (permission) {
    console.log(permission);
});
document.addEventListener('DOMContentLoaded', e => {
    getNotifications();
    if (!!document.querySelector('.notifications-list')) {
        document.querySelector('.notifications-list').addEventListener('click', e => {
            e.preventDefault();
            console.log(e.target)
            if (e.target.classList.contains('dropdown-item') || e.target.parentElement.classList.contains('dropdown-item') || e.target.parentElement.parentElement.classList.contains('dropdown-item') || e.target.parentElement.parentElement.parentElement.classList.contains('dropdown-item') || e.target.parentElement.parentElement.parentElement.parentElement.classList.contains('dropdown-item')) {
                let id;
                let url;
                if (e.target.classList.contains('dropdown-item')) {
                    id = e.target.dataset.id;
                    url = e.target.href;
                } else if (e.target.parentElement.classList.contains('dropdown-item')) {
                    id = e.target.parentElement.dataset.id;
                    url = e.target.parentElement.href;
                }
                else if (e.target.parentElement.parentElement.classList.contains('dropdown-item')) {
                    id = e.target.parentElement.parentElement.dataset.id;
                    url = e.target.parentElement.parentElement.href;
                }
                else if (e.target.parentElement.parentElement.parentElement.classList.contains('dropdown-item')) {
                    id = e.target.parentElement.parentElement.parentElement.dataset.id;
                    url = e.target.parentElement.parentElement.parentElement.href;
                }
                else {
                    id = e.target.parentElement.parentElement.parentElement.parentElement.dataset.id;
                    url = e.target.parentElement.parentElement.parentElement.parentElement.href;
                }
                clickedNotification(id);
                window.location.href = url;
            }
        })
    }
})
setInterval(getNotifications, 10000);
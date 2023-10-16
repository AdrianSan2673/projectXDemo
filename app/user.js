class User{

    constructor(){
        this.id = null;
        this.username = '';
        this.first_name = '';
        this.last_name = '';
        this.email = '';
        this.id_role = null;
    }

    checkUsername(){
        document.querySelector('#user_exists').style.display = 'block';
        this.username = document.querySelector('#username').value;
        if(this.username.length > 0){
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../usuario/user_exists');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('username='+this.username);
            
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
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
        }else{
            document.querySelector('#user_exists').style.display = 'none';
        }
    }

    checkEmail(){
        document.querySelector('#email_exists').style.display = 'block';
        this.email = document.querySelector('#email').value;
        if(this.email.length > 0){
            if(utils.isEmail(this.email)){
                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../usuario/email_exists');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('email='+this.email);

                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        let email_exists = xhr.responseText;
                        if (email_exists == 1) {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>La dirección de correo ya ha sido registrada anteriormente</p>";
                        } else {
                            document.querySelector('#email_exists').innerHTML = "<p class='text-success'>Correo aceptado.</p>";
                        }
                    }
                }
            }else{
                document.querySelector('#email_exists').innerHTML = "<p class='text-danger'>No es un correo</p>";
            }
            
        }else{
            document.querySelector('#email_exists').style.display = 'none';
        }
    }

    confirmPassword(){
        document.querySelector('#div_confirm_pass').style.display = 'block';
        this.password = document.querySelector('#register-user-form #password').value;
        this.password_confirm = document.querySelector('#register-user-form #password_confirm').value;
        if (this.password > 0 && this.password_confirm > 0) {
            if (this.password != this.password_confirm) {
                document.querySelector('#div_confirm_pass').innerHTML = "<p class='text-danger'>Las contraseñas no coinciden</p>";
            }else{
                document.querySelector('#div_confirm_pass').innerHTML = "<p class='text-success'>Las contraseñas coinciden</p>";
            }
        }else{
            document.querySelector('#div_confirm_pass').style.display = 'none';
        }
    }


    save(){
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

                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        if(r == 0){
                            utils.showToast('Omitiste algún dato','error');
                        } else if(r == 1){
                            utils.showToast('El usuario fue registrado exitosamente', 'success');
                            
                            document.querySelector('#register-user-form').reset();
                            document.querySelector('#user_exists').style.display = 'none';
                            document.querySelector('#email_exists').style.display = 'none';
                            document.querySelector('#div_confirm_pass').style.display = 'none';
    
                        } else if(r == 2){
                            utils.showToast('Las contraseñas no coinciden', 'warning');
                        }else if(r == 3){
                            utils.showToast('El usuario o la dirección de correo electrónico ya existía', 'error');
                        }else if (r == 4){
                            utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                            
                        }
                    }
                }
            }else{
                utils.showToast("Las contraseñas no coinciden", "warning");
            }
        }else {
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
                        utils.showToast('Se guado con exito', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        
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

}
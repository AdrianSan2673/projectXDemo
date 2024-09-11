class Proyecto {

    constructor(){
        this.id = null;
        this.usuario = '';
        this.password = '';
        this.Nombres = '';
        this.Apellidos = '';
        this.Correo = '';
        this.Telefono = '';
        this.Activacion = '';
        this.id_tipo_usuario = '';
        this.creado = '';
        this.modificado = '';
    }

    updateProject(){
        var form = document.querySelector("#modal_edit_department form");
        var formData =  new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../project/updateProject');
        xhr.send(formData);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);

                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        
                    } else {

                    }
                } catch (error) {
                    form.querySelectorAll().disabled = false
                }
            }
        }
    }
}
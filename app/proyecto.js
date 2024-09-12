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
        var form = document.querySelector("#modal_editar_proyecto form");
        var formData =  new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../proyecto/updateProject');
        xhr.send(formData);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);

                //try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 1) {
                        utils.showToast('Se guardó con éxito', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        $('#modal_editar_proyecto').modal('hide');
                        let usuarios = `
                        <tr>
                                            <td>
                                                <p class="title-department" style='font-size: 17px;'> ${json_app.proyecto.direccion} </p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'> ${json_app.proyecto.status}</p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'>${json_app.proyecto.Telefono}</p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'>${json_app.proyecto.creado}</p>
                                            </td>
                                            <td>
                                                <p class="title-departament" style='font-size: 17px;'>${json_app.proyecto.id_tipo_usuario}</p>
                                            </td>
                                        </tr>

                                 `;

                        document.getElementById('tb_proyecto').innerHTML = usuarios
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                //} catch (error) {
                   // form.querySelectorAll().disabled = false
               //}
            }
        }
    }
}
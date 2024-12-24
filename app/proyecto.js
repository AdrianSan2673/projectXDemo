class Proyecto {

    constructor(){
        this.id = null;
        this.Nombre = '';
        this.Estado = '';
        this.direccion = '';
        this.status = '';
        this.Telefono = '';
        this.Activacion = '';
        this.id_tipo_usuario = '';
        this.creado = '';
        this.modificado = '';
    }

    createNewProject() {

        var form = document.querySelector("#modal_create form");
        var formData = new FormData(form);


        fetch('../proyecto/createNewProject', {
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
                let json_app = JSON.parse(r);
                console.log(json_app)
                if (json_app.status == 1) {
                    utils.showToast('Se guardo con exito', 'success');
                    form.querySelectorAll('.btn')[1].disabled = false;
                    $('#modal_create').modal('hide');
                    let proyectos = '';
                    json_app.proyectos.forEach (element => { //AQUI SE RECOPILA INFORMACION DE LA TABLA                   
                            proyectos += `
                        <div class="col-md-4 ">
                        <div class="small-box bg-info">
                            <button class="btn text-white btn-delete" value="<?= Encryption::encode($proyecto['id']) ?>">X</button>
                            <div class="inner">
                            <h4>${element.Nombre}</h4>
                            <div class="row">
                                <div class="col-6">
                                <p style="font-size: small;">${element.Estado} </p>
                                </div>
                                <div class="col-6">
                                <p style="font-size: small;">${element.status} Status</p>
                                </div>
                            </div>
                            </div>
                            <?php //if (Utils::permission($_GET['controller'], 'read')) : ?>
                            <a class="small-box-footer" href="<?= base_url ?>proyecto/ver&id=AQUI SE INCRUTA CON LA LLAVE">
                            Ver
                            <i class="fas fa-arrow-circle-right"></i>
                            </a>
                            <?php //endif ?>
                        </div>
                        </div>
                    `;}
                    )
                    document.getElementById('all_projects').innerHTML = proyectos;
                } else {
                    utils.showToast('Algo salio mal', 'warning');
                    form.querySelectorAll('.btn')[1].disabled = false;
                }
               
            })
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
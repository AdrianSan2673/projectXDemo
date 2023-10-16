class Clientecobranza {
    save() {
        const form = document.querySelector("#modal_cuentas form");
        const submitBtn = form.querySelector('[name="submit"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../ClienteContactoCobranza_SA/save', {
                method: 'POST',
                /* headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                }, */
                body: formData
            })
            .then(response => {
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
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                            <td>${element.Nombre}</td>
                            <td>${element.Correo==null?'':element.Correo}</td>
                            <td>${element.Telefono==null?'':element.Telefono}</td>
                            <td>${element.Extension==null?'':element.Extension}</td>
                            <td class="text-center  align-middle">
                                <div class="btn-group">
                                    <button class="btn btn-info" data-id="${element.id}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger ml-3" data-id="${element.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <tr>
                        `;
                        });
                        document.querySelector('#tb_contacts_collection tbody').innerHTML = contactos;
                        utils.showToast('Fue registrada exitosamente', 'success');
                        submitBtn.disabled = false;
                        $('#modal_cuentas').modal('hide');
                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 3) {
                        utils.showToast('No tienes permiso para registrar', 'error');
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                submitBtn.disabled = false;
            });
    }





    getOne() {
        var form = document.querySelector("#modal_cuentas form");
        var formData = new FormData(form);
        fetch('../ClienteContactoCobranza_SA/getOne', {
                method: 'POST',
                /*        headers: {
                           'Content-type': 'application/x-www-form-urlencoded'
                       }, */
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Ocurrio un error', 'success');
                    } else if (json_app.status == 1) {

                        form.querySelector('[name="Cuentas_Contacto"]').value = json_app.contact.Nombre
                        form.querySelector('[name="Cuentas_Correo"]').value = json_app.contact.Correo
                        form.querySelector('[name="Cuentas_Telefono"]').value = json_app.contact.Telefono
                        form.querySelector('[name="Cuentas_Extension"]').value = json_app.contact.Extension
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }


    delete(id) {
        fetch('../ClienteContactoCobranza_SA/delete', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            })
            .then(response => {
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
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                            <td>${element.Nombre}</td>
                            <td>${element.Correo==null?'':element.Correo}</td>
                            <td>${element.Telefono==null?'':element.Telefono}</td>
                            <td>${element.Extension==null?'':element.Extension}</td>
                            <td class="text-center  align-middle">
                                <div class="btn-group">
                                    <button class="btn btn-info" data-id="${element.id}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger ml-3" data-id="${element.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <tr>
                        `;
                        });
                        document.querySelector('#tb_contacts_collection tbody').innerHTML = contactos;

                        utils.showToast('Fue eliminado exitosamente', 'success');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
            });
    }




    saveReclu() {
        const form = document.querySelector("#modal_collection form");
        const submitBtn = form.querySelector('[name="submit"]');
        submitBtn.disabled = true;
        const formData = new FormData(form);

        fetch('../ClienteContactoCobranza/save', {
                method: 'POST',
                /* headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                }, */
                body: formData
            })
            .then(response => {
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
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 1) {
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                            <td>${element.name}</td>
                            <td>${element.email==null?'':element.email}</td>
                            <td>${element.phone==null?'':element.phone}</td>
                            <td>${element.extension==null?'':element.extension}</td>
                            <td class="text-center  align-middle">
                                <div class="btn-group">
                                    <button class="btn btn-info" data-id="${element.id}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger ml-3" data-id="${element.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <tr>
                        `;
                        });
                        document.querySelector('#tb_contacts_collection tbody').innerHTML = contactos;
                        utils.showToast('Fue registrada exitosamente', 'success');
                        submitBtn.disabled = false;
                        $('#modal_collection').modal('hide');
                    } else if (json_app.status === 2) {
                        utils.showToast('No se pudo guardar el dato', 'error');
                        submitBtn.disabled = false;
                    } else if (json_app.status === 3) {
                        utils.showToast('No tienes permiso para registrar', 'error');
                        submitBtn.disabled = false;
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                submitBtn.disabled = false;
            });
    }


    getOneReclu() {
        var form = document.querySelector("#modal_collection form");
        var formData = new FormData(form);
        fetch('../ClienteContactoCobranza/getOne', {
                method: 'POST',
                /*        headers: {
                           'Content-type': 'application/x-www-form-urlencoded'
                       }, */
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(r => {
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Ocurrio un error', 'success');
                    } else if (json_app.status == 1) {

                        form.querySelector('[name="Cuentas_Contacto"]').value = json_app.contact.name
                        form.querySelector('[name="Cuentas_Correo"]').value = json_app.contact.email
                        form.querySelector('[name="Cuentas_Telefono"]').value = json_app.contact.phone
                        form.querySelector('[name="Cuentas_Extension"]').value = json_app.contact.extension
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo' + error, 'error');
                }
            })
            .catch(error => {
                utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                console.log(error);
            });
    }


    deleteReclu(id) {
        fetch('../ClienteContactoCobranza/delete', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            })
            .then(response => {
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
                    if (json_app.status === 0) {
                        utils.showToast('Omitió algún dato', 'error');
                    } else if (json_app.status === 1) {
                        let contactos = '';
                        json_app.contactos.forEach(element => {
                            contactos += `
                            <tr>
                            <td>${element.name}</td>
                            <td>${element.email==null?'':element.email}</td>
                            <td>${element.phone==null?'':element.phone}</td>
                            <td>${element.extension==null?'':element.extension}</td>
                            <td class="text-center  align-middle">
                                <div class="btn-group">
                                    <button class="btn btn-info" data-id="${element.id}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger ml-3" data-id="${element.id}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                            <tr>
                        `;
                        });
                        document.querySelector('#tb_contacts_collection tbody').innerHTML = contactos;

                        utils.showToast('Fue eliminado exitosamente', 'success');
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
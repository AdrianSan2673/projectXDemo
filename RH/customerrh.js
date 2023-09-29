class CustomerRh {

    getOne(cliente) {
        var form = document.querySelector("#modal_RH form");

        fetch('../RecursosHumanos/getOne', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                body: 'Cliente=' + cliente
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
                        form.querySelector("[name='Cliente']").value = json_app.customer.Cliente;
                        form.querySelector("[name='Empresa']").value = json_app.customer.Nombre_Empresa;
                        form.querySelector("[name='id_moduel']").value = json_app.module.id;

                        form.querySelector("[name='Nombre_Cliente']").value = json_app.customer.Nombre_Cliente;
                        if (json_app.module.id_package != null) {
                            form.querySelector('select').value = json_app.module.id_package
                        }

                        //form.querySelector("[name='cancellation_date']").value = json_app.module.cancellation_date
                        //form.querySelector("[name='comment']").value = json_app.module.comment
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

}
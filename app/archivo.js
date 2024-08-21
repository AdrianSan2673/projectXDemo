class Archivo {
    upload_file() {
        var form = document.querySelector("#form-document");
        var formData = new FormData(form);

        fetch('../Archivo/upload_file', { // Asegúrate de que esta ruta esté correcta
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-Token': formData.get('csrf_token') // Incluye el token CSRF en la cabecera
            }
        })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    throw new Error('Network response was not ok.');
                }
            })
            .then(data => {
                if (data.status == 1) {
                    this.addRowToTable(data.fileData);
                    utils.showToast('Archivo subido con éxito.', 'success');
                } else {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo.', 'error');
                }
            });
        //.catch(error => {
        //utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
        //});
    }

    addRowToTable(fileData) {
        let tableRow = `<tr>
            <td>${fileData.upload_date}</td>
            <td>${fileData.file_name}</td>
            <td>${fileData.upload_time}</td>
            <td><a href="${fileData.view_link}" class="btn btn-info btn-sm" target="_blank">Ver</a></td>
            <td><a href="${fileData.download_link}" class="btn btn-success btn-sm">Descargar</a></td>
        </tr>`;
        document.querySelector('#filesTable tbody').insertAdjacentHTML('beforeend', tableRow);
    }
}
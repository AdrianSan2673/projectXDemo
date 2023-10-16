class History_position {


    getHistoryposition(ID) {
        let xhr = new XMLHttpRequest();
        let data = `id=${ID}`;
        let form = document.querySelector('#modal-historyposition form');
        //document.querySelectorAll('#modal_responsability form .btn')[1].disabled = false;
        xhr.open('POST', '../HistorialPuestos/getOne');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    if (r != 0) {
                        let json_app = JSON.parse(r);
                        console.log(json_app.start_date);
                        form.querySelectorAll('input')[0].value = json_app.start_date
                        form.querySelectorAll('input')[2].value = json_app.id
                        document.querySelector('#id_position_history').value = `${json_app.id_position}`

                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }

            }
        }
    }


    updatStartDate() {
        var form = document.querySelector("#modal-historyposition form");
        var formData = new FormData(form);
        form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../HistorialPuestos/updatStartDate');
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
                        utils.showToast('Fue guardado exitosamente', 'success');
                        form.querySelectorAll('.btn')[1].disabled = false;
                        let hisotryPosition = ''
                        json_app.hisotryPosition.forEach(element => {
                            hisotryPosition += `
                            <tr>
                             <td class=" align-middle ">${element.title}</td>
                             <td class=" align-middle ">${element.department}</td>
                             <td class=" align-middle ">${element.start_date}</td>
                             <td class=" text-center ">
                                 <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                 <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>

                             </td>
                            </tr>
                            `
                        })
                        document.querySelector('#tboodyHistory').innerHTML = hisotryPosition;
                        $('#modal-historyposition').modal('hide');
                        form.reset()
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
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


    delete_historyPosition(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../HistorialPuestos/delet');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('id=' + id);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Fue eliminado', 'success');
                        let hisotryPosition = ''
                        json_app.hisotryPosition.forEach(element => {
                            hisotryPosition += `
                            <tr>
                             <td class=" align-middle ">${element.title}</td>
                             <td class=" align-middle ">${element.department}</td>
                             <td class=" align-middle ">${element.start_date}</td>
                             <td class=" text-center ">
                                 <button class="btn btn-danger text-bold" value="${element.id}">X</button>
                                 <button class="btn btn-info" value="${element.id}"><i class="fas fa-edit"></i></button>

                             </td>
                            </tr>
                            `
                        })
                        document.querySelector('#tboodyHistory').innerHTML = hisotryPosition;
                    } else if (json_app.status == 2) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }

            }
        }
    }
}
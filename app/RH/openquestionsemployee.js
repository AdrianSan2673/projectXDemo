class OpenquestionsEmployee {

    save() {
        var form = document.querySelector("#form_open_questions");
        var formData = new FormData(form);
        //form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluacionempleado/feedback');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Guardado exitosamente', 'success');

                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    // form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }
    // ===[gabo 16 de mayo evaluaciones]===
    save2() {
        var form = document.querySelector("#form_open_questions");
        var formData = new FormData(form);
        //form.querySelectorAll('.btn')[1].disabled = true;

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../evaluacionempleado/feedback2');
        xhr.send(formData);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                try {
                    let json_app = JSON.parse(r);
                    console.log(json_app);
                    if (json_app.status == 0) {
                        utils.showToast('Omitiste algún dato', 'error');
                    } else if (json_app.status == 1) {
                        utils.showToast('Retroalimentado exitosamente', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else if (json_app.status == 2) {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    } else {
                        form.querySelectorAll('.btn')[1].disabled = false;
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                } catch (error) {
                    // form.querySelectorAll('.btn')[1].disabled = false;
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                }
            }
        }
    }
    // ===[gabo 16 de mayo evaluaciones]===
}
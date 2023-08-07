


class Diasfestivos{
save(){
	console.log("entró");
            var form = document.querySelector("#dias-inhabiles-form");
            var formData = new FormData(form);

            fetch('../DiasInhabiles/saveDay', {
                    method: 'POST',
                    body: formData
                })
                .then(function (response) {
                  /* console.log(response.json()); */
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw "Error en la Petición";
                    }
                })
                .then(function (json_app) {

                    console.log(json_app);
                    if (json_app.status == 1) {
                        
                        utils.showToast('Dias guardados', 'success');
    
                    } else if (json_app.status == 0) {
                        utils.showToast('No se pudo consultar la informacion', 'error');
                    } else{
                        utils.showToast('No se pudo consultar la informacion', 'error');
                    }
                })
                .catch(function (error) {
                    utils.showToast('Algo salió mal. Inténtalo de nuevo ' + error, 'error');
                    console.log(error);
                });
    
    
        
    }
}
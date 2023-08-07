class Prospecto{
    propuesta_reclutamiento(){
        var form = document.querySelector("#reclutamiento-form");
        var formData = new FormData(form);
        console.log(formData);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './propuesta_reclutamiento');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
            }else{
                document.querySelector("#submit_reclutamiento").disabled = false;
            }
        }
        
    }

    propuesta_atraccion_talento(){
        var form = document.querySelector("#atraccion-form");
        var formData = new FormData(form);
        console.log(formData);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './propuesta_atraccion_talento');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
            }else{
                document.querySelector("#submit_atraccion").disabled = false;
            }
        }
        
    }

    propuesta_psicometrias(){
        var form = document.querySelector("#psicometrias-form");
        var formData = new FormData(form);
        console.log(formData);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', './propuesta_psicometrias');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
            }else{
                document.querySelector("#submit_psicometrias").disabled = false;
            }
        }
        
    }

    create(){
        this.id = document.querySelector("#prospecto-form #id").value;
        
        var form = document.querySelector("#prospecto-form");
        var formData = new FormData(form);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../prospecto/create');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#prospecto-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Prospecto creado exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../prospecto/index`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#prospecto-form #submit").disabled = false;
                }
            }
        }
    }

    update(){
        this.id = document.querySelector("#prospecto-form #id").value;
        
        var form = document.querySelector("#prospecto-form");
        var formData = new FormData(form);
        formData.append('id', this.id);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../prospecto/update');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#prospecto-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Prospecto actualizado exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../prospecto/index`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#prospecto-form #submit").disabled = false;
                }
            }
        }
    }

    create_work(){
        
        var form = document.querySelector("#trabajar-prospecto-form");
        var formData = new FormData(form);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../prospecto/create_work');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#trabajar-prospecto-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Prospecto trabajado exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../prospecto/index`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#trabajar-prospecto-form #submit").disabled = false;
                }
            }
        }
    }
//La batería se conforma de acuerdo al perfil solicitado
    update_work(){
        
        var form = document.querySelector("#trabajar-prospecto-form");
        var formData = new FormData(form);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../prospecto/update_work');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#trabajar-prospecto-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Prospecto trabajado exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../prospecto/index`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#trabajar-prospecto-form #submit").disabled = false;
                }
            }
        }
    }
}
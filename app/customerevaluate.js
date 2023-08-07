class CustomerEvaluation{
    constructor(){
        this.id = null;
        this.customer = '';
        this.alias = '';
        this.id_cost_center = null;
    }

    save(){
            
        var form = document.querySelector("#customer-form");
        var formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', './create_evaluation');
        xhr.send(formData);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                } else if(r == 1){
                    utils.showToast('La evaluación del cliente fue registrada exitosamente', 'success');
                    
                    location.href = "../cliente/index";

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }else{
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                }
            }
        }
    }

    update(){
        this.id = document.querySelector('#customer-form #id').value;
        this.customer = document.querySelector('#customer-form #customer').value;
        this.alias = document.querySelector('#customer-form #alias').value;
        this.id_cost_center = document.querySelector('#customer-form #id_cost_center').value;

        if (this.id.length > 0 && this.customer.length > 0 && this.alias.length > 0 && this.id_cost_center.length > 0) {

            var form = document.querySelector("#customer-form");
            var formData = new FormData(form);
            formData.append('id', this.id);
        
            //let data = `id=${this.id}&customer=${this.customer}&alias=${this.alias}&id_cost_center=${this.id_cost_center}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', './update');
            //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(formData);

            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    if(r == 0){
                        utils.showToast('Omitiste algún dato','error');
                    } else if(r == 1){
                        utils.showToast('El cliente fue actualizado exitosamente', 'success');
                        setTimeout(() => {
                        window.location.href = `../cliente/index`;
                    }, 3000);
                    }else if (r == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        
                    }
                }
            }
            
        }else {
            utils.showToast('Completa todos los campos', 'warning');
        }
    }  
}
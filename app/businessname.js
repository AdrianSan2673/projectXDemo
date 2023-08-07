class BusinessName{

    constructor(){
        this.id_customer = null;
        this.business_name = '';
        this.RFC = '';
    }

    getBusinessName(){
        this.id_customer = document.querySelector('#customer').value;
        let xhr = new XMLHttpRequest();
        let data = `customer=${this.id_customer}`;
        xhr.open('POST', '../BusinessName/getBNByCustomer');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_bn = JSON.parse(this.responseText);
                    let business_name = '';
                    for (let i in json_bn){
                        business_name += `<option value="${json_bn[i].id}">${json_bn[i].business_name}</option>`;
                    }
                    document.querySelector("#business_name").innerHTML = business_name;
                }
            }
        }
    }

    getTbBN(){
        this.id_customer = document.querySelector('#id').value;
        let xhr = new XMLHttpRequest();
        let data = `customer=${this.id_customer}`;
        xhr.open('POST', '../BusinessName/getBNByCustomer');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_bn = JSON.parse(this.responseText);
                    let business_name = '';
                    for (let i in json_bn){
                        business_name += 
                            `<tr>
                                <td>${json_bn[i].business_name}</td>
                                <td>${json_bn[i].RFC}</td>
                                <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <button href="#" class="btn btn-info btn-edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    }
                    console.log();
                    document.querySelector("#tb_bn tbody").innerHTML = business_name;
                }
            }
        }
    }

    save(){
        this.id_customer = document.querySelector('#id_customer').value;
        this.business_name = document.querySelector('#customer-bn-form #business_name').value;
        this.RFC = document.querySelector('#customer-bn-form #rfc').value;
        

        if (this.id_customer.length > 0 && this.business_name.length > 0 && this.RFC.length > 0) {
            
            let data = `id_customer=${this.id_customer}&business_name=${this.business_name}&RFC=${this.RFC}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../BusinessName/create');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);

            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    console.log(r);
                    if(r == 0){
                        utils.showToast('Omitiste algún dato','error');
                    } else if(r == 1){
                        utils.showToast('La razón social fue registrada exitosamente', 'success');
                        
                        document.querySelector('#customer-bn-form').reset();

                    }else if (r == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                        
                    }
                }
            }
            
        }else {
            utils.showToast('Completa todos los campos', 'warning');
        }
    }

    update(){
        this.id = document.querySelector("#customer-bn-form #id").value;
        this.id_customer = document.querySelector("#customer-bn-form #id_customer").value;
        
        var form = document.querySelector("#customer-bn-form");
        var formData = new FormData(form);
        formData.append('id', this.id);
        
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../BusinessName/update');
        //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(formData);
        xhr.id_customer = this.id_customer;

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if(r == 0){
                    utils.showToast('Omitiste algún dato','error');
                    document.querySelector("#customer-bn-form #submit").disabled = false;
                } else if(r == 1){
                    utils.showToast('Razón social actualizada exitosamente', 'success');
                    setTimeout(() => {
                        window.location.href = `../cliente/ver&id=${xhr.id_customer}`;
                    }, 3000);

                }else if (r == 2){
                    utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    document.querySelector("#customer-bn-form #submit").disabled = false;
                }else{
                    document.querySelector("#customer-bn-form #submit").disabled = false;
                }
            }
        }
    }
    
}
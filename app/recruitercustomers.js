class RecruiterCustomer{

    constructor(){
        this.id_customer = null;
        this.id_recruiter = '';
    }

    getRecruiterByCustomer(){
        this.id_customer = document.querySelector('#customer').value;
        let xhr = new XMLHttpRequest();
        let data = `customer=${this.id_customer}`;
        xhr.open('POST', '../Ejecutivos/getRecruiterByCustomer');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);

        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                console.log(r);
                if (r != 0){
                    let json_recruiter = JSON.parse(this.responseText);
                    let recruiter = '';
                    for (let i in json_recruiter){
                        recruiter += `<option value="${json_recruiter[i].id}">${json_recruiter[i].first_name} ${json_recruiter[i].last_name}</option>`;
                    }
                    document.querySelector("#recruiter").innerHTML = recruiter;
                }
            }
        }
    }

    save(){
        this.id_customer = document.querySelector('#customer').value;
        this.id_recruiter = document.querySelector("#recruiter").value;
        

        if (this.id_customer.length > 0 && this.id_recruiter.length > 0) {
            
            let data = `id_customer=${this.id_customer}&id_recruiter=${this.id_recruiter}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', './add_recruiter_customer');
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(data);

            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = xhr.responseText;
                    if(r == 0){
                        utils.showToast('Omitiste algún dato','error');
                    } else if(r == 1){
                        //utils.showToast('El cliente fue asignado exitosamente', 'success');
                        window.location.reload();

                    }else if (r == 2){
                        utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                    }
                }
            }
            
        }
    }
    
}
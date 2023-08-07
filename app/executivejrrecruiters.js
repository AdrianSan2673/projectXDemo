class ExecutiveJRRecruiters{

    constructor(){
        this.id_executiveJR = null;
        this.id_recruiter = '';
    }

    save(){
        this.id_executiveJR = document.querySelector('#executiveJR').value;
        this.id_recruiter = document.querySelector("#recruiter").value;
        

        if (this.id_executiveJR.length > 0 && this.id_recruiter.length > 0) {
            
            let data = `id_executiveJR=${this.id_executiveJR}&id_recruiter=${this.id_recruiter}`;
            let xhr = new XMLHttpRequest();
            xhr.open('POST', './add_executiveJR_recruiter');
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
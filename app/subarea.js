class Subarea{

    constructor(){
        this.id_area = null;
        this.selector = '';
    }

    getSubareasByArea(){
        //this.id_area = document.querySelector('#area').value;
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `area=${this.id_area}`;
        xhr.open('POST', '../subarea/getSubareasByArea');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_subareas = JSON.parse(this.responseText);
                    let subareas = '';
					subareas += `<option value=""></option>`  //gabo 13/03/2023
                    for (let i in json_subareas){
                    subareas += `<option value="${json_subareas[i].id}">${json_subareas[i].subarea}</option>`
                    }
                    this.s.innerHTML = subareas;
                    //document.querySelector("#subarea").innerHTML = subareas;
                }
            }
        }
    }
    
}
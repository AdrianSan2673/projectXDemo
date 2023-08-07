class City{

    constructor(){
        this.id_state = null;
        this.selector = '';
    }

    getCitiesByState(){
        //this.id_state = document.querySelector('#state').value;
        let xhr = new XMLHttpRequest();
        xhr.s = this.selector;
        let data = `state=${this.id_state}`;
        xhr.open('POST', '../city/getCitiesByState');
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function(){
            if (xhr.readyState == 4 && xhr.status == 200) {
                let r = xhr.responseText;
                if (r != 0){
                    let json_cities = JSON.parse(this.responseText);
                    let cities = '';
					cities += `<option value=""></option>`    //gaboooo 13/03/2023
                    for (let i in json_cities){
                    cities += `<option value="${json_cities[i].id}">${json_cities[i].city}</option>`
                    }
                    this.s.innerHTML = cities;
                }
            }
        }
    }
    
}
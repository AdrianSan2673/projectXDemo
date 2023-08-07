<div class="modal fade" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Atracción de Talento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="0">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="job_title">Puesto</label>
                        <input type="text" class="form-control" name="job_title" id="job_title" maxlength="100">
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label class="col-form-label" for="request_date">Fecha Inicial</label>
                            <input type="date" class="form-control" name="request_date" id="request_date" value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="form-group col">
                            <label class="col-form-label" for="end_date">Fecha de Finalización</label>
                            <input type="date" class="form-control" name="end_date" id="end_date" value="<?=date('Y-m-d', strtotime('+1 month', strtotime(date('Y-m-d'))))?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="id_state">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="id_state" id="state" class="form-control" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="id_city">Ciudad</label>
                        <select name="id_city" id="city" class="form-control" required>
                          <option disabled selected="selected"></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="salary">Sueldo</label>
                        <input type="number" class="form-control" name="salary" id="salary" min="0">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="id_customer">Cliente</label>
                        <?php $customers = Utils::showCustomers(); ?>
                          <select name="id_customer" id="customer" class="form-control" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($customers as $customer): ?>
                              <option value="<?=$customer['id']?>"><?=$customer['customer'] ?></option>
                            <?php endforeach ?>
                          </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="id_business_name">Razón social</label>
                        <select class="form-control" name="id_business_name" id="business_name">
                            <option disabled selected="selected"></option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>
<script src="<?=base_url?>app/businessname.js?v=<?=rand()?>"></script>
<script type="text/javascript">
    window.onload = function() {
        document.querySelector('#btn_new_attraction').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_create form').reset();
            $('#modal_create').modal({backdrop: 'static', keyboard: false});
        })
        document.querySelector('#customer').onchange = function() {
            let business_name = new BusinessName();
            business_name.getBusinessName();
          };

        document.querySelector('#state').onchange = function() {
            let cities = new City();
            cities.id_state = document.querySelector('#state').value;
            cities.selector = document.querySelector('#city');
            let ciudades = cities.getCitiesByState();
        };

        document.querySelector('#modal_create form').onsubmit = function(e) {
            e.preventDefault();
            var form = document.querySelector("#modal_create form");
            var formData = new FormData(form);
            form.querySelectorAll('.btn')[1].disabled = true;
            
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../AtraccionTalento/save');
            xhr.send(formData);
            xhr.onreadystatechange = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let r = this.responseText;
                    console.log(r);
                    try {
                        if (r == 0) {
                            utils.showToast('Omitiste algún dato','warning');
                        } else{
                            let json_app = JSON.parse(r);
                            if (json_app.status == 2) {
                                utils.showToast('Hubo un error al guardar los datos de la atracción de talento, intenta de nuevo.', 'error');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            } else if (json_app.status == 1) {
                                form.querySelectorAll('.btn')[1].disabled = true;
                                let attractions = '';
                                json_app.attractions.forEach(element => {
                                    attractions += `
                                    <tr>
                                        <td class="align-middle">${element.job_title}</td>
                                        <td class="align-middle">${element.customer}</td>
                                        <td class="align-middle">${element.request_date}</td>
                                        <td class="align-middle">${element.end_date}</td>
                                        <td class="align-middle">${element.city}, ${element.abbreviation}</td>
                                        <td class="align-middle">$ ${Math.round(element.salary)}</td>
                                        <td class="align-middle">${element.estatus}</td>
                                        <td class="text-center py-0 align-middle">
                                            <button class="btn btn-info" data-id="${element.id}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    `
                                });
                                document.querySelector('#tb_attractions tbody').innerHTML = attractions;
                                utils.showToast('Se agregó la atracción de talento exitosamente', 'success');
                                $('#modal_create').modal('hide');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            } else{
                                utils.showToast('Algo salió mal. Inténtalo de nuevo', 'error');
                                form.querySelectorAll('.btn')[1].disabled = false;
                            }
                        }
                    } catch (error) {
                        utils.showToast('Algo salió mal. Inténtalo de nuevo'+error, 'error');
                        form.querySelectorAll('.btn')[1].disabled = false;
                    }
                    
                }
            }
        }

        document.querySelector('#tb_attractions').onclick = function(e){
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                $('#modal_create').modal({backdrop: 'static', keyboard: false});
                let renglon;
                if (e.target.classList.contains('btn-info'))
                    renglon = e.target.dataset.id;
                else
                    renglon = e.target.offsetParent.dataset.id;
        
                let xhr = new XMLHttpRequest();
                let data = `id=${renglon}`;
                let form = document.querySelector('#modal_create');
                form.querySelectorAll('.btn')[1].disabled = false;
                xhr.open('POST', '../AtraccionTalento/getOne');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(data);
                xhr.onreadystatechange = function(){
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let r = xhr.responseText;
                        try {
                            if (r != 0){
                                let json_app = JSON.parse(r);
                                console.log(json_app);

                                let cities = new City();
                                cities.id_state = json_app.id_state;
                                cities.selector = document.querySelector('#city');
                                let ciudades = cities.getCitiesByState();

                                form.querySelectorAll('input')[0].value = 1;
                                form.querySelectorAll('input')[1].value = json_app.id;
                                form.querySelectorAll('input')[2].value = json_app.job_title;
                                form.querySelectorAll('input')[3].value = json_app.request_date;
                                form.querySelectorAll('input')[4].value = json_app.end_date;
                                form.querySelectorAll('select')[0].value = json_app.id_state;

                                form.querySelectorAll('select')[2].value = json_app.id_customer;
                                let business_name = new BusinessName();
                                business_name.getBusinessName();

                                form.querySelectorAll('input')[5].value = Math.round(json_app.salary);

                                setTimeout(() => {
                                    form.querySelectorAll('select')[1].value = json_app.id_city;
                                    form.querySelectorAll('select')[3].value = json_app.id_business_name;
                                }, 2000);
                                

                            }else {
                                let form = document.querySelector('#modal_create');
                                form.querySelectorAll('input')[0].value = 0;
                                form.querySelectorAll('input')[1].value = 0;
                            }
                        } catch (error) {
                            utils.showToast('Algo salió mal. Inténtalo de nuevo '+error, 'error');
                        }
                            
                    }
                }
            }
        }
    }
</script>
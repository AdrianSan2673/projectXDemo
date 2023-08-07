<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left mb-2">
                        <li class="breadcrumb-item"><a href="<?=base_url?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?=base_url?>capacitaciones/index">Capacitaciones</a></li>
                        <li class="breadcrumb-item active"><?=$training->title?></li>
                    </ol>
                </div>
                  <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h4><b>Cliente</b> <?=$training->title?></h4>
                    </div>       
                  </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h4 class="card-title">Datos del programa de capacitación</h4>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <b>Nombre del Curso</b>
                                <p><?=$training->title?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <b>Duración en horas</b>
                                <p><?=$training->hours?></p>
                            </div>
                            <div class="col-md-6 text-center">
                                <b>Perído de ejecución</b>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>De</b>
                                        <p><?=date_format(date_create($training->start_date), 'd/m/Y')?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>A</b>
                                        <p><?=date_format(date_create($training->end_date), 'd/m/Y')?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <b>Descripción</b>
                                <p><?=$training->description?></p>
                            </div>
                            
                        </div>
                        <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
                            <div class="text-center">
                                <button class="btn btn-info" id="btn-editar-cliente">Editar</button>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card card-navy">
                    <div class="card-header">
                        <h4 class="card-title">Colaboradores que tomaron la capacitación</h4>
                    </div>
                    <div class="card-body">
                        <table id="tb_contacts" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>CURP</th>
                                    <th>Puesto</th>
                                    <th>Razón Social</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employee_trainings as $employee) : ?>
                                    <tr>
                                        <td><?=$employee['first_name'].' '.$employee['surname'].' '.$employee['last_name']?></td>
                                        <td><?=$employee['curp']?></td>
                                        <td><?=$employee['title']?></td>
                                        <td><?=$employee['Razon']?></td>
                                        <td>
                                            <a href="<?=base_url?>formato/DC3&id=<?=Encryption::encode($employee['id'])?>" target="_blank" class="btn btn-orange">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>CURP</th>
                                    <th>Puesto</th>
                                    <th>Razón Social</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
              </div>
              
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
    </div>
</div>
<script type="text/javascript" src="<?=base_url?>app/cliente.js?v=<?=rand()?>"></script>

<?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()): ?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {
        document.querySelector('#tb_contacts').addEventListener('click', e => {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains('btn-info')) {
                let ID;
                if (e.target.classList.contains('btn-info'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;
                $('#modal_contacto').modal({backdrop: 'static', keyboard: false});
                let cliente = new Cliente();
                cliente.getContacto(ID);
            }
            if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains('btn-danger')) {
                let ID;
                if (e.target.classList.contains('btn-danger'))
                    ID = e.target.dataset.id;
                else
                    ID = e.target.offsetParent.dataset.id;
                $('#modal_delete_contacto').modal({backdrop: 'static', keyboard: false});
                let cliente = new Cliente();
                cliente.deleteContacto(ID);
            }
            e.stopPropagation();
        })

        document.querySelector('#modal_contacto form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_contacto();
        })

        document.querySelector('#modal_delete_contacto form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.delete_contacto();
        })

        document.querySelector('#modal_razon form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_razon();
        })

        document.querySelector('#modal_cliente form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_nombre_cliente();
        })

        document.querySelector('#modal_condiciones').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_condiciones();
        })

        document.querySelector('#modal_facturacion').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_facturacion();
        })

        document.querySelector('#modal_cuentas').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_cuentas();
        })

        document.querySelector('#modal_comentario').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_comentario_cliente();
        })

        document.querySelector('#modal_contactos form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_contactos_cliente();
        })

        document.querySelector('#modal_razones form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_razones_cliente();
        })

        /*document.querySelector('#modal_nota form').addEventListener('submit', e => {
            e.preventDefault();
            let cliente = new Cliente();
            cliente.save_nota();
        })*/
    })
</script>
<script type="text/javascript">
    document.querySelector('#btn-editar-cliente').addEventListener('click', e => {
        e.preventDefault();
        let cliente = new Cliente();
        cliente.getCliente(<?=$training->Cliente?>);
        $('#modal_cliente').modal({backdrop: 'static', keyboard: false});
    })
    
    document.querySelector('#btn-modificar-contactos').addEventListener('click', e => {
        e.preventDefault();
        let cliente = new Cliente();
        cliente.getContactos(<?=$training->Cliente?>, <?=$training->Empresa?>);
        $('#modal_contactos').modal({backdrop: 'static', keyboard: false});
    })
</script>
<?php endif ?>

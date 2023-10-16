   <div class="tab-pane active table-responsive" id="tabla-area">
       <div class="card-body" style="display:flex;justify-content:center">
           <div class="table-respsonsive" style="width: 80%;">
               <section class="content-header">
                   <div class="row" style="justify-content:right">

                       <div class="col-sm-3" style="justify-content:right;text-align:right">
                           <button id='Area' class="btn btn-warning" data-toggle="modal" data-target="#modal-add-type">
                               Agregar nuevo tipo </button>
                       </div>

                   </div>
               </section>
               <table id="table_types" class="table table-responsive-lg table-striped  table-condensed">
                   <thead>
                       <tr>
                           <th class="text-center">#</th>
                           <th class="text-center">Nombre</th>
                           <th class="text-center">Acciones</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                        $cont = count($types);
                        foreach ($types as $type) :
                        ?>
                       <tr>

                           <td class="text-center align-middle"><b><?= $cont;  ?></b></td>
                           <td class="text-center align-middle">
                               <?= $type['name'] ?></td>

                           <td class="text-center py-0 align-middle">
                               <div class="btn-group btn-group-sm">
                                   <a data-id="<?= $type['id'] ?>" data-type="<?= $type['name'] ?>"
                                       class="btn btn-success btn-sm mr-1">
                                       <i class="fas fa-edit"></i>
                                   </a>

                                   <a class="btn btn-danger btn-sm mr-1" data-type="<?= $type['name'] ?>"
                                       data-id="<?= $type['id'] ?>">
                                       <i class="fas  fa-trash"></i>
                                   </a>

                               </div>
                           </td>
                       </tr>
                       <?php
                            $cont--;
                        endforeach; ?>

                   </tbody>
                   <tfoot>
                       <tr>
                           <th class="text-center">#</th>
                           <th class="text-center">Nombre</th>
                           <th class="text-center">Acciones</th>

                       </tr>
                   </tfoot>
               </table>
           </div>
           <div>
           </div>
       </div>
   </div>

   <script>
$(document).ready(function() {
    let table = document.querySelector('#table_types');
    utils.dtTable(table);


    var subareas = new Subarea();
    document.querySelector('#table_types').addEventListener('click', e => {
        e.preventDefault();

        if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
                'btn-success')) {
            var id;
            var name;

            if (e.target.classList.contains('btn-success')) {
                id = e.target.dataset.id;
                name = e.target.dataset.type;
            } else {
                id = e.target.offsetParent.dataset.id;
                name = e.target.offsetParent.dataset.type;
            }

            console.log(name);

            document.querySelector('#add-type-form #flag').value = 2;
            document.querySelector('#add-type-form #id_type').value = id;
            document.querySelector('#add-type-form #type').value = name;

            $('#modal-add-type').modal({
                backdrop: 'static',
                keyboard: false
            });
        }

        var areas = new Area();
        if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                'btn-danger')) {
            var type;

            if (e.target.classList.contains('btn-danger'))
                type = e.target.dataset.id;
            else
                type = e.target.offsetParent.dataset.id;


            console.log(type);
            Swal.fire({
                title: '¿Estás seguro de borrar este tipo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                console.log(result)
                if (result.value == true) {
                    console.log("holaaa");

                    modulerh = new ModuleRH();
                    modulerh.delete_type(type);
                }
            })
        }
    });

});
   </script>
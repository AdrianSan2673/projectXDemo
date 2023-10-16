   <div class="tab-pane active table-responsive" id="tabla-area">
       <div class="card-body" style="display:flex;justify-content:center">
           <div class="table-respsonsive" style="width: 80%;">
               <section class="content-header">
                   <div class="row" style="justify-content:right">

                       <div class="col-sm-3" style="justify-content:right;text-align:right">
                           <button id='Area' class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar-area">
                               Agregar Area </button>
                       </div>

                   </div>
               </section>
               <table id="table_areas" class="table table-responsive-lg table-striped  table-condensed">
                   <thead>
                       <tr>
                           <th class="text-center">#</th>
                           <th class="text-center">Nombre</th>
                           <th class="text-center">Acciones</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php
                        $cont = count($areas);
                        foreach ($areas as $area) :
                        ?>
                           <tr>

                               <td class="text-center align-middle"><b><?= $cont;  ?></b></td>
                               <td class="text-center align-middle">
                                   <?= $area['area'] ?></td>
                               <td class="text-center py-0 align-middle">
                                   <div class="btn-group btn-group-sm">
                                       <a data-id="<?= Encryption::encode($area['id']) ?>" title="Ver Subareas" class="btn btn-success btn-sm mr-1">
                                           <i class="fas fa-eye"></i>
                                       </a>

                                       <a class="btn btn-danger btn-sm mr-1" title="Ocultar" data-id="<?= Encryption::encode($area['id']) ?>">
                                           <i class="fas  fa-eye-slash"></i>
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
           let table = document.querySelector('#table_areas');
           utils.dtTable(table);


           var subarea = new Subarea();
           document.querySelector('#table_areas').addEventListener('click', e => {
               e.preventDefault();

               if (e.target.classList.contains('btn-success') || e.target.offsetParent.classList.contains(
                       'btn-success')) {
                   var id_area;

                   if (e.target.classList.contains('btn-success'))
                       id_area = e.target.dataset.id;
                   else
                       id_area = e.target.offsetParent.dataset.id;

                   console.log(id_area)
                   subarea.fillModalSubareas(id_area)

                   $('#modal-ver-subareas').modal({
                       backdrop: 'static',
                       keyboard: false
                   });
               }

               var areas = new Area();
               if (e.target.classList.contains('btn-danger') || e.target.offsetParent.classList.contains(
                       'btn-danger')) {
                   var id_area;

                   if (e.target.classList.contains('btn-danger'))
                       id_area = e.target.dataset.id;
                   else
                       id_area = e.target.offsetParent.dataset.id;



                   Swal.fire({
                       title: '¿Estás seguro de ocultar esta area?',
                       text: "Esta area no será eliminada ni afectará otros registros pero ya no estará disponible!",
                       icon: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Ocultar',
                       cancelButtonText: 'Cancelar'
                   }).then((result) => {
                       if (result.value == true) {
                           areas.HideArea(id_area)
                       }
                   })
               }
           });

       });
   </script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <h3>Evaluaciones</h3>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
        <div class="row">
            <div class="col-sm-2 ml-auto">
                <button class="btn btn-orange float-right" id="btn_new_evaluation">Crear Plantilla de
                    evaluación</button>
            </div>
        </div>
    </section>
    <section class="content">

        <div class="row mt-3 " id="all_evaluaciones">
            <?php foreach ($evaluationsIndex as $eva) : ?>
                <div class="col-md-4 ">
                    <div class="small-box bg-info">
                        <button class="btn text-white btn-delete" value="<?= Encryption::encode($eva['id']) ?>">X</button>
                        <button class="btn btn-info float-right" value="<?= Encryption::encode($eva['id']); ?>"><i class="fas fa-edit"></i></button>

                        <div class="inner">
                            <h4><?= $eva['name'] ?></h4>
                            <div class="row">
                                <div class="col-4">
                                    <p style="font-size: small;"><?= $eva['levelFormat']  ?></p>
                                </div>
                                <div class="col-8">
                                    <p style="font-size: small;">Actualizada en
                                        <?= substr(Utils::getDate($eva['modified_at']), 5) ?> </p>
                                </div>
                            </div>
                        </div>
                        <a class="small-box-footer" href="<?= base_url ?>evaluaciones/ver&id=<?= Encryption::encode($eva['id']) ?>">
                            Ver
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

    </section>
</div>

<script src="<?= base_url ?>app/RH/evaluations.js?v=<?= rand() ?>"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', e => {

        document.querySelector('#btn_new_evaluation').addEventListener('click', e => {
            e.preventDefault();
            document.querySelector('#modal_create_evaluation [name="flag"]').value = '1'
            document.querySelector('#modal_create_evaluation [name="name"]').value = ''
            document.querySelector('#modal_create_evaluation [name="level"]').value = ''
            document.querySelector('#modal_create_evaluation [name="id"]').value = ''
            //===[gabo 12 junio excel evaluaciones pt2]===
            $('#id_cliente_plantilla').prop('disabled', false);
            $("#id_cliente_plantilla").val("");
            $('#id_cliente_plantilla').trigger('change');
            //===[gabo 12 junio excel evaluaciones fin pt2]===
            $('#modal_create_evaluation').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        let evaluation = new Evaluations();

        document.querySelector('#modal_create_evaluation').addEventListener('submit', e => {
            e.preventDefault();
            evaluation.save();
        });



        document.querySelector('#all_evaluaciones').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-info') || e.target.offsetParent.classList.contains(
                    'btn-info')) {
                e.preventDefault();

                $('#modal_create_evaluation').modal({
                    backdrop: 'static',
                    keyboard: false

                });
                let value;
                if (e.target.offsetParent.classList.contains('btn-info'))
                    value = e.target.parentElement.value
                else
                    value = e.target.value
                document.querySelector('#modal_create_evaluation [name="id"]').value = value
                evaluation.getEvaluation(value);

                //===[gabo 12 junio excel evaluaciones pt2]===
                $('#id_cliente_plantilla').prop('disabled', 'disabled');
                //===[gabo 12 junio excel evaluaciones fin pt2]===


            }

            if (e.target.classList.contains('btn-delete')) {
                Swal.fire({
                    title: '¿Quieres eliminar esta plantilla?',
                    text: "Se mantendra las evlauaciones enviadas de esta plantilla",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value == true) {
                        evaluation.delete(e.target.value);
                    }
                })
            }


        })


    })
</script>
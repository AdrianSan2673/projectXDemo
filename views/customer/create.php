<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <?php if (isset($edit) && isset($cliente) && is_object($cliente)) : ?>
                            <h4>Editar cliente</h4>
                        <?php else : ?>
                            <h4>Crear cliente</h4>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <?php if (isset($edit) && isset($cliente) && is_object($cliente)) : ?>
                                <h3 class="card-title"><?= $cliente->customer ?></h3>
                            <?php else : ?>
                                <h3 class="card-title">Nuevo cliente</h3>
                            <?php endif ?>

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="general">
                                    <form role="form" id="customer-form">
                                        <?php if (isset($edit) && isset($cliente) && is_object($cliente)) : ?>
                                            <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
                                        <?php endif ?>
                                        <div class="form-group row">
                                            <label for="customer" class="col-md-2 col-form-label">Nombre</label>
                                            <input type="text" name="customer" id="customer" class="col-md-10 form-control" value="<?= isset($cliente) && is_object($cliente) ? $cliente->customer : (isset($prospecto) && is_object($prospecto) ? $prospecto->Prospecto : ''); ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label for="alias" class="col-md-2">Alias:</label>
                                            <input type="text" name="alias" id="alias" class="col-md-10 form-control" value="<?= isset($cliente) && is_object($cliente) ? $cliente->alias : ''; ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label for="cost_center" class="col-md-2">Centro de costos:</label>
                                            <?php $cost_centers = Utils::showCostCenters(); ?>
                                            <select name="id_cost_center" id="id_cost_center" class="form-control col-md-10">
                                                <option disabled selected></option>
                                                <?php foreach ($cost_centers as $center) : ?>
                                                    <option value="<?= $center['id'] ?>" <?= isset($cliente) && is_object($cliente) && $center['id'] == $cliente->id_cost_center ? 'selected' : (isset($prospecto) && is_object($prospecto) && $prospecto->Plaza == $center['cost_center'] ? 'selected' : ''); ?>>
                                                        <?= $center['cost_center'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <!-- //===[gabo 7 agosto creado por ]=== -->

                                        <div class="form-group row" <?= (Utils::isAdmin() && isset($edit) && isset($cliente) && is_object($cliente)) ? '' : 'hidden'; ?>>
                                            <label class="col-md-2" for="Especificaciones">Creado por</label>
                                            <?php $roles = Utils::showUsuariosByVentas(); ?>
                                            <select class="form-control col-md-10" name="created_by" id="created_by">
                                                <option disabled selected></option>
                                                <?php foreach ($roles as $role) : ?>
                                                    <option value="<?= $role['username'] ?>" <?= isset($cliente) && is_object($cliente) && $role['username'] == $cliente->created_by ? 'selected' : ''; ?>>
                                                        <?= $role['first_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- //===[gabo 7 agosto creado por fin=== -->
                                        <div class="form-group">
                                            <a class="btn btn-info float-left" href="javascript: history.back()">Regresar</a>
                                            <?php if (isset($edit) && isset($cliente) && is_object($cliente)) : ?>
                                                <button type="submit" class="btn btn-success float-right" id="editSubmit">Editar</button>
                                            <?php else : ?>
                                                <button type="submit" class="btn btn-success float-right" id="registerSubmit">Crear cliente</button>
                                            <?php endif ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?= base_url ?>app/customer.js?v=<?= rand() ?>"></script>
<?php if (isset($edit) && isset($cliente) && is_object($cliente)) : ?>
    <script type="text/javascript">
        document.querySelector('#customer-form').addEventListener('submit', e => {
            e.preventDefault();
            let customer = new Customer();
            customer.update();
        });
    </script>
<?php else : ?>
    <script type="text/javascript">
        document.querySelector('#customer-form').addEventListener('submit', e => {
            e.preventDefault();
            let customer = new Customer();
            customer.save();
        });
    </script>
<?php endif ?>
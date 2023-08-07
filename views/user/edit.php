<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="card">
                    <form id="RegisterValidation" action="" method="">
                        <div class="card-header card-header-icon" data-background-color="blue">
                            <i class="material-icons">account_circle</i>
                        </div>
                        <div class="card-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <i class="material-icons">clear</i>
                                </button>
                                <h4 class="modal-title">Edit new user</h4>
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Username
                                    <small>*</small>
                                </label>
                                <input class="form-control" id="username" name="username" type="text" required="true" />
                            </div>
                                
                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Name
                                    <small>*</small>
                                </label>
                                <input class="form-control" id="name" name="name" type="text" required="true" />
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Email Address
                                    <small>*</small>
                                </label>
                                <input class="form-control" id="email" name="email" type="email" required="true" />
                            </div>
                            <div class="form-group">
                                <label for="id_role">User role</label>
                                <?php $roles = Utils::showRoles(); ?>
                                <select class="form-control" id="id_role" name="id_role" required>
                                    <option disabled selected></option>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="<?= $role['id'] ?>"><?= $role['type'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="category form-category">
                                <small>*</small> Required fields</div>
                            <div class="card-footer text-right">
                                <button type="button" class="btn btn-default btn-fill" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success btn-fill">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
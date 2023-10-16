<div class="modal fade" id="modal-payroll">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de Nómina</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group ">
                            <label class="col-form-label">Fecha de ajuste</label>
                            <input type="date" name="created_at" class="form-control" value="<?= isset($employeePayroll->created_at) ? $employeePayroll->created_at : '' ?>" required>
                        </div>
                <!--     <div class="form-group ">
                        <label class="col-form-label">Sueldo neto</label>
                        <input type="number" name="net_pay"  class="form-control" step="0.01"< placeholder="" value="<?= isset($employeePayroll->net_pay) ?  number_format($employeePayroll->net_pay,2) : '' ?>"  required>
                    </div> -->
                    <div class="form-group ">
                        <label class="col-form-label">Salario actual </label>
                        <input type="number" name="gross_pay"  class="form-control" step="0.01" placeholder="" value="<?= isset($employeePayroll->gross_pay) ? number_format($employeePayroll->gross_pay,2) : '' ?>"   required>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Banco</label>
                        <input type="text" name="bank"  class="form-control" placeholder="Identidad bancaria"  maxlength="150" value="<?= isset($employeePayroll->bank) ? $employeePayroll->bank : '' ?>"  required>
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">Cuenta</label>
                        <input type="number" name="account_number"   class="form-control" placeholder=""  maxlength="20" value="<?= isset($employeePayroll->account_number) ? $employeePayroll->account_number : '' ?>" >
                    </div>
                    <div class="form-group ">
                        <label class="col-form-label">CLABE</label>
                        <input type="number" name="CLABE"   class="form-control" placeholder="" maxlength="20" value="<?= isset($employeePayroll->CLABE) ? $employeePayroll->CLABE : '' ?>" >
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </form>
        </div>
    </div>
</div>
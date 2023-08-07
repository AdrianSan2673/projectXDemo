</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url?>plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="<?=base_url?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url?>dist/js/adminlte.min.js"></script>
<script src="<?=base_url?>app/utils.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/account.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/city.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/subarea.js?v=<?=rand()?>"></script>
<script>
  $(function(){
    $('[data-mask]').inputmask()
  });
</script>
</body>
</html>

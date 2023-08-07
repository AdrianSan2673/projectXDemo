<div class='alert alert-<?= $color ?>'>
        <span><?= $msg ?></span>
</div>
<p class="mb-1 text-center">
    <a href="<?=base_url?>usuario/index" class="bg-success">Iniciar sesión</a>
</p>
<script type="text/javascript">
	setTimeout(() => {
    	window.location.href = './index';
    }, 4000);
</script>
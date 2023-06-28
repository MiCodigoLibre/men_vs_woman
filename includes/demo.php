<?php
// header("Location: https://google.com.pe");

function ltc_rdr_demo() { 
	if(isset($_REQUEST['accion'])){
		switch($_REQUEST['accion']){
			case 'saludar':
				echo "Procesando...";
				echo '<meta http-equiv="refresh" content="0; url='.get_site_url().'/wp-admin/admin.php?page=ltc_calculadora" />';
				break;
		}
		exit;
	}


?>
<div class="section">
	<h1>Inicio de la Interface</h1>
	<form action="" method="POST">
		<input type="hidden" name="accion" value="saludar">
		<input type="text" name="nombre">
		<button type="submit">Enviar</button>
	</form>

	<script>
		$(document).ready(function() {
			console.log("JQUERY EXISTS!")

			$.post(he.con('index@saludar'), {

			}, function(res) {
				console.log(res)
			});
		});
	</script>
</div>


<?php } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
	$(window).ready(function(){
		var he_driver = function(){
			this.con = function(raw){
				raw = raw.split("@")
				return "<?=admin_url('admin-ajax.php')?>?action=do_controllerAux&controller="+raw[0]+"&accion="+raw[1];
			}			
			this.wp_ajax_url = "<?=admin_url('admin-ajax.php')?>";
		}
		he = new he_driver();
	})
</script>
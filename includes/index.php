<?php
function ltc_rdr_index() { 
$plugin_dir =  plugin_dir_url( __FILE__ );
?>
<div class="section">
	<style>
		.lienzo{
			background:;
			width: 500px;
			height: 250px;
			padding: 10px;
		}
		.box-men{
			background: #6686FF;
			width: 250px;
			height: 250px;
			position: absolute;
			text-align: right;
			padding: 30px 0px 0px 0px;
		}
		.box-woman{
			background: #F7AFFF;
			width: 250px;
			height: 250px;
			position: absolute;
			left: 260px;
			padding: 30px 0px 0px 0px;
		}
		table td{
			font-size: 30px;
		}
	</style>

	<audio controls id="men_mp3" style="display: none;">
	  <source src="<?=$plugin_dir?>../sound/voice_men.mp3">
	Your browser does not support the audio element.
	</audio>

	<audio controls id="woman_mp3" style="display: none;">
	  <source src="<?=$plugin_dir?>../sound/voice_woman.mp3">
	Your browser does not support the audio element.
	</audio>

	<!-- <h1>Men vs Woman</h1> -->
	<table border="1" width="200">
		<tr>
			<td colspan="2" align="center">
				<b>WINNER</b>
			</td>
		</tr>
		<tr>
			<td>MEN</td>
			<td width="50" align="center" id="men_win">0</td>
		</tr>
		<tr>
			<td>WOMAN</td>
			<td align="center" id="woman_win">0</td>
		</tr>
	</table>
	<!-- <h3><?=$plugin_dir?></h3> -->
	<button onclick="empujar('men')">Hombre</button>
	<button onclick="empujar('woman')">Mujer</button>
	<button onclick="restablecerYpuntuar(true)">Restablecer</button>
	<div class="lienzo" >
		<div class="box-men">
			<img src="<?=$plugin_dir?>../img/men.png" width="150">
		</div>
		<div class="box-woman">
			<img src="<?=$plugin_dir?>../img/woman.png" width="130">
			
		</div>
	</div>
	<script>
	  var reconnectInterval = 2000; // 3seg
	  var ws;
	  var msg;
	  (function Connect(){
	      //Check web sockets are supported.
	      if (!window.WebSocket){
	          alert("WebSocket not supported by this browser");
	          return;
	      }
	      try{
	        ws = new WebSocket( "ws://192.168.18.97:4321" );
	      }catch(e){
	        console.log(e);
	      } 
	      ws.onopen = function(){
	        console.log("Socket Open");
	      }

	      ws.onmessage = function(msg){
	        ws_data = JSON.parse(msg.data);

	        switch (ws_data.action) {
	          case 'gift':
	          	console.log(ws_data.giftId)
	              if( ws_data.giftId == 5655 ){ // rosa
	              	empujar('woman')
	              }else if(ws_data.giftId == 5760 ){
	              	empujar('men')
	              	
	              }
	            break;
	        }
	      }
	      ws.onclose = function(){
	        console.log("Socket Closed");
	        setTimeout(Connect, reconnectInterval);
	      }
	      ws.onerror = function(e){
	        console.log("Socket Error: " + e.data);
	      }
	  })();

		var men_win = 0, woman_win = 0;
		$(document).ready(function() {
			console.log( $(".box-men").css('margin-left') )
			console.log( $(".box-woman").css('margin-left') )

		});
		function empujar(genero){
			if( genero == "men" ){
				$(".box-men").css('margin-left','+=15px');
				$(".box-woman").css('margin-left','+=15px');
				$("#men_mp3")[0].play()
			}else{
				$(".box-men").css('margin-left','-=15px');
				$(".box-woman").css('margin-left','-=15px');
				$("#woman_mp3")[0].play()

			}

			detectarGanador();
		}
		function detectarGanador(){
			var men_pos = parseInt($(".box-men")
							.css('margin-left')
							.split("px")[0]);
			console.log(men_pos)
			if(men_pos<-250){
				console.log("WOMAN WIN!");
				woman_win+=1;
				restablecerYpuntuar()
			}else if(men_pos>250){
				console.log("MEN WIN!");
				men_win+=1;
				restablecerYpuntuar()
			}
		}
		function restablecerYpuntuar(all=false){
			if(all){
				men_win = 0;
				woman_win = 0;
			}
			// Actualizar tablero
			$("#men_win").html(men_win)
			$("#woman_win").html(woman_win)
			// Restablesca a los generos
			$(".box-men").css('margin-left','0px');
			$(".box-woman").css('margin-left','0px');
		}
	</script>
</div>

<?php } ?>
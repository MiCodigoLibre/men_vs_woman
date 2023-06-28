<?php
/* 
Plugin Name: Men vs Woman
Plugin URI: https://www.solsitecinnova.com
Description: Guerra de Generos por Tiktok
Version: 1.0 
Author: Luis Torres
Author URI: https://www.solsitecinnova.com
License: GPLv2 
*/

function ltc_Activar(){
	// aqui inicializar la construccion de la base de datos
	global $wpdb;
	
	$sql = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."ltc_prueba (
		  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		  nombres VARCHAR(50),
		  apellidos VARCHAR(50),
		  celular VARCHAR(15),
		  correo VARCHAR(100)
		)";
	$wpdb->query($sql);


}

function ltc_Desactivar(){
	flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'ltc_Activar');
register_deactivation_hook(__FILE__, 'ltc_Desactivar');


add_action( 'wp_ajax_do_controllerAux', 'ltc_directory' );

add_action('admin_menu', 'ltc_CrearMenu');

function ltc_CrearMenu(){
	add_menu_page(
		'Men vs Woman', //page title
        'Men vs Woman', //menu title
        'manage_options', //capabilities
        'ltc_index', //menu slug
        'ltc_rdr_index', //function
        null,
    	'2'
    );

    // Init Frontend
    include('init.php');

    // Load Directory
    ltc_directory();
}

function ltc_directory(){
	if(isset($_REQUEST['controller'])){
		include('includes/'.$_REQUEST['controller'].'.php');
		eval("ltc_rdr_".$_REQUEST['controller']."();");
	}else{
		// All Pages
		include('includes/index.php');
	}
}
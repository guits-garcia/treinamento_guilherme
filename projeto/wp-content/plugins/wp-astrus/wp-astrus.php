<?php

/*
 * Plugin Name: Astrusweb Wp-Admin
 * Description: Sistema de painel Administrativo
 * Version: 1.2
 * Author: Astrusweb - Lucas Chiarello
 * Author URI: http://astrusweb.com/
 */

class AstrusAdmin{

	public static function setup(){

	}

	public static function logo_style(){
		wp_enqueue_style( 'logo', plugins_url( '/css/logo.css', __FILE__ ) , array(), null );
	}

	public static function wp_admin_style(){
		wp_enqueue_style( 'admin', plugins_url( '/css/admin.css', __FILE__ ) , array(), null );
	}

	public static function st_welcome_panel() {
		require("welcome_message.php");
	}

	public static function wpbeginner_remove_version() {
		return '';
	}	

	public static function my_version() {
	  return '';
	}

	public static function footer_text() {
		echo 'Astrusweb <a href="https://wordpress.org/">Wordpress</a> 2015';
	}


	public static function admin_redirect(){
	 if( $_SERVER["REQUEST_URI"] == '/admin/' ) {
	  wp_redirect(admin_url());
	  exit();
	 }
	}

}

register_activation_hook(__FILE__, 'AstrusAdmin::setup');

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

remove_action('welcome_panel','wp_welcome_panel'); // retira html bem vindo padrão
add_action('welcome_panel','AstrusAdmin::st_welcome_panel'); // adiciona html do bem vindo

add_filter( 'update_footer', 'AstrusAdmin::my_version', 9999 ); // remove versão footer

add_filter('admin_footer_text', 'AstrusAdmin::footer_text'); //troca texto footer


add_action( 'login_head', 'AstrusAdmin::logo_style' );
add_action( 'admin_head', 'AstrusAdmin::wp_admin_style' );

add_filter('the_generator', 'AstrusAdmin::wpbeginner_remove_version');

add_action('init','AstrusAdmin::admin_redirect'); //redirecionar /admin para /wp-admin

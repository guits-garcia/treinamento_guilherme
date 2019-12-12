<?php
/*
 * Plugin Name: NewsletterAstrus
 * Description: Sistema para cadastro de newsletter
 * Version: 0.2
 * Author: Astrusweb - Jantara
 * Author URI: http://astrusweb.com/
 */

global $wpdb;

class NewsletterAstrus{

	const VERSION = '0.2';

	public static function setup(){
	}

	public static function add_menu_page(){
			add_menu_page( 'Newsletter List', 'Newsletter List', 'edit_posts', __FILE__, 'NewsletterAstrus::menu_page' );
	}

	public static function options_page(){
			require dirname(__FILE__) . '/options.php';
	}

	public static function menu_page(){

			$my_file = 'list.txt';
			$handle = fopen(dirname(__FILE__) . '/' . $my_file, 'w') or die('Cannot open file:  '.$my_file);

			$itens = NewsletterAstrus::newsletter_fetch_all_emails();
			$data = "";

			foreach($itens as $item ){
				$data .= $item -> email . "\n";
			}

			fwrite($handle, $data);
			fclose($handle);

			require dirname(__FILE__) . '/list.php';

	}

	public static function register( $args ){
		global $wpdb;

		$array = array();
		$array['nome']    =   $args['nome'];
		$array['email']    =   $args['email'];
		$array['created_at']   =   date('Y-m-d H:i:s');

		$format = array();
		$format['nome'] = '%s';
		$format['email'] = '%s';
		$format['created_at'] = '%s';

		if(!NewsletterAstrus::is_register( $args['email'] )){
			if($wpdb -> insert( 'wp_newsletter', $array , $format)){
				return 'true';
			}else{
				return 'false';
			}
		}else{
			return 'cadastrado';
		}
	}

  protected static function addLeadConversionToRdstationCrm( $rdstation_token, $identifier, $data_array ) {
    $api_url = "http://www.rdstation.com.br/api/1.2/conversions";
    try {
      if (empty($data_array["token_rdstation"]) && !empty($rdstation_token)) { $data_array["token_rdstation"] = $rdstation_token; }
      if (empty($data_array["identificador"]) && !empty($identifier)) { $data_array["identificador"] = $identifier; }
      if ( !empty($data_array["token_rdstation"]) && !( empty($data_array["email"]) && empty($data_array["email_lead"]) ) ) {
        $data_query = http_build_query($data_array);
        if (in_array ('curl', get_loaded_extensions())) {
          $ch = curl_init($api_url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data_query);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_exec($ch);
          curl_close($ch);
        } else {
          $params = array('http' => array('method' => 'POST', 'content' => $data_query, 'ignore_errors' => true));
          $ctx = stream_context_create($params); 
          $fp = @fopen($api_url, 'rb', false, $ctx);
        }
      }
    } catch (Exception $e) { }
  }

	protected static function newsletter_fetch_email( $email ){
		global $wpdb;
		$email = mysql_real_escape_string($email);
		$query = "SELECT * FROM wp_newsletter where email = '{$email}'";
		return $wpdb->get_results($query, "OBJECT");
	}

	public static function newsletter_fetch_all_emails(){
		global $wpdb;
		$query = "SELECT * FROM wp_newsletter ORDER BY created_at DESC";
		return $wpdb->get_results($query, "OBJECT");
	}

	protected static function is_register( $email ){
		return count(NewsletterAstrus::newsletter_fetch_email( $email )) != 0;
	}

	public function do_register(){
		if(isset($_POST['email']) && wp_verify_nonce($_POST['csrf'],'csrf') ){
			$args = array(
				'email' => mysql_real_escape_string($_POST['email']),
				'nome'  => mysql_real_escape_string($_POST['nome-news'])
			);
			$handle = NewsletterAstrus::register($args);
			die($handle);
		}
	}


	/*
	 * This method is created by Lucas L. Chiarello
	 */
	public function form_register($args=null){
		$form_id = 'newsletter';
		$label = 'Newsletter';
		$placeholder_nome = 'Digite seu Nome';
		$placeholder = 'Digite seu E-mail';
		$submit = 'Enviar';

		if(is_array($args)){
			if(isset($args['form_id'])){
				$form_id = $args['form_id'];
			}
			if(isset($args['label'])){
				$label = $args['label'];
			}
			if(isset($args['placeholder'])){
				$placeholder = $args['placeholder'];
			}
			if(isset($args['submit'])){
				$submit = $args['submit'];
			}
		}

		?>
			<form id="<?= $form_id ?>" method="POST" class="newsletter-form clearfix">
				<?php wp_nonce_field('csrf','csrf'); ?>
				<label><?= $label ?></label>
				<!-- <input type="text" name="nome-news" placeholder="<?= $placeholder_nome ?>" /> -->
				<input type="email" name="email" placeholder="<?= $placeholder ?>" />
				<input type="submit" value="<?= $submit ?>" />
				<div id="msgs-news"></div>
			</form>
		<?
	}
}

if ( !is_admin() )
		return;

register_activation_hook(__FILE__, 'NewsletterAstrus::setup');
add_action('admin_menu', 'NewsletterAstrus::add_menu_page');

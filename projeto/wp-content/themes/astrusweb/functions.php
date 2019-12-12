<?php
/*
 * Theme image support
 */
add_theme_support( 'post-thumbnails' );

@ini_set( 'upload_max_size' , '256M' );
@ini_set( 'post_max_size', '256M');
@ini_set( 'max_execution_time', '1700' );

add_filter('show_admin_bar', '__return_false');
define('FS_METHOD','direct');
add_post_type_support( 'page', 'excerpt' );
remove_action('wp_head', 'wp_generator');

/*
 * Theme CSS include
 */
function load_css() {
	wp_enqueue_style('vendor', get_template_directory_uri() . '/assets/css/vendor.css');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_style('here_maps', 'https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1533195059');
    wp_enqueue_style('aos_animate', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
}
add_action('wp_enqueue_scripts', 'load_css');

/*
 * Theme font include
 */
function load_fonts() {
    wp_enqueue_style('lato', 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap');
    wp_enqueue_style('robotomono', 'https://fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700&display=swap');
}
add_action('wp_enqueue_scripts', 'load_fonts');
/*
 * Theme js include
 */




 
function load_js(){
	wp_deregister_script('jquery');
    wp_enqueue_script('mapsjs-core', 'https://js.api.here.com/v3/3.0/mapsjs-core.js', false, null, true);
    wp_enqueue_script('mapsjs-service', 'https://js.api.here.com/v3/3.0/mapsjs-service.js', false, null, true);
    wp_enqueue_script('mapsjs-ui', 'https://js.api.here.com/v3/3.0/mapsjs-ui.js', false, null, true);
    wp_enqueue_script('mapsjs-mapevents', 'https://js.api.here.com/v3/3.0/mapsjs-mapevents.js', false, null, true);
    wp_enqueue_script('mapsjs-clustering', 'https://js.api.here.com/v3/3.0/mapsjs-clustering.js', false, null, true);
    wp_enqueue_script('jsPlacesDataAPI',  get_template_directory_uri() . '/assets/js/jsPlacesDataAPI.js', false, null, true);
	wp_enqueue_script('vendor',  get_template_directory_uri() . '/assets/js/vendor.js', false, null, true);
    wp_enqueue_script('aos_animate', 'https://unpkg.com/aos@2.3.1/dist/aos.js', false, null, true);
    wp_enqueue_script('default',  get_template_directory_uri() . '/assets/js/default.js', false, null, true);
}
add_action('wp_enqueue_scripts', 'load_js');

/*
 * Theme open file
 */
function openFile ($file) {
	$fp = fopen($file,"r"); 
	return fread($fp,filesize($file));
}

/*
 * Theme send e-mail function
 */
function sendMessageContato($template, $subject, $to=NULL, $reply_to){
	$message = openFile(TEMPLATEPATH . "/assets/emails/contato.html");

	foreach($_POST as $key=>$value){
        if($key == "departamento") {
            $email_id = $value;
            $email_send = get_the_title($email_id);
            $message = str_replace("<".$key.">", nl2br($email_send), $message);
        } else {
            if(is_array($value)){
                $each_vals = '';
                foreach ($value as $k => $v) {
                    $each_vals .= $v . ", ";
                }
                $message = str_replace("<".$key.">", nl2br($each_vals), $message);
            } else {
                $message = str_replace("<".$key.">", nl2br($value), $message);
            }
        }
    }
	$message = str_replace("<link>", get_template_directory_uri(), $message);
	$message = str_replace("<url_site>", get_site_url(), $message);

	if(is_null($to)){
		$to = get_site_value('email');
	}

	$headers = array(
		'Content-type: text/html',
		'Reply-To: '.$reply_to
	);

	if(wp_mail($to, $subject, $message, $headers)){
		$message = 'true';
	} else {
		$message = 'false';
	}
	echo $message;
	die();
}
function sendMessageAssociar($template, $subject, $to=NULL, $reply_to){
    $message = openFile(TEMPLATEPATH . "/assets/emails/associar.html");

    foreach($_POST as $key=>$value){
        if(is_array($value)){
            $each_vals = '';
            foreach ($value as $k => $v) {
                $each_vals .= $v . ", ";
            }
            $message = str_replace("<".$key.">", nl2br($each_vals), $message);
        } else {
            $message = str_replace("<".$key.">", nl2br($value), $message);
        }
    }
    $message = str_replace("<link>", get_template_directory_uri(), $message);
    $message = str_replace("<url_site>", get_site_url(), $message);

    if(is_null($to)){
        $to = get_site_value('email');
    }

    $headers = array(
        'Content-type: text/html',
        'Reply-To: '.$reply_to
    );

    if(wp_mail($to, $subject, $message, $headers)){
        $message = 'true';
    } else {
        $message = 'false';
    }
    echo $message;
    die();
}

function get_meta_id_by_key( $post_id, $meta_key ) {
	global $wpdb;
	$mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", wp_strip_all_tags($post_id), wp_strip_all_tags($meta_key)) );
	if( $mid != '' )
		return (int) $mid;
	return false;
}

function upload_file($file, $directory){
	$dir = WP_CONTENT_DIR . '/files_mf/' . $directory . '/';
	$new_name = md5(date("h:i:sa")) . $_FILES[$file]["name"];

	try{
		$upload = move_uploaded_file($_FILES[$file]["tmp_name"], $dir.$new_name);
	} catch(Exception $e){
		return $e->getMessage();
	}

	if(!$upload)
		return false;

	return $dir.$new_name;
}

function the_slug($permalink){
	$arr = explode('/', $permalink);
	$slug = $arr[count($arr) - 2];
	echo $slug;
}

function get_site_value($value='', $metavalue=false){
	$obj = get_posts('post_type=informacao');
	if ($metavalue) {
		return get_post_meta( $obj[0]->ID, $value, true );
	} else {
		return $obj[0]->$value;
	}
}

function clearText($sub){
	$acentos = array('À','Á','Ã','Â','à','á','ã','â','Ê','É','Í','í','Ó','Õ','Ô','ó','õ','ô','Ú','Ü','Ç','ç','é','ê','ú','ü', '-');
	$remove_acentos = array('a','a','a','a','a','a','a','a','e','e','i','i','o','o','o','o','o','o','u','u','c','c','e','e','u','u', '');
	return str_replace($acentos, $remove_acentos, urldecode($sub));
}

function slug($str){
	$str = clearText($str);
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

function redirect_to($page){
	header("Location: " . $page);
}

function get_term_top_most_parent($term_id, $taxonomy){
   // start from the current term
   $parent  = get_term_by( 'id', $term_id, $taxonomy);
   // climb up the hierarchy until we reach a term with parent = '0'
   while ($parent->parent != '0'){
       $term_id = $parent->parent;

       $parent  = get_term_by( 'id', $term_id, $taxonomy);
   }
   return $parent;
}

// POSTS MAIS VISUALIZADOS
// Verifica se não existe nenhuma função com o nome tutsup_session_start
if ( ! function_exists( 'tutsup_session_start' ) ) {
    // Cria a função
    function tutsup_session_start() {
        // Inicia uma sessão PHP
        if ( ! session_id() ) session_start();
    }
    // Executa a ação
    add_action( 'init', 'tutsup_session_start' );
}

// Verifica se não existe nenhuma função com o nome tp_count_post_views
if ( ! function_exists( 'tp_count_post_views' ) ) {
    // Conta os views do post
    function tp_count_post_views () {	
        // Garante que vamos tratar apenas de posts
        if ( is_single() ) {
        
            // Precisamos da variável $post global para obter o ID do post
            global $post;
            
            // Se a sessão daquele posts não estiver vazia
            if ( empty( $_SESSION[ 'tp_post_counter_' . $post->ID ] ) ) {
                
                // Cria a sessão do posts
                $_SESSION[ 'tp_post_counter_' . $post->ID ] = true;
            
                // Cria ou obtém o valor da chave para contarmos
                $key = 'tp_post_counter';
                $key_value = get_post_meta( $post->ID, $key, true );
                
                // Se a chave estiver vazia, valor será 1
                if ( empty( $key_value ) ) { // Verifica o valor
                    $key_value = 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } else {
                    // Caso contrário, o valor atual + 1
                    $key_value += 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } // Verifica o valor
                
            } // Checa a sessão
            
        } // is_single
        
        return;
        
    }
    add_action( 'get_header', 'tp_count_post_views' );
}

// Monitora as visualizações dos posts
function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


add_action( 'template_redirect', 'page_logout' );
function page_logout( ){
    if ($_SERVER['REQUEST_URI'] == '/logout') {
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        include(dirname(__FILE__) . '/logout.php');
        exit();
    }
}

add_action( 'template_redirect', 'page_result' );
function page_result( ){
    if ($_SERVER['REQUEST_URI'] == '/result') {
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        include(dirname(__FILE__) . '/result.php');
        exit();
    }
}

function up_file($F, $path){
    foreach($F as $file){
        $new_name = md5(time());
        $temp_name = $file['tmp_name'];
        $save_path = WP_CONTENT_DIR . '/files_mf/' . $path . '/';
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        try{
            $enviou = move_uploaded_file($temp_name,$save_path.$new_name.'.'.$ext);
        }catch(Exception $e){
            return $e;
        }
        
        if(!$enviou)
            return 'false';
    }
    return $path.'/'.$new_name.'.'.$ext;
} 


function sh_the_content_by_id( $post_id=0, $more_link_text = null, $stripteaser = false ){
    global $post;
    $post = &get_post($post_id);
    setup_postdata( $post, $more_link_text, $stripteaser );
    the_excerpt();
    wp_reset_postdata();
}

add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

add_action( 'wp_head', 'my_js_gallery_add_gallery_images', 1 );
function my_js_gallery_add_gallery_images(){
	global $post;

	$gallery_images = array();
	$attachments = get_posts( array(
		'post_type' => 'attachment',
		'post_status' => 'inherit',
		'post_parent' => $post->ID,
		'post_mime_type' => 'image',
	) );

	foreach( $attachments as $attachment )
		$gallery_images[] = wp_prepare_attachment_for_js( $attachment->ID );

	wp_localize_script( 'my-js-gallery', 'my_js_gallery', array(
		'images' => $gallery_images,
	) );
}

function searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['type'])) {
            $type = $_GET['type'];
            $query->set('post_type', array($type));
        }       
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');



function ajax_call() {
	wp_localize_script( 'function', 'my_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action("wp_ajax_nopriv_load_clube_descontos", "load_clube_descontos");
add_action("wp_ajax_load_clube_descontos", "load_clube_descontos");

add_action('template_redirect', 'ajax_call');


//funções customizadas


function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
      array_pop($excerpt);
      $excerpt = implode(" ",$excerpt).'...';
    } else {
      $excerpt = implode(" ",$excerpt);
    }	
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
  }


  function disqus_embed($disqus_shortname) {
    global $post;
    wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "'.$disqus_shortname.'";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
    </script>';
}
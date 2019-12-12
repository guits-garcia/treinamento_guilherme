<?php get_header(); 
include 'modal.php';

$args = array(
	'post_parent' => get_the_ID(),
	'post_type' => 'attachment',
	'post_mime_type' => 'image',
	'posts_per_page' => 1, //alterar aqui quando for colocar mais de um banner pra rodar
	'orderby' => 'menu_order',
	'order' => 'ASC',
);
$attachments = get_children( $args );


$post_sobre_params = array(
	'post_type'     => 'conteudo_bela_pedra',
	'posts_per_page' => -1
);
$post_sobre = new WP_Query($post_sobre_params);

?>


<section id="belapedra">



    <?php
        foreach ($attachments as $key => $value) {
                echo "<div class='banner-img' style='background-image:url($value->guid);'></div>";
		};
		?>
		
		<div class="white-bg">

			<?php
	if($post_sobre->have_posts()){
		while($post_sobre->have_posts()){
			$post_sobre->the_post();

	echo "<h1>". get_the_title() .  "</h1>";
	echo "<p>" .get_the_content(). "</p>";
		}
	wp_reset_query();
	}

    ?>
</div>



<?php
	$informacoes_centrais = get_group('informacoes_centrais', $post_sobre->posts[0]->ID);
	
	if (count($informacoes_centrais) > 0) {
?>
		
		<?php foreach ($informacoes_centrais as $key => $value) { 
			echo "<div class='informacoes-centrais' style='background-image:url(". $value['informacoes_centrais_imagem'][1]['original'] .");'>";
			echo "<div class='informacoes-centrais-texto'>";
			echo "<h1>". $value['informacoes_centrais_titulo'][1] . "</h1>";
			echo "<p>" . $value['informacoes_centrais_descricao'][1] . "</p>";

		 } ?>
		</div>
	</div>
<?php } ?>



</div>


<div class="white-bg">

<?php
	$gestao = get_group('gestao_de_pessoas', $post_sobre->posts[0]->ID);
	
	if (count($gestao) > 0) {
?>
		
		<?php foreach ($gestao as $key => $value) { 
			echo "<h1>". $value['gestao_de_pessoas_titulo'][1] . "</h1>";
			echo "<p>" . $value['gestao_de_pessoas_descricao'][1] . "</p>";
		 } ?>
	</div>
<?php } ?>


</div>


<?php
	$caracteristicas = get_group('caracteristicas', $post_sobre->posts[0]->ID);
	
	if (count($caracteristicas) > 0) {
?>
	<div class="caracteristicas-belapedra">
		<?php foreach ($caracteristicas as $key => $value) { 
		
			echo "<div class='caracteristica-single' onclick='displayModal(this.id)' id='" . $value['caracteristicas_titulo'][1] . "'>";
			echo "<image src='". $value['caracteristicas_icone'][1]['original']. "'>";
			echo "<h3>". $value['caracteristicas_titulo'][1] ."</h3>";
			echo "<p>" . $value['caracteristicas_descricao'][1] . "</p>";
		    echo "</div>";
		 } ?>
	</div>
<?php } ?>


</section>


<?php get_footer(); ?>
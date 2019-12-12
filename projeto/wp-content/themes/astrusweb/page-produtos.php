
<?php get_header(); ?>

<?php 
if (($_GET['produto']) == 'pedra'){
    echo "<script>  var botao = document.getElementsByClassName('dropdown-btn');
                    botao[1].classList.remove('ativado');
                    botao[0].classList.add('ativado');
          </script>";
    $tag = get_tag(16); //caso for pedra, esse é o id da tag e estes são os parametros corretos pro query
    $params = array(
        'post_type'   => 'produtos',
        'tag' => 'pedras',
        'posts_per_page' => 4
    );
} else { //caso for semijoia, muda tmb o botão a ser ativado
    echo "<script> var botao = document.getElementsByClassName('dropdown-btn');
          botao[0].classList.remove('ativado'); 
          botao[1].classList.add('ativado');
          </script>";
    $tag = get_tag(17);
    $params = array(
        'post_type'   => 'produtos',
        'tag' => 'semijoias',
        'posts_per_page' => 4
    );
}
?>
<section id='produtos'>

    <div class='semijoias'>
        <h1> <?php echo $tag->name; ?> </h1>
        <p> <?php echo $tag->description; ?> </p>
    </div>

    <div class='fotos-produtos'>
        <?php
            $products= new WP_Query($params);
            if($products->have_posts()){
                while($products->have_posts()){
                    $products->the_post();	
        ?>

        <div class="produto">
            <div class="onclick-mobile" id="<?php echo 'modal' . the_ID(); ?>">
                <div class="onclick-wrapper" >
                    <img src="<?php echo get_the_post_thumbnail_url();?>">
                    <p class="produto-nome"><?php echo get_the_title();?></p>
                    <p class="produto-descricao"><?php echo get_the_content();?></p>
                </div>
            </div>
            <p class="trigger" data-modal="<?php echo 'modal' .the_ID() ; ?>" >
                <img src="<?php echo get_the_post_thumbnail_url();?>">
            </p>
            <div class="prod-info">
                <p class="produto-nome"><?php echo get_the_title();?></p>
                <p class="produto-descricao"><?php echo get_the_content();?></p>
            </div>
        </div>

        <?php
            }
            wp_reset_query();
            }
        ?>
    </div>

</section>

<?php get_footer();?>
<?php
/**
 * The template for displaying all single posts and attachments
 * @link http://localhost/projetoguilherme/index.php/single-php/

 **/

 get_header();
 ?>

<section id="singles"> 
    <div class="single-wrapper">
        <div class="single-left">
            <p><?php $categoria = get_the_category(); echo $categoria[0]->name;?></p>
            <h1><?php echo get_the_title();?></h1>
            <p><?php echo get_the_date();?></p>

            <img src="<?php echo get_the_post_thumbnail_url();?>">

            <article><?php
            
            global $post;
            $content = $post->post_content;
            
            echo $content; ?></article>

            <img src="<?php echo get_the_post_thumbnail_url();?>">

            <article id="artigo-com-borda"><?php echo $content;?></article>
            <div class="face-twit-share">
                <a href='https://facebook.com'><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-share-button.png"></a>
                <a href='https://twitter.com'><img src="<?php echo get_template_directory_uri(); ?>/images/share-twitter.png"></a>
            </div>
            <div class="disqus-desktop">
                <?php disqus_embed('http-localhost-projetoguilherme'); ?>
                <a href='http://localhost/projetoguilherme/index.php/blog/' id='voltar-button'>&laquo;&nbsp;&nbsp;&nbsp;VOLTAR</a>
            </div>

        </div>
        <div class="single-right">
            <div class="div-margin">
                <h2>MAIS LIDOS</h2>
            </div>


            <?php
                    $params = array(
                    'post_type'   => 'post',
                    'posts_per_page' => 3
                    );
                    $posts_mais_lidos = new WP_Query($params);
                    if($posts_mais_lidos->have_posts()){
                        while($posts_mais_lidos->have_posts()){
                            $posts_mais_lidos->the_post();
                ?>

            <div class="div-margin">
                <a href="<?php echo get_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url();?>"></a>
                <p><?php $categoria = get_the_category(); echo $categoria[0]->name;?></p>
                <h3><?php echo get_the_title();?></h3>
                <p style="margin-bottom:15px";><?php echo get_the_date();?></p>
                <article>Vou digitar até fechar 37 palavras que é mais ou menos o número de palavras que eu contei ter no</article>
            </div>

            <?php
                }
                    wp_reset_query();
                }
                ?>
        </div>
        <div class="form_holder">
            <?php wp_pagenavi(); ?> 
        </div>
     
        <div class="categorias-list">

    <?php
    $categorias = get_categories();
    ?>
        <p>CATEGORIAS</p>
        <?php foreach($categorias as $categoria){
            $cat_nome = $categoria->name;
            $cat_id = $categoria->cat_ID;
            if ($cat_id == $cat_da_pagina[0]->term_id){
                echo "<a href='".get_category_link($cat_id)."' class='seletor-categoria-blog ativado'>".$cat_nome."</a>";
            } else {
                echo "<a href='".get_category_link($cat_id)."' class='seletor-categoria-blog'>".$cat_nome."</a>";
            }
            
        } ?>
</div>

   
    
</section>
<?php get_footer(); ?>
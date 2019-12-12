<?php 
get_header();
?>


<section id="blog-posts">

<?php

    $params = array(
        'post_type'     => 'post',
        'posts_per_page' => 6,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );

    $posts = new WP_Query($params);
	if($posts->have_posts()){
		while($posts->have_posts()){
                $posts->the_post();
            
            
            ?>
    
<div class="post">
        <img src="<?php echo get_the_post_thumbnail_url();?>">
        <div class="blog-desc">
            <p class="blog-legenda"><?php   $cat_array = get_the_category(); $cat_array_name = $cat_array[0]->name; echo $cat_array_name; ?></p>
            <h1><?php echo get_the_title(); ?></h1>
            <p class="blog-data"><?php echo get_the_date(); ?></p>
            <p class="blog-summ"><?php echo excerpt(27);?></p>
            <a href="<?php echo get_permalink() ?>">LEIA MAIS</a>
        </div>      
</div>
   
    <?php
			}
				wp_reset_query();
			}
			?>

         

</section>

<div class="form_holder">
    <?php wp_pagenavi( array( 'query' => $posts ) ); ?> 
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
    <div class="spacer"></div>
    

    <input type="text" class="s" placeholder="Insira os termos da pesquisa.">
    <div class="spacer"></div>
</div>

<?php 
get_footer();
?>
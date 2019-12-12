<?php 
get_header();
?>


<?php $cat_da_pagina = get_the_category();?>
<section id="blog-posts">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="post" data-aos="fade-left">
        <?php the_post_thumbnail();?>
        <div class="blog-desc">
            <p class="blog-legenda"><?php //$cat_array = the_category(); $cat_array_name = $cat_array[0]->name; echo $cat_array_name; //the_category();  ?></p>
            <h1><?php the_title(); ?></h1>
            <p class="blog-data"><?php the_date(); ?></p>
            <p class="blog-summ"><?php echo excerpt(27);?></p>
            <a href="<?php the_permalink() ?>">LEIA MAIS</a>
        </div>      
</div>
        <?php endwhile; else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
   

</section>

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
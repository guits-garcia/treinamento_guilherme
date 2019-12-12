<?php get_header();

include 'modal.php'; //chama o html do modal
?>
<section id="processos">
    <div class="procs-wrapper">
        <div class="proc-title">
            <h1>
                <?php 
                $obj = get_post_type_object( 'processos' );
                echo $obj->name;
                ?>
            </h1>
        </div>
        <div class="proc-desc">
                <p><?php echo $obj->description; ?> </p>
        </div>


        <div class="proc-list">
            <?php
            $params = array(
                'post_type'   => 'processos',
                'posts_per_page' => 9
                            );
                                $procs= new WP_Query($params);
                                if($procs->have_posts()){
                                        while($procs->have_posts()){
                                            $procs->the_post();	
            ?>

<?php echo "<div class='proc' onclick='displayModal(this.id)' id='" . get_the_title() . "'>";
            echo "<img src='" . get_the_post_thumbnail_url() . "'>";
                    echo "<h2>". get_the_title() .  "</h2>"; 
                    echo "<p>" . get_the_content() . "</p>"; ?>
            </div>     
    
            <?php 
                    }
                        wp_reset_query();
                    }
                    ?>
                
        </div>
    </div>
    

</section>




<?php 

get_footer(); ?>


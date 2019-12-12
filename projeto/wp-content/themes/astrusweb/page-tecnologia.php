<?php get_header(); 
include 'modal.php'; //chama o html do modal
?>

<section id="tecnologia">

<?php
    $obj = get_post_type_object( 'processos' );
    echo "<h1>".$obj->name."</h1>";
    echo $obj->description;
 ?>
    <div class="tecs-wrapper">
<?php
    $params = array(
        'post_type'   => 'tecnologias',
        'posts_per_page' => 8
        );
        $tecs= new WP_Query($params);
        if($tecs->have_posts()){
            while($tecs->have_posts()){
                $tecs->the_post();
        
                echo "<div class='tec' onclick='displayModal(this.id)' id='" . get_the_title() . "'>";
                echo "<img src='" . get_the_post_thumbnail_url() . "'>";
                echo "<h2>". get_the_title() .  "</h2>"; 
                echo "<p>" . get_the_content() . "</p>";
                echo "</div>";
            }
        wp_reset_query();
        }
        ?>
    </div>


</section>
<?php 

get_footer(); ?>
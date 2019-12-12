<?php
	get_header();
?>

<section id="banner-primeiro-sec">
	<?php
	$params = array(
		'post_type'   => 'banner',
		'posts_per_page' => 6
	  	);
	$banner= new WP_Query($params);
	if($banner->have_posts()){
		while($banner->have_posts()){
			$banner->the_post();
	?>

	<div class="banner-primeiro" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
		<p><?php echo get_the_title();?></p>
		<div class="scroll-down-box">
			<p>Scroll</p>
			<p><i class="fas fa-chevron-down"></i></p>
		</div>
	</div>

	<?php
			}
				wp_reset_query();
			}
			?>
</section>

<section id="banner-segundo-sec">
	
				<?php
					$params = array(
					'post_type'   => 'banner_home_centro',
					'posts_per_page' => 2
					);
					$banner_home_centro= new WP_Query($params);
					if($banner_home_centro->have_posts()){
						while($banner_home_centro->have_posts()){
							$banner_home_centro->the_post();
				?>
	<div class="banner-segundo" >
		<div class="blank-bg">
			<div class="desc">
				<div class="descric">
					<h4><?php echo get_the_title();?></h4>
					<p><?php echo get_the_content();?></p>
				</div>
			</div>
			<div class="img-holder"><img src="<?php echo get_the_post_thumbnail_url(); ?>"></div>
		</div>
	</div>
			<?php
				}
					wp_reset_query();
				}
				?>
		
</section>

<section id="banner-terceiro-sec">
	<div class="wrapper-geralzao">
		<div class="wrapper-col">
				<div class="wrap-row1">
					<div class="inner-col">
						<div class='div1'><p><i class='fas fa-pencil-alt'></i></p><p>Blog da BELAPEDRA</p></div>
		<?php $params = array(
							'post_type'   => 'post',
							'posts_per_page' => 5,
							'tag' => 'home_page'
						);
			  $banner= new WP_Query($params);
		?>
		
			  <?php $contador_div = 0;	
			  if($banner->have_posts()){
					while($banner->have_posts()){
						$banner->the_post();
						
						switch($contador_div) {
							case 0:
								echo "<div class='div2' style='background-image:url(". get_the_post_thumbnail_url() .")' ><a href='".get_the_permalink()."'><p>". get_the_title()."</p><span>". get_the_date()."</span><h4>".excerpt(8)."</h4></a></div>
							</div>";
								$contador_div++;
								break;
							case 1:
								echo "<div class='div3' style='background-image:url(". get_the_post_thumbnail_url() .")'><a href='".get_the_permalink()."'><p>". get_the_title()."</p><span>". get_the_date()."</span><h4>".excerpt(12)."</h4></a></div>
								</div>
								<div class='wrap-row2'>";
								$contador_div++;
								break;
							case 2:
							echo "<div class='div4' style='background-image:url(". get_the_post_thumbnail_url() .")'><a href='".get_the_permalink()."'><p>". get_the_title()."</p><span>". get_the_date()."</span><h4>".excerpt(8)."</h4></a></div>";
								$contador_div++;
								break;
							case 3:
							echo "<div class='div5' style='background-image:url(". get_the_post_thumbnail_url() .")'><a href='".get_the_permalink()."'><p>". get_the_title()."</p><span>". get_the_date()."</span><h4>".excerpt(8)."</h4></a></div>";
								$contador_div++;
								break;
							case 4:
							echo "<div class='div6' style='background-image:url(". get_the_post_thumbnail_url() .")'><a href='".get_the_permalink()."'><p>". get_the_title()."</p><span>". get_the_date()."</span><h4>".excerpt(8)."</h4></a></div>";
								echo "	</div>
									</div>
									</div>";
									
								$contador_div++;
								break;
						}
					}
					wp_reset_query();
				} 
		?>
</section>

<?php
					$params = array(
						'post_type'   => 'caracteristicas',
						'posts_per_page' => 7
						);
					$banner= new WP_Query($params);
					if($banner->have_posts()){
						$contador = 0;
							while($banner->have_posts()){
								$banner->the_post();	
								if ($banner->current_post == 0){
									echo "<div class='caracteristicas' style='background-image:url(".get_the_post_thumbnail_url().")'>";
									echo "<div class='caracteristicas-top'><div class='enunciado-caract'><p>" .get_the_title() . "</p></div></div>";
									echo "<div class='caracteristicas-bottom'>";
								} else if ($banner->current_post == 6) {
									echo "<div class='caract'><img src='". get_the_post_thumbnail_url() ."'><p class='caract-title'>". get_the_title() ."</p><div class='caract-desc'><p>". get_the_content() ."</p></div></div></div></div>";
									} else {
										echo "<div class='caract'><img src='". get_the_post_thumbnail_url() ."'><p class='caract-title'>". get_the_title() ."</p><div class='caract-desc'>". get_the_content() ."</div></div>";
									}

			}
				wp_reset_query();
			}
			?>


<?php
	get_footer();
?>
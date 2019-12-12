<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label for="s" class="assistive-text"><?php _e( 'Search', 'twentyeleven' ); ?></label>
<input type="text" class="field fas fa-lg" name="s" id="s" placeholder="&#xf002" />
<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'twentyeleven' ); ?>" />
</form>
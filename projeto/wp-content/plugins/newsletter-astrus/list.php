<?php

if (!defined('WP_ADMIN'))
  return wp_die('Saia!');
?>

<div class="wrap">
  <h1><?php _e('Newsletter List', 'newsletter-astrus') ?></h1>
  <textarea style="width: 100%;" rows="20" name="newsletter_list" ><?php echo $data ?></textarea>
</div>


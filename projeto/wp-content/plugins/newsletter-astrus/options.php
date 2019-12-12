<?php

if (!defined('WP_ADMIN'))
  return wp_die('Saia!');
?>

<?php $itens = NewsletterAstrus::newsletter_fetch_all_emails(); ?>

<div class="wrap">
  <h1><?php _e('Newsletter', 'newsletter-astrus') ?></h1>
  <table class="wp-list-table widefat fixed">
    <thead>
      <tr>
        <th>Email</th>
        <th>Criado</th>
      </tr>
    </thead>
    <?php if (count($itens) > 0) { ?>
      <tbody>
        <?php foreach($itens as $i => $it){ ?>
          <tr class="<?php echo $i%2==0 ? 'alternate' : '' ; ?>">
            <th><?php echo $it -> email ?></th>
            <th><?php echo strftime ( '%d/%m/%Y - %H:%M:%S', strtotime($it -> created_at)) ?></th>
          </tr>
        <?php } ?>
      </tbody>
    <?php } else { ?>
      <tbody>
          <tr>
            <th colspan="2" >Nenhum item cadastrado!</th>
          </tr>
      </tbody>
    <?php } ?>
    <tfoot>
      <tr>
        <th>Email</th>
        <th>Criado</th>
      </tr>
    </tfoot>
  </table>
</div>


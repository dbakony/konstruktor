<?php use_helper('I18N', 'Date') ?>
<?php include_partial('affiliate/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Affiliate', array(), 'messages') ?></h1>

  <?php include_partial('affiliate/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('affiliate/form_header', array('jobeet_affiliate' => $jobeet_affiliate, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('affiliate/form', array('jobeet_affiliate' => $jobeet_affiliate, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('affiliate/form_footer', array('jobeet_affiliate' => $jobeet_affiliate, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>

<td colspan="4">
  <?php echo __('%%is_active%% - %%url%% - %%email%% - %%token%%', array('%%is_active%%' => get_partial('affiliate/list_field_boolean', array('value' => $jobeet_affiliate->getIsActive())), '%%url%%' => $jobeet_affiliate->getUrl(), '%%email%%' => $jobeet_affiliate->getEmail(), '%%token%%' => $jobeet_affiliate->getToken()), 'messages') ?>
</td>

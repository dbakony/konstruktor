<?php

/**
 * JobeetCategory form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetCategoryForm extends BaseJobeetCategoryForm
{
  public function configure()
  {
      unset($this['created_at'], $this['updated_at'], $this['jobeet_affiliates_list']); //ezek a mezők nem kellenek a formra
      $this->embedI18n(array('en', 'fr'));
      $this->widgetSchema->setLabel('en', 'English'); //mezőfelirat
      $this->widgetSchema->setLabel('fr', 'French');  //mezőfelirat  
  }
}

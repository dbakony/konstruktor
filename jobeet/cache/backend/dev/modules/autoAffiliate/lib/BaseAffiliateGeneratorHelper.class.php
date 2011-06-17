<?php

/**
 * affiliate module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage affiliate
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAffiliateGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'jobeet_affiliate' : 'jobeet_affiliate_'.$action;
  }
}

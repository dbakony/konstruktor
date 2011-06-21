<?php

/**
 * language actions.
 *
 * @package    jobeet
 * @subpackage language
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageActions extends sfActions
{
  public function executeChangeLanguage(sfWebRequest $request) //nyelvváltás
  {
    $form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'fr'))
    ); // a nyelvválasztó form kirakása
    $form->disableLocalCSRFProtection();
    $form->process($request);
 
    return $this->redirect('localized_homepage'); // átirányítás a localized homepage route-ra
  }
  /*public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }*/
}

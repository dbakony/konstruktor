<?php

require_once dirname(__FILE__).'/../lib/affiliateGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/affiliateGeneratorHelper.class.php';

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateActions extends autoAffiliateActions
{
   
  public function executeListActivate() //aktiválja a feliratkozást és levelet küld a feliratkozónak
  {
     $affiliate = $this->getRoute()->getObject();
     $affiliate->activate(); // aktiválás
    // levél összeállítása
    $message = $this->getMailer()->compose(
      array('davidbakony@yahoo.co.uk' => 'Jobeet Bot'),
      $affiliate->getEmail(),
      'Jobeet affiliate token',
      <<<EOF
Your Jobeet affiliate account has been activated.
 
Your token is {$affiliate->getToken()}.
 
The Jobeet Bot.
EOF
    );
 
    $this->getMailer()->send($message); //levél elküldése
 
    $this->redirect('jobeet_affiliate'); //visszairányítás az affiliate oldalra
  }
 
  public function executeListDeactivate() //deaktiválás
  {
    $this->getRoute()->getObject()->deactivate();
 
    $this->redirect('jobeet_affiliate');
  }
 
  public function executeBatchActivate(sfWebRequest $request) //csoportos aktiválás
  {
    $q = Doctrine_Query::create()
      ->from('JobeetAffiliate a')
      ->whereIn('a.id', $request->getParameter('ids')); //kigyűjtjük az affiliate táblából a kijelölt elemeket where id in (elem1,elem2,elem4)
 
    $affiliates = $q->execute(); //query futtat
 
    foreach ($affiliates as $affiliate) // végigmegyünk a lekérdezett elemeken
    {
      $affiliate->activate(); // és aktiváljuk
    }
 
    $this->redirect('jobeet_affiliate'); // átirányítás az affiliate oldalra
  }
 
  public function executeBatchDeactivate(sfWebRequest $request) // deaktiválás
  {
    $q = Doctrine_Query::create()
      ->from('JobeetAffiliate a')
      ->whereIn('a.id', $request->getParameter('ids')); //kigyűjtjük az affiliate táblából a kijelölt elemeket where id in (elem1,elem2,elem4)
 
    $affiliates = $q->execute();
 
    foreach ($affiliates as $affiliate) // végigmegyünk a lekérdezett elemeken
    {
      $affiliate->deactivate(); // deaktiválás
    }
 
    $this->redirect('jobeet_affiliate'); // átirányítás az affiliate oldalra
  }

}

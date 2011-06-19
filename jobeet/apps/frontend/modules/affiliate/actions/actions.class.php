<?php

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateActions extends sfActions
{
  public function executeWait(sfWebRequest $request)
    {
    }
    
  public function executeNew(sfWebRequest $request) // egy új, üres affiliate form kirakása, a user érdeklődik egy állásról
  {
    $this->form = new JobeetAffiliateForm(); //kirakuknk egy üres formot, hogy kitölthesse
  }

  public function executeCreate(sfWebRequest $request) // a user rányomott a submit gombra
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST)); //404 oldalra irányítjuk ha a method esetleg get lenne
 
    $this->form = new JobeetAffiliateForm(); 

    $this->processForm($request, $this->form); // form validálás és mentés 
    //ha nem valid visszarakjuk a formot
    $this->setTemplate('new');
  }

  
  protected function processForm(sfWebRequest $request, sfForm $form) //form validláls és mentés
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));  //a formot kitöltjük a postolt adatokkal
    if ($form->isValid()) //ha a form valid
    {
      $jobeet_affiliate = $form->save(); //mentjük

      $this->redirect($this->generateUrl('affiliate_wait', $jobeet_affiliate)); //és visszairányítunk a affiliate nyugtázó oldalra //waitsuccess
      //ahol üzenetet kap, hogy aktiválás után majd ....
    }
  }
}

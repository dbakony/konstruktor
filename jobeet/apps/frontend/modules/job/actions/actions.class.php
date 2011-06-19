<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeSearch(sfWebRequest $request) // szabadszöveges keresés 
  {
          $this->forwardUnless($query = $request->getParameter('query'), 'job', 'index'); // ha üresen hagyta a keresés mezőt, akkor visszadobjuk a job modul index actionjára magyarul megjelenítjük a az álláshirdetéseket
 
          $this->jobs = Doctrine_Core::getTable('JobeetJob')->getForLuceneQuery($query);

          if ($request->isXmlHttpRequest())
          {
            if ('*' == $query || !$this->jobs) // ha nincs eredmény
            {
              return $this->renderText('No results.'); //kiírjuk, hogy nincs eredmény
            }

            return $this->renderPartial('job/list', array('jobs' => $this->jobs)); //különben az álláshirdetéslista jelenik meg
          }
  }
    
  public function executeIndex(sfWebRequest $request) // megjeleníti az álláshirdetés listát
  {
    if (!$request->getParameter('sf_culture')) //ha nem létezik a sf_culture paraméter
      {
        if ($this->getUser()->isFirstRequest()) // ha ez a user legelső látogatása
        {
          $culture = $request->getPreferredCulture(array('en', 'fr')); //kiválasztjuk a preferált nyelvet
          $this->getUser()->setCulture($culture); //és beállítjuk az oldalon
          $this->getUser()->isFirstRequest(false); // és falsra állítjuk a fgv-t, hogy rendszer ne higgye azt többé, hogy ez az első látogatása
        }
        else
        {
          $culture = $this->getUser()->getCulture(); // ha nem a legelső látogatása, akkor az oldalon a user nyelvét használjuk
        }

        $this->redirect('localized_homepage'); //átirányíjuk a localized homepage route-ra
      }

      $this->categories = Doctrine_Core::getTable('JobeetCategory')->getWithJobs(); // kilistázzuk a kategóriánként az állásajánlatokat
  }

  public function executeShow(sfWebRequest $request)
  {
      $this->job = $this->getRoute()->getObject();
      
      $this->getUser()->addJobToHistory($this->job); //meghívjuk a job letároló függvényt
     
  
  }

  public function executeNew(sfWebRequest $request) //új álláshirdetés, üres form
  {
       $job = new JobeetJob();
       $job->setType('full-time'); //beállítjuk a munka típus radiogroup-ot full time-ra
       $this->form = new JobeetJobForm($job); //és átadjuk a formnak
  }

  public function executeCreate(sfWebRequest $request) //a user rányomott a submit gombra, validálunk és mentünk
  
    {
      $this->form = new JobeetJobForm();
      $this->processForm($request, $this->form); //validálás és mentés
      //ha nem sikerült
      $this->setTemplate('new');
    }

  public function executeEdit(sfWebRequest $request) // álláshirdetés szerkesztése
    {
      $job = $this->getRoute()->getObject();
      $this->forward404If($job->getIsActivated()); //ha egy álláshirdetés aktiválva van, akkor már nem lehet szerkeszteni

      $this->form = new JobeetJobForm($job); //az adott job adataival kitöltött form
    }

  public function executeUpdate(sfWebRequest $request) // edit után submit
    {
      $this->form = new JobeetJobForm($this->getRoute()->getObject());
      $this->processForm($request, $this->form); // form validálás
      //ha nem sikerült
      $this->setTemplate('edit');
    }

  public function executeDelete(sfWebRequest $request) // job törlése
    {
      $request->checkCSRFProtection();

      $job = $this->getRoute()->getObject();
      $job->delete(); // törlés

      $this->redirect('job/index');
    }

  protected function processForm(sfWebRequest $request, sfForm $form)
    {
      
      //kitöltjük a formot a user által megadott adatokkal
      $form->bind(
        $request->getParameter($form->getName()),
        $request->getFiles($form->getName())
      );
      //a kitöltött formot validáljuk
      if ($form->isValid()) //ha sikerült, mentünk
      {
        $job = $form->save();

        $this->redirect('job_show', $job); //átirányítjuk a user a job prewiev oldalra, hogy publisholhassa a jobot
      }
    }
    public function executePublish(sfWebRequest $request) //álláshirdetés publikálása
        {
          $request->checkCSRFProtection();

          $job = $this->getRoute()->getObject();
          $job->publish(); //publikálás

          $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

          $this->redirect('job_show_user', $job); // álláshirdetések megjelenítése
        }
   public function executeExtend(sfWebRequest $request) //állláshirdetés lejáratának meghosszabbítása 
        {
          $request->checkCSRFProtection();

          $job = $this->getRoute()->getObject();
          $this->forward404Unless($job->extend()); //kiterjesztés

          $this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getDateTimeObject('expires_at')->format('m/d/Y')));

          $this->redirect('job_show_user', $job); //Álláshirdetések megjelenítése
        }     
        
        
   public function executeFooBar(sfWebRequest $request)
    {
        $this->foo = 'bar';
        $this->bar = array('bar', 'baz');
    }
}

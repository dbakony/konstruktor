<?php

require_once dirname(__FILE__).'/../lib/jobGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/jobGeneratorHelper.class.php';

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends autoJobActions
{
    public function executeBatchExtend(sfWebRequest $request) //álláshirdetések lejárati határidejének csoportos kiterjesztése a configban beállított napokkal
      {
        $ids = $request->getParameter('ids');

        $q = Doctrine_Query::create() // lekérdezés létrehozása
          ->from('JobeetJob j') // a jobbeetjob táblából
          ->whereIn('j.id', $ids); //lekérdezzük a kijelölt álláshirdetéseket where id in (elem1,elem2,elem3)

        foreach ($q->execute() as $job)
        {
          $job->extend(true); //kiterjesztés
        }

        $this->getUser()->setFlash('notice', 'The selected jobs have been extended successfully.');

        $this->redirect('jobeet_job'); //visszairányítás a job oldalra álláshirdetéslista
      }
      
    public function executeListExtend(sfWebRequest $request) // egy adott álláshirdetés kiterjesztése
      {
        $job = $this->getRoute()->getObject(); // az adott állás objektumának kinyerése (retrieve)
        $job->extend(true); //kiterjesztés

        $this->getUser()->setFlash('notice', 'The selected jobs have been extended successfully.'); // üzenet a sikerről

        $this->redirect('jobeet_job');
      }
    
    public function executeListDeleteNeverActivated(sfWebRequest $request)
      {
        $nb = Doctrine_Core::getTable('JobeetJob')->cleanup(60); // töröljük a 60 napnál régebbi sosem aktivált álláshirdetéseket a cleanup fgv-el

        if ($nb) //ha volt ilyen
        {
          $this->getUser()->setFlash('notice', sprintf('%d never activated jobs have been deleted successfully.', $nb)); //kiírjuk
        }
        else
        {
          $this->getUser()->setFlash('notice', 'No job to delete.'); // különben ezt írjuk ki
        }

        $this->redirect('jobeet_job');
      }
}

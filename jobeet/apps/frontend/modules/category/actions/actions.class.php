<?php

class categoryActions extends sfActions
{
  public function executeShow(sfWebRequest $request) //akkor fut le ha a user kategóriára kattint
  {
    $this->category = $this->getRoute()->getObject();
    //példányosítunk egy új pagert oldalanként 20 eredménnyel // ennek elvileg configból kéne jönnie, de az sajnos nem megy
    $this->pager = new sfDoctrinePager(
    'JobeetJob',
    10
    );
    $this->pager->setQuery($this->category->getActiveJobsQuery()); // lekérdezzük a kategóriához tartozó aktív munkákat
    $this->pager->setPage($request->getParameter('page', 1)); //beállunk az első oldalra
    $this->pager->init();
    }
}
?>
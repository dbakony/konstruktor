<?php

class myUser extends sfGuardSecurityUser
{
     public function resetJobHistory()
      {
        $this->getAttributeHolder()->remove('job_history');
      } 
    
    public function addJobToHistory(JobeetJob $job)
      {
        $ids = $this->getAttribute('job_history', array());

        if (!in_array($job->getId(), $ids)) // a meglátogatott munka id-je még nincs a tömbben
        {
          array_unshift($ids, $job->getId()); //akkor beletesszük

          $this->setAttribute('job_history', array_slice($ids, 0, 3)); //a job history attribútumban tároljuk az ids tomb első 3 elemét, tehát az utolsó 3 meglátogatott munkát
        }
      }
      
  public function getJobHistory()
  {
    $ids = $this->getAttribute('job_history', array()); //felgyűjtjük a jobhistory attribútumban található jobid-ket 
 
    if (!empty($ids)) //ha nem üres
    {
      return Doctrine_Core::getTable('JobeetJob') // dobunk egy lekérdezést a JobeetJob táblán ahol id in (id1,id2,id3)
        ->createQuery('a')
        ->whereIn('a.id', $ids)
        ->execute()
      ;
    }
 
    return array();
  }
      
    
}

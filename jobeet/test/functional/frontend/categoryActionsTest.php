<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
 
$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();
 
$browser->info('1 - The category page')->
  info('  1.1 - Categories on homepage are clickable')->
  get('/')->
  click('Programming')->
  with('request')->begin()->
    isParameter('module', 'category')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  info(sprintf('  1.2 - Categories with more than %s jobs also have a "more" link', 10))->
  get('/')->
  click('27')->
  with('request')->begin()->
    isParameter('module', 'category')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  info(sprintf('  1.3 - Only %s jobs are listed', 20))->
  with('response')->checkElement('.jobs tr', 20)->
 
  info('  1.4 - The job listed is paginated')->
  with('response')->begin()->
    checkElement('.pagination_desc', '/32 jobs/')->
    checkElement('.pagination_desc', '#page 1/2#')->
  end()->
 
  click('2')->
  with('request')->begin()->
    isParameter('page', 2)->
  end()->
  with('response')->checkElement('.pagination_desc', '#page 2/2#')
;

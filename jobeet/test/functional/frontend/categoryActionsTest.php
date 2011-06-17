<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');
 
$browser = new sfTestBrowser();
Doctrine_Core::loadData(sfConfig::get('sf_test_dir').'/fixtures');

$browser->info('1 - The category page');
$browser->info('  1.1 - Categories on homepage are clickable');

$browser->get('/');
$browser->click('Programming');
$browser->with('request');
$browser->begin();

$browser->isParameter('module', 'category');

$browser->isParameter('action', 'show');
$browser->isParameter('slug', 'programming');
$browser->end();


  $browser->info(sprintf('  1.2 - Categories with more than %s jobs also have a "more" link', sfConfig::get('app_max_jobs_on_homepage')));
  $browser->get('/');
  $browser->click('27');
  $browser->with('request');
  $browser->begin();
  $browser->isParameter('module', 'category');
  $browser->isParameter('action', 'show');
  $browser->isParameter('slug', 'programming');
  $browser->end();
 
  $browser->info(sprintf('  1.3 - Only %s jobs are listed', sfConfig::get('app_max_jobs_on_category')));
  $browser->with('response');
  $browser->checkElement('.jobs tr', sfConfig::get('app_max_jobs_on_category'));
 
  $browser->info('  1.4 - The job listed is paginated');
  $browser->with('response');
  $browser->begin();
  $browser->checkElement('.pagination_desc', '/32 jobs/');
  $browser->checkElement('.pagination_desc', '#page 1/2#')->
  $browser->end();
 
  $browser->click('2');
  $browser->with('request');
  $browser->begin();
  $browser->isParameter('page', 2);
  $browser->end();
  $browser->with('response')->checkElement('.pagination_desc', '#page 2/2#');
?>
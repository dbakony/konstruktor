<?php use_stylesheet('job.css') //job.css betöltése ?>
<?php use_helper('Text') ?>
<?php slot(
  'title',
  sprintf('%s is looking for a %s', $job->getCompany(), $job->getPosition()))
?> 
<?php if ($sf_request->getParameter('token') == $job->getToken()): //ha tokenes url-el jön az oldalra az ember, akkor... ?>
  <?php include_partial('job/admin', array('job' => $job)) // kirakjuk neki az admin toolbart ?>
<?php endif ?>

<div id="job">
  <h1><?php echo $job->getCompany() //cég nevének kiírása ?></h1>
  <h2><?php echo $job->getLocation()//ország város kiírása  ?></h2>
  <h3>
    <?php echo $job->getPosition() //pozíció kiírása ?>
    <small> - <?php echo $job->getType()//típus kiírása (full ime part time freelance) ?></small>
  </h3>
 
  <?php if ($job->getLogo()): ?>
    <div class="logo">
      <a href="<?php echo $job->getUrl() ?>">
        <img src="/uploads/jobs/<?php echo $job->getLogo() ?>"alt="<?php echo $job->getCompany() ?> logo" />
      </a>
    </div>
  <?php endif ?>
 
  <div class="description">
    <?php echo simple_format_text($job->getDescription()) //állás leírása ?>
  </div>
 
  <h4>How to apply?</h4>
 
  <p class="how_to_apply"><?php echo $job->getHowToApply() //hogy kell jelentkezni ?></p>
 
  <div class="meta">
    <small>posted on <?php echo $job->getDateTimeObject('created_at')->format('m/d/Y') ?></small>
  </div>
 
<!--  <div style="padding: 20px 0">
    <a href="<?php echo url_for('job_edit', $job) ?>">Edit</a>
  </div>
-->
</div>
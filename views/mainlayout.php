<!-- Main Layout Template for Pages -->
<?php if(!isset($_SESSION)) session_start(); ?>
<?php require_once('commons/header.php') ?>
<?php require_once('commons/navleft.php') ?>
  <div class="app-main__outer">
  <div class="app-main__inner">
      <!-- PAGE TITLE -->
      <div class="app-page-title">
          <div class="page-title-wrapper">
              <div class="page-title-heading ">
                  <div><?= $title; ?> <div class="page-title-subheading"><?= $subtitle; ?></div></div> 
              </div>    
          </div>
      </div>            
      <?php require_once($page) ?> 
<?php require_once('commons/footer.php') ?>
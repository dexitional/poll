<?php
$role = $_SESSION['ROLE'];
$constituency = $_SESSION['CONSTITUENCY'];
$polling_station = $_SESSION['STATION'];
$sys_user_name = $_SESSIION['USER'];
?>

<?php //ini_set("display_errors", 1); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">  App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
        
        <li class="nav-item">
            <a class="nav-link" href="../controllers/Elections?polling_sheet=1">Sheet</a>
        </li>
        
        <?php if($role){ ?>
        
        <?php } ?>
        
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Logout</a>
            </li>
        
        </ul>
  </div>
</nav>
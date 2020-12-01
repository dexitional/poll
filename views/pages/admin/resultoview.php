<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?= strtoupper($vars['election_name']); ?> MONITORING</title>
    
<link rel="stylesheet" href="<?= $_SESSION['asset']?>/public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= $_SESSION['asset']?>//public/css/main_style.css">  
 
</head>

<body class="result-body">
   
    <h1 class="main-title"><?= strtoupper($vars['constituency_name']); ?> CONSTITUENCY</h1>
   
    <div class="result-cover">
        <div class="result-cast">TURNOUT: <?= $pres[0]['total_votes_cast'] ?></div>
        <div class="result-reject">REJECTED: <?= $pres[0]['rejected_votes'] ?></div>
        <h2 class="result-title">
            PRESIDENTIAL RESULT
        </h2>
        <?php 
            if(count($pres) > 0){
              foreach($pres  as $row){
        ?> 
        
        <div class="can-cover">
             <div class="can-party">
                <img src="./public/images/<?= strtolower($row['party_code']); ?>_logo.png" class="can-party-logo"/>
             </div>
             <div class="can-name"> <?= $row['name']; ?></div>
             <div class="can-stat">
                <span class="can-num">#<?= $row['ballot_position']; ?></span>
                <div class="stat-cover"> <?= $row['valid_votes']; ?>
                <span class="stat-load"><?= $row['total_votes_cast'] > 0 ? round(($row['valid_votes']/$row['total_votes_cast'])*100,2): 0; ?> %</span>
                </div>
             </div>
        </div>
        <?php }} ?>
    </div>



    <div class="result-cover">
        <div class="result-cast">TURNOUT: <?= $pars[0]['total_votes_cast'] ?></div>
        <div class="result-reject">REJECTED: <?= $pars[0]['rejected_votes'] ?></div>
        <h2 class="result-title">
            PARLIAMENTARY RESULT
        </h2>
        <?php 
            if(count($pars) > 0){
            foreach($pars as $row){
        ?> 
        
        <div class="can-cover">
             <div class="can-party">
                <img src="<?= $_SESSION['asset']; ?>/public/images/<?= strtolower($row['party_code']); ?>_logo.png" class="can-party-logo"/>
             </div>
             <div class="can-name"> <?= $row['name']; ?></div>
             <div class="can-stat">
                <span class="can-num">#<?= $row['ballot_position']; ?></span>
                <div class="stat-cover"> <?= $row['valid_votes']; ?>
                    <span class="stat-load"><?= $row['total_votes_cast'] > 0 ? round(($row['valid_votes']/$row['total_votes_cast'])*100,2): 0; ?> %</span>
                </div>
             </div>
        </div>
        <?php }} ?>
    </div>
    
</body>
</html>
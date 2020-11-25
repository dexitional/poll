<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="Sample site">
<title>Election Results </title>

<link href="../public/main.css" rel="stylesheet">
    
</head>

<body>
    
    
   <?php include("nav.php"); ?>
  
    
    
    
    
   <div class="app-main__outer">
  <div class="app-main__inner">
      <div class="app-page-title">
          <div class="page-title-wrapper">
              <div class="page-title-heading">
                  <div class="page-title-icon">
                      <i class="pe-7s-drawer icon-gradient bg-happy-itmeo">
                      </i>
                  </div>
                  <div>
                        <?php ?>  
                      2020 General Elections 
                      <div class="page-title-subheading">
                          <?php ?>
                          ADANSI-ASOKWA CONSTITUENCY.
                      </div>
                  </div>
              </div>
              <div class="page-title-actions">
                  
              </div>    
          </div>
      </div>            

                        
    <div class="row">
                            
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                  <h5 class="card-title">Parliamentary</h5>
                  
                 <div>
                      <span class="small">Polling Station </span> <?php ?>
                      <span class="small">Registered Voters:</span> <?php ?>
                  </div>  
                                    
                  
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Party</th>
                          <th>Votes</th>
                          <th>Pcnt</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php $i=1; foreach($parliamentary as $row){ ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['candidate_name']; ?></td>
                            <td><?= $row['party_code']; ?></td>
                            <td><?php ?></td>
                              <td><?php ?></td>
                          </tr>
                        <?php $i++; } ?>

                                                   
                          <tr>
                            <td colspan="5">&nbsp;</td>
                          </tr>
                          
                          <tr>
                            <td colspan="5">
                                <strong>Valid Votes</strong>  4,723<?php ?>
                                <strong>Rejected Votes</strong> 85<?php ?>
                                <strong>Total Votes Cast</strong> 5,233<?php ?>
                                <strong>Turn-Out</strong>  85%<?php ?>
                                
                             </td>
                          </tr>
                          
                    </tbody>

                      
                  </div>
              </table>
            </div>
          </div>
      </div>
    </div>
			 
    
    
    
    
    
   
       
    
    
    
    
    
    
    
    
    
      </div>
    </div>  
    

<script src="../public/assets/scripts/main.js"></script>
</body>
</html>
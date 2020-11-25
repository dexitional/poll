<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
<meta name="description" content="Sample site">
<title>Polling Station Sheet </title>

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

                        
    
    
    
    
<div class="tab-content">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
      <div class="row">
          <div class="col-md-6">
            <div class="main-card mb-3 card">
              <div class="card-body"><h5 class="card-title text-primary">Add New Candidate</h5>
                  <form class="">
                      <div class="position-relative form-group">
                          <label for="FirstName" class="">First Name</label>
                          <input name="fname" id="FirstName" type="text" class="form-control" required>
                      </div>
                      
                      <div class="position-relative form-group">
                          <label for="LastName" class="">Last Name</label>
                          <input name="lname" id="LastName" type="text" class="form-control" required>
                      </div>
                      
                      <div class="position-relative form-group">
                          <label for="MiddleName" class="">Middle Name</label>
                          <input name="mname" id="MiddleName" type="text" class="form-control">
                      </div>
                      
                      <div class="position-relative form-group">
                          <label for="sex" class="">Sex</label>
                          <select name="select" id="sex" class="form-control">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                                        
                          </select>
                      </div>
                      
                     
                      
                
    
                </div>
              </div>
            </div>
          
          
          
          
            <div class="col-md-6">
              <div class="main-card mb-3 card">
                <div class="card-body">
                    <form class="">
                         <div class="position-relative form-group">
                          <label for="election_type" class="">Election Type</label>
                          <select name="election_type" id="election_type" class="form-control">
                                <option value="<?php ?>"><?php ?></option>
                                                        
                            </select>
                      </div>
                      
                      <div class="position-relative form-group">
                          <label for="ballot_position" class="">Ballot Position</label>
                          <select name="select" id="sex" class="form-control">
                                <option value="<?php ?>"><?php ?></option>
                                                        
                          </select>
                      </div>
                      
                      
                      <div class="position-relative form-group">
                          <label for="political_party" class="">Constituency</label>
                          <select name="constituency" id="constituency" class="form-control">
                                <option value="<?php ?>"><?php ?></option>
                                                        
                            </select>
                      </div>
                      
                      <div class="position-relative form-group">
                          <label for="political_party" class="">Political Party</label>
                          <select name="political_party" id="political_party" class="form-control">
                                <option value="<?php ?>"><?php ?></option>
                                                        
                            </select>
                      </div>
                    
                        
                      <input name="submit" type="submit" class="mt-1 btn btn-primary" value="Submit">
                  </form>
          
                    
                 </div>
              </div>
            </div>
          
            <!-- before row -->
          </div>
        </div>
      </div>
    
    
    
    
    
    
      </div>
    </div>  
    

<script src="../public/assets/scripts/main.js"></script>
</body>
</html>
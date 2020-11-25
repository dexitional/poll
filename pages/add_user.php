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
                          <span class="text-primary">ADANSI-ASOKWA CONSTITUENCY.</span>
                      </div>
                  </div>
              </div>
              <div class="page-title-actions">
                  
              </div>    
          </div>
      </div>            

                        
    
    
    
    
<div class="tab-content">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
       <div class="main-card mb-3 card">
          <div class="card-body"><h5 class="card-title text-primary">Add New User</h5>
            <form class="">
                                            
                <div class="form-row">
                      <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="FirstName" class="">First Name</label>
                            <input name="fname" id="FirstName" type="text" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="LastName" class="">Last Name</label>
                            <input name="lname" id="LastName" type="text" class="form-control" required>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="position-relative form-group">
                            <label for="MiddleName" class="">Middle Name</label>
                            <input name="mname" id="MiddleName" type="text" class="form-control">
                        </div>
                      </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="position-relative form-group">
                            <label for="email" class="">Email</label>
                            <input name="email" id="email" type="text" class="form-control">
                        </div>
                    </div>
                </div>


                  <div class="form-row">
                      <div class="col-md-4">
                          <div class="position-relative form-group">
                                <label for="Username" class="">Username</label>
                                <input name="username" id="Username" type="text" class="form-control" required>
                            </div>
                      </div>
                      <div class="col-md-4">
                          <div class="position-relative form-group">
                              <label for="Password" class="">Password</label>
                              <input name="password" id="Password" type="password" class="form-control" required>
                            </div>
                      </div>
                      <div class="col-md-4">
                          <div class="position-relative form-group">
                                <label for="Confirm_Password" class="">Confirm Password</label>
                                <input name="cpassword" id="Confirm_Password" type="password" class="form-control" required>
                            </div>
                      </div>
                  </div>



                  <div class="form-row">
                      <div class="col-md-6">
                           <div class="position-relative form-group">
                          <label for="political_party" class="">Constituency</label>
                            <select name="constituency" id="constituency" class="form-control">
                                  <option value="<?php ?>"><?php ?></option>

                              </select>
                          </div>
                      </div>


                      <div class="col-md-6">
                          <div class="position-relative form-group">
                          <label for="polling_station" class="">Polling Station</label>
                          <select name="polling_station" id="polling_station" class="form-control">
                                <option value="<?php ?>"><?php ?></option>

                            </select>
                      </div>
                      </div>
                  </div>
        
        
                <input name="submit" type="submit" class="mt-1 btn btn-primary" value="Submit">

            </form>
    
    
    
    
    
    
                </div>
           </div>
    
      </div>
    </div>  
    

<script src="../public/assets/scripts/main.js"></script>
</body>
</html>
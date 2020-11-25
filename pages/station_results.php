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
                  <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                      <i class="fa fa-star"></i>
                  </button>
                  <div class="d-inline-block dropdown">
                      <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                          <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa fa-business-time fa-w-20"></i>
                          </span>
                          Buttons
                      </button>
                      <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                          <ul class="nav flex-column">
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-inbox"></i>
                                      <span>
                                          Inbox
                                      </span>
                                      <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-book"></i>
                                      <span>
                                          Book
                                      </span>
                                      <div class="ml-auto badge badge-pill badge-danger">5</div>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="javascript:void(0);" class="nav-link">
                                      <i class="nav-link-icon lnr-picture"></i>
                                      <span>
                                          Picture
                                      </span>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a disabled href="javascript:void(0);" class="nav-link disabled">
                                      <i class="nav-link-icon lnr-file-empty"></i>
                                      <span>
                                          File Disabled
                                      </span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>    
          </div>
      </div>            

                        
    <div class="row">
                            
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body"><h5 class="card-title">Parliamentary</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>CANDIDATE</th>
                          <th>PARTY</th>
                          <th>VOTE</th>
                      </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="../controllers/Voting">

                        <?php $i=1; foreach($parliamentary as $row){ ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['candidate_name']; ?></td>
                            <td><?= $row['party_code']; ?></td>
                            <td>
                                <input type="hidden" name="candidates[]" value="<?= $row['id']; ?>"/>
                                <input type="text" name="votes[]" size="8" class="vote_input" value="<?php ?>" required/>

                            </td>
                          </tr>
                        <?php $i++; } ?>

                          <input type="hidden" name="election_type" value="<?php ?>">
                          <input type="hidden" name="polling_station" value="<?php ?>">
                          
                          
                          <tr>
                            <td colspan="3"><span class="text-danger">**REJECTED VOTES</span></td>
                            <td>                                
                                 <input type="text" name="rejected_votes" size="8" class="vote_input" value="<?php ?>" required/>
                            </td>
                          </tr>
                          
                    </tbody>

                      <tr>
                        <td colspan="4">
                            <input type="submit" name="/save" class="btn btn-primary btn-sm" value="Save sheet">
                            <input type="submit" name="/post" class="btn btn-danger btn-sm" value="Post sheet">
                        </td>


                      </tr>
                    </form>
                  </div>
              </table>
              </div>
          </div>
      </div>
    </div>
			 
    
    
    
    
    
    <div class="row">
                            
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body"><h5 class="card-title">Presidential</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr>
                          <th>#</th>
                          <th>CANDIDATE</th>
                          <th>PARTY</th>
                          <th>VOTE</th>
                      </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="../controllers/Voting">

                        <?php $i=1; foreach($parliamentary as $row){ ?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['candidate_name']; ?></td>
                            <td><?= $row['party_code']; ?></td>
                            <td>
                                <input type="hidden" name="candidates[]" value="<?= $row['id']; ?>"/>
                                <input type="text" name="votes[]" size="8" class="vote_input" value="<?php ?>" required/>

                            </td>
                          </tr>
                        <?php $i++; } ?>

                          <input type="hidden" name="election_type" value="<?php ?>">
                          <input type="hidden" name="polling_station" value="<?php ?>">
                          
                          
                          <tr>
                            <td colspan="3"><span class="text-danger">**REJECTED VOTES</span></td>
                            <td>                                
                                 <input type="text" name="rejected_votes" size="8" class="vote_input" value="<?php ?>" required/>
                            </td>
                          </tr>
                          
                      </tbody>

                      <tr>
                        <td colspan="4">
                            <input type="submit" name="/save" class="btn btn-primary btn-sm" value="Save sheet">
                            <input type="submit" name="/post" class="btn btn-danger btn-sm" value="Post sheet">
                        </td>


                      </tr>
                    </form>
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
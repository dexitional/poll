<!-- COALITION FORM -->                  
<div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body table-responsive"><h5 class="card-title">Parliamentary</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr class="thead_red">
                          <th>BALLOT #</th>
                          <th>CANDIDATE</th>
                          <th>PARTY</th>
                          <th>VOTES</th>
                      </tr>
                      </thead>
                      <tbody>
                      
                         <?php 
                              if(count($pars) > 0){
                                  foreach($pars  as $row){
                          ?> 
                          <tr>
                            <td><em><b>#<?= $row['ballot_position']; ?></b></em></td>
                            <td><b><?= $row['name']; ?></b></td>
                            <td>
                                <img src="<?= $_SESSION['asset']?>/public/images/<?= strtolower($row['party_code']); ?>_logo.png" class="party_logo"/>
                                <?= $row['party_code']; ?>
                            </td>
                            <td><b style="font-size:18px;"><?= $row['valid_votes']; ?></b></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td><b class="text-danger">** REJECTED VOTES</b></td>
                            <td><b style="font-size:18px;"><?= $row['rejected_votes']; ?></b></td>
                            <td><b class="text-danger">** TOTAL VOTES CAST</b></td>
                            <td> <b style="font-size:18px;"><?= $row['total_votes_cast']; ?></b></td>
                          </tr>
                          <?php }else{ ?>
                             <tr><td colspan="5" align="center"> <b>No Parliamentary Candidacy found for polling station!</b></td></tr>
                          <?php } ?>
                        </tbody>
                   
                  </table>
              </div>
              <hr>
              <div class="card-body table-responsive"><h5 class="card-title">Presidential</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr class="thead_green">
                          <th>BALLOT #</th>
                          <th>CANDIDATE</th>
                          <th>&nbsp;</th>
                          <th>PARTY</th>
                          <th>VOTES</th>
                      </tr>
                      </thead>
                      <tbody>
                     
                         <?php 
                              if(count($pres) > 0){
                                foreach($pres  as $row){
                          ?> 
                           <tr>
                            <td><em><b>#<?= $row['ballot_position']; ?></b></em></td>
                            <td><b><?= $row['name']; ?></b></td>
                            <td>
                                 <img src="<?= $_SESSION['asset'] ?>/public/images/<?= $row['party_code']; ?>_logo.png" height="20px"/>
                                 <b style="font-size:18px;"><?= $row['party_code']; ?></b>
                            </td>
                            <td><b style="font-size:18px;"><?= $row['valid_votes']; ?></b></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td><b class="text-danger">** REJECTED VOTES</b></td>
                            <td><b style="font-size:18px;"><?= $row['rejected_votes']; ?></b></td>
                            <td><b class="text-danger">** TOTAL VOTES CAST</b></td>
                            <td> <b style="font-size:18px;"><?= $row['total_votes_cast']; ?></b></td>
                          </tr>
                          <?php }else{ ?>
                             <tr><td colspan="5" align="center"> <b>No Presidential Candidacy found for polling station!</b></td></tr>
                          <?php } ?>
                        </tbody>
                    </form>
                  </table>
              </div>
          </div>
      </div>
    </div>   
    
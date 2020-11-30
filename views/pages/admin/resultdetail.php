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
                          <th>&nbsp;</th>
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
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['party_code']; ?></td>
                            <td><?= $row['party_code']; ?></td>
                            <td> <?= $row['valid_votes']; ?></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td><b class="text-danger">** REJECTED VOTES</b></td>
                            <td> <?= $row['rejected_votes']; ?> </td>
                            <td><b class="text-danger">** TOTAL VOTES CAST</b></td>
                            <td> <?= $row['rejected_votes']; ?> </td>
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
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['party_code']; ?></td>
                                <td><?= $row['party_code']; ?></td>
                                <td> <?= $row['valid_votes']; ?></td>
                          </tr>
                          <?php } ?>
                          <tr>
                                <td><b class="text-danger">** REJECTED VOTES</b></td>
                                <td> <?= $row['rejected_votes']; ?> </td>
                                <td><b class="text-danger">** TOTAL VOTES CAST</b></td>
                                <td> <?= $row['total_votes_cast']; ?> </td>
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
    
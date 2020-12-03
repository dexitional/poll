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
                      <form method="post" action="<?= $app->urlFor('postentries');?>">
                         <?php 
                              if(count($pars) > 0){
                                  foreach($pars  as $row){
                          ?> 
                          <tr>
                            <td><em><b>#<?= $row['ballot_position']; ?></b></em></td>
                            <td><?= $row['name']; ?></td>
                            <td class="party_code">
                                <img src="./public/images/<?= strtolower($row['party_code']); ?>_logo.png" class="party_logo"/>
                                <?= $row['party_code']; ?>

                            </td>
                            <td>
                                <input type="number" name="votes_<?= $row['id']; ?>" class="vote_input" value="<?= $row['valid_votes']; ?>"/>
                            </td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td><b class="text-danger">** REJECTED VOTES</b></td>
                            <td>                                
                                 <input type="number" name="rvotes_<?= $row['head_id']; ?>" class="vote_input" value="<?= $row['rejected_votes']; ?>" required/>
                            </td>
                            <td><b class="text-dark font-weight-bolder">** TOTAL VOTES CAST</b></td>
                            <td>                                
                                 <input type="number" name="tvotes_<?= $row['head_id']; ?>" class="vote_input" value="<?= $row['total_votes_cast']; ?>" required/>
                            </td>
                          </tr>
                          <?php }else{ ?>
                             <tr><td colspan="4" align="center"> <b>No Parliamentary Candidacy found for polling station!</b></td></tr>
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
                            <td class="party_code"><?= $row['party_code']; ?></td>
                            <td>
                                <input type="number" name="votes_<?= $row['id']; ?>" class="vote_input" value="<?= $row['valid_votes']; ?>" required/>
                            </td>
                          </tr>
                          <?php } ?>

                          <tr>
                            <td><b class="text-danger">** REJECTED VOTES</b></td>
                            <td>                                
                                 <input type="number" name="rvotes_<?= $row['head_id']; ?>" class="vote_input" value="<?= $row['rejected_votes']; ?>" required/>
                            </td>
                            <td><b class="text-dark font-weight-bolder">** TOTAL VOTES CAST</b></td>
                            <td>                                
                                 <input type="number" name="tvotes_<?= $row['head_id']; ?>" class="vote_input" value="<?= $row['total_votes_cast']; ?>" required/>
                            </td>
                          </tr>
                          <?php }else{ ?>
                             <tr><td colspan="5" align="center"> <b>No Presidential Candidacy found for polling station!</b></td></tr>
                          <?php } ?>
                         <tr><td colspan="5"><hr></td></tr>
                         <tr>
                            <td colspan="5">
                                <input type="hidden" id="" name="" value=""/>
                                <input type="submit" id="save" class="btn btn-success btn-sm" value="SAVE SHEET">
                                <input type="submit" id="post" class="btn btn-dark btn-sm" value="POST SHEET">
                            </td>
                          </tr>

                        </tbody>
                    </form>
                  </table>
              </div>
          </div>
      </div>
    </div>   
    
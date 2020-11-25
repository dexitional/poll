<!-- COALITION FORM -->                  
<div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body"><h5 class="card-title">Parliamentary</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr class="thead_red">
                          <th>#</th>
                          <th>CANDIDATE</th>
                          <th>PARTY</th>
                          <th>VOTE</th>
                      </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="../controllers/Voting">
                          <tr>
                            <td><?= 1 ?></td>
                            <td><?= 'candidate_name'; ?></td>
                            <td><?= 'party_code'; ?></td>
                            <td>
                                <input type="hidden" name="candidates[]" value="<?= 'id'; ?>"/>
                                <input type="text" name="votes[]" size="8" class="vote_input" value="<?php ?>" required/>

                            </td>
                          </tr>
                      
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
                            <input type="submit" name="/save" class="btn btn-success btn-sm" value="SAVE SHEET">
                            <input type="submit" name="/post" class="btn btn-dark btn-sm" value="POST SHEET">
                        </td>
                      </tr>
                    </form>
                  </div>
              </table>
              </div>
              <hr>
              <div class="card-body"><h5 class="card-title">Presidential</h5>
                  <table class="mb-0 table table-striped">
                      <thead>
                      <tr class="thead_green">
                          <th>#</th>
                          <th>CANDIDATE</th>
                          <th>PARTY</th>
                          <th>VOTE</th>
                      </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="../controllers/Voting">

                       
                          <tr>
                            <td>1</td>
                            <td>candidate_name</td>
                            <td>party_code</td>
                            <td>
                                <input type="hidden" name="candidates[]" value=""/>
                                <input type="text" name="votes[]" size="8" class="vote_input" value="<?php ?>" required/>

                            </td>
                          </tr>
                       

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
                            <input type="submit" name="/save" class="btn btn-success btn-sm" value="SAVE SHEET">
                            <input type="submit" name="/post" class="btn btn-dark btn-sm" value="POST SHEET">
                        </td>


                      </tr>
                    </form>
                  </div>
                </table>
                    
              </div>
          </div>
      </div>
    </div>   
    
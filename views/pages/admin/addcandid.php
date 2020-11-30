

     <!-- ADD CANDIDATES -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('candid'); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('postcandid'); ?>">
                        <div class="form-group">
                                <label for="fname">FIRST NAME</label>
                                <input type="text" id="fname" class="form-control" name="fname" value="<?= $row['fname']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="mname">MIDDLE NAME(S)</label>
                                <input type="text" id="mname" class="form-control" name="mname" value="<?= $row['mname']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="lname">LAST NAME</label>
                                <input type="text" id="lname" class="form-control" name="lname" value="<?= $row['lname']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="sex">GENDER</label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="M" <?= $row['id'] > 0 && $row['sex'] == 'M' ? 'selected="selected"':'' ?>>MALE</option>
                                    <option value="F" <?= $row['id'] > 0 && $row['sex'] == 'F' ? 'selected="selected"':'' ?>>FEMALE</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ballot_position">BALLOT POSITION</label>
                                <input type="text" id="ballot_position" class="form-control" name="ballot_position" value="<?= $row['ballot_position']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="election_type_id">ELECTION TYPE</label>
                                <select name="election_type_id" id="election_type_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($types) > 0){
                                          foreach($types as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['election_type_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['election_type'] ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="party_id">POLITICAL PARTY</label>
                                <select name="party_id" id="party_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($parties) > 0){
                                          foreach($parties as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['party_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['party_name'].' ( '.$rx['party_code'].' )'; ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" <?= $row['id'] > 0 && $row['status'] == '0' ? 'selected="selected"':'' ?>>DISABLED</option>
                                    <option value="1" <?= $row['id'] > 0 && $row['status'] == '1' ? 'selected="selected"':'' ?>>ENABLED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $row['id']?>"/>
                                <input type="submit" class="btn btn-success form-control login-btn" value="SAVE">
                            </div>

                        </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>


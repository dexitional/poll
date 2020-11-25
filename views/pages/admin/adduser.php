 <!-- ADD USERS & ACCOUNTS -->
 <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('user'); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('postuser'); ?>">
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
                                <label for="username">USERNAME</label>
                                <input type="text" id="username" class="form-control" name="username" value="<?= $row['username']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="cellphone">CELLPHONE</label>
                                <input type="text" id="cellphone" class="form-control" name="cellphone" value="<?= $row['cellphone']?>"/>
                            </div>

                            <div class="form-group">
                                <label for="dob">DATE OF BIRTH</label>
                                <input type="date" id="dob" class="form-control" name="dob" value="<?= $row['dob']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="role_id">ROLE</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                <?php 
                                    if(count($roles) > 0){
                                       foreach($roles as $rx){
                                ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['role_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['role_name'] ?></option>
                                <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="constituency_id">ASSIGNED CONSTITUENCY</label>
                                <select name="constituency_id" id="constituency_id" class="form-control">
                                   <option value=""> -- CHOOSE --</option>
                                <?php 
                                    if(count($consts) > 0){
                                       foreach($consts as $rx){
                                ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['constituency_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['constituency_name'] ?></option>
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

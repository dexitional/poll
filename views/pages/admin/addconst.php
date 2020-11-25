
    
    <!-- ADD CONSTITUENCY -->
    <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('const'); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('postconst'); ?>">
                            <div class="form-group">
                                <label for="constituency_name">CONSTITUENCY NAME</label>
                                <input type="text" id="constituency_name" class="form-control" name="constituency_name" value="<?= $row['constituency_name']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="constituency_name">CONSTITUENCY CODE</label>
                                <input type="text" id="const_code" class="form-control" name="const_code" value="<?= $row['const_code']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="registered_voters">CONSTITUENCY VOTERS</label>
                                <input type="text" id="registered_voters" class="form-control" name="registered_voters" value="<?= $row['registered_voters']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="region_id">CONSTITUENCY REGION</label>
                                <select name="region_id" id="region_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($regions) > 0){
                                        foreach($regions as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['region_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['region_name'] ?></option>
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

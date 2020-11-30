<!-- ADD POLLING STATION -->
<div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('station'); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('poststation'); ?>">
                            <div class="form-group">
                                <label for="station_name">STATION NAME</label>
                                <input type="text" id="station_name" class="form-control" name="station_name" value="<?= $row['station_name']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="station_code">STATION CODE </label>
                                <input type="text" id="station_code" class="form-control" name="station_code" value="<?= $row['station_code']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="serial_num">SERIAL NUMBER</label>
                                <input type="text" id="serial_num" class="form-control" name="serial_num" value="<?= $row['serial_num']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="total_reg_voters">REGISTERED VOTERS</label>
                                <input type="text" id="total_reg_voters" class="form-control" name="total_reg_voters" value="<?= $row['total_reg_voters']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="constituency_id">CONSTITUENCY</label>
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
                                <label for="constituency_id">ELECTORAL AREA</label>
                                <select name="area_id" id="area_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($areas) > 0){
                                        foreach($areas as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['area_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['area_name'].' - [ '.$rx['constituency'].' CONSTITUENCY ]' ?></option>
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
                                <input type="hidden" name="pid" value="<?= $row['pid']?>"/>
                                <input type="submit" class="btn btn-success form-control login-btn" value="SAVE">
                            </div>

                        </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>

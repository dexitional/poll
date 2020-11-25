
     <!-- ADD POLLING AGENT -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('agent',['cid'=> $row['constituency_id'],'eid' => $row['election_id']]); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('postagent'); ?>">
                           <div class="form-group">
                                <label for="id">POLLING AGENT</label>
                                <select name="id" id="id" class="form-control">
                                   <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($users) > 0){
                                        foreach($users as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['name'] ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="station_id">POLLING STATION</label>
                                <select name="station_id" id="station_id" class="form-control">
                                    <option value=""> -- CHOOSE --</option>
                                    <?php 
                                        if(count($stations) > 0){
                                        foreach($stations as $rx){
                                    ?>  
                                    <option value="<?= $rx['id'] ?>" <?= $row['id'] > 0 && $row['station_id'] == $rx['id'] ? 'selected="selected"':'' ?>><?= $rx['station_name'] ?></option>
                                    <?php }} ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success form-control login-btn" value="SAVE">
                            </div>

                        </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>
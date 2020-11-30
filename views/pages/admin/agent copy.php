
    <!-- POLLING AGENTS -->
    <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('addagent'); ?>" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> ADD POLLING AGENT</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                  <tr class="thead_green">
                                    <th>#</th>
                                    <th>FULL NAME</th>
                                    <th>POLLING STATION</th>
                                    <th>REGISTERED VOTERS</th>
                                    <th>PHONE</th>
                                    <th>RESULT POSTED</th>
                                    <th>&nbsp;</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    if(count($data) > 0){
                                    foreach($data as $row){
                                ?> 
                                  <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['station_name']; ?></td>
                                    <td><?= $row['total_reg_voters']; ?></td>
                                    <td><?= $row['cellphone']; ?></td>
                                    <td><?= $row['posted'] == '1' ? 'YES':'NO'; ?>
                                        <?= !is_null($row['posted_at']) ? "<center><small>POSTED ON : ${row['posted_at']}</small></center>":''; ?>
                                    </td>
                                    <td>
                                        <div class="btn btn-group">
                                            <a href="<?= $app->urlFor('editagent',['id'=>$row['id']]); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $app->urlFor('delagent',['id'=>$row['id']]); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete record ?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                  </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>


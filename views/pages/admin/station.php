
     <!-- POLLING STATIONS -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('addstation'); ?>" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> ADD POLLING STATION</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                  <tr class="thead_green">
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>CODE</th>
                                    <th>SERIAL #</th>
                                    <th>CONSTITUENCY</th>
                                    <th>ELECTORAL AREA</th>
                                    <th>REGISTERED VOTERS</th>
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
                                    <td><?= $row['station_name']; ?></td>
                                    <td><?= $row['station_code']; ?></td>
                                    <td><?= $row['serial_num']; ?></td>
                                    <td><?= $row['constituency']; ?></td>
                                    <td><?= $row['area_name']; ?></td>
                                    <td><?= $row['total_reg_voters']; ?></td>
                                    <td>
                                        <div class="btn btn-group">
                                        <a href="<?= $app->urlFor('pollentries',['id'=>$row['id']]); ?>" class="btn btn-xs btn-dark">ENTRIES</a>
                                            <a href="<?= $app->urlFor('editstation',['id'=>$row['id']]); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $app->urlFor('delstation',['id'=>$row['id']]); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete record ?');"><i class="fa fa-trash"></i></a>
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
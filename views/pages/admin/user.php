<!-- USERS & ACCOUNT -->
<div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('adduser'); ?>" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> ADD USER</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                  <tr class="thead_green">
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>USERNAME</th>
                                    <th>PHONE</th>
                                    <th>CONSTITUENCY</th>
                                    <th>ROLE</th>
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
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['cellphone']; ?></td>
                                    <td><?= $row['constituency']; ?></td>
                                    <td><?= $row['privilege']; ?></td>
                                    <td>
                                        <div class="btn btn-group">
                                            <a href="<?= $app->urlFor('edituser',['id'=>$row['id']]); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $app->urlFor('deluser',['id'=>$row['id']]); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete constituency record ?')"><i class="fa fa-trash"></i></a>
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
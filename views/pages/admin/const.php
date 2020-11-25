<!-- CONSTITUENCIES -->
<div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('addconst'); ?>" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> ADD CONSTITUENCY</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                  <tr class="thead_green">
                                    <th>#</th>
                                    <th>CONSTITUENCY</th>
                                    <th>REGISTERED VOTERS</th>
                                    <th>REGION</th>
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
                                    <td><?= $row['constituency_name']; ?></td>
                                    <td><?= $row['registered_voters']; ?></td>
                                    <td><?= $row['region']; ?></td>
                                    <td>
                                        <div class="btn btn-group">
                                            <a href="<?= $app->urlFor('dashconst',['id'=>$row['id']]); ?>" class="btn btn-xs btn-dark"><small><b>FOLLOW</b></small></a>
                                            <a href="<?= $app->urlFor('editconst',['id'=>$row['id']]); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $app->urlFor('delconst',['id'=>$row['id']]); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete constituency record ?')"><i class="fa fa-trash"></i></a>
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

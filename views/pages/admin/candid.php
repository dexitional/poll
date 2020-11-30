
     <!-- CANDIDATES -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('addcandid'); ?>" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> ADD CANDIDATE</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="mb-0 table table-striped">
                                <thead>
                                  <tr class="thead_green">
                                    <th>#</th>
                                    <th>FULL NAME</th>
                                    <th>POLITICAL PARTY</th>
                                    <th>SEX</th>
                                    <th>TYPE</th>
                                    <th>BALLOT POSITION</th>
                                    <th>&nbsp;</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                      if(count($data) > 0){
                                        foreach($data as $row){
                                  ?> 
                                  <tr class="<?= strtolower($row['election_type']) == 'presidential'? 'colormain':'colorsub'; ?>">
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['party_code']; ?></td>
                                    <td><?= $row['sex']; ?></td>
                                    <td><?= $row['election_type']; ?></td>
                                    <td># <?= $row['ballot_position']; ?></td>
                                    <td>
                                        <div class="btn btn-group">
                                            <a href="<?= $app->urlFor('editcandid',['id'=>$row['id']]); ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?= $app->urlFor('delcandid',['id'=>$row['id']]); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete record ?')"><i class="fa fa-trash"></i></a>
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

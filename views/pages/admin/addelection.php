    <!-- ADD ELECTION -->
    <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span><?= $title ?></span>
                    <a href="<?= $app->urlFor('election'); ?>" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operation ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= $app->urlFor('postelection'); ?>">
                            <div class="form-group">
                                <label for="election_name">ELECTION NAME</label>
                                <input type="text" id="election_name" class="form-control" name="election_name" value="<?= $row['election_name']?>"/>
                            </div>
                            <div class="form-group">
                                <label for="election_date">ELECTION DATE</label>
                                <input type="date" id="election_date" class="form-control" name="election_date" value="<?= $row['election_date']?>"/>
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

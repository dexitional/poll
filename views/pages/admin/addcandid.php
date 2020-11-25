

     <!-- ADD CANDIDATES -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span>CANDIDATE FORM</span>
                    <a href="" class="pull-right btn btn-sm btn-danger" onclick="confirm('Cancel operatioon ?')"><i class="fa fa-offline"></i> CANCEL</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="<?= 'postelection';?>">
                        <div class="form-group">
                                <label for="fname">FIRST NAME</label>
                                <input type="text" id="fname" class="form-control" name="fname" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="mname">MIDDLE NAME(S)</label>
                                <input type="text" id="mname" class="form-control" name="mname" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="lname">LAST NAME</label>
                                <input type="text" id="lname" class="form-control" name="lname" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="ballot_position">BALLOT POSITION</label>
                                <input type="text" id="ballot_position" class="form-control" name="ballot_position" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="election_type_id">ELECTION TYPE</label>
                                <select name="election_type_id" id="election_type_id" class="form-control">
                                    <option value="5">PARLIAMENTARY</option>
                                    <option value="4">PRESIDENTIAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="party_id">POLITICAL PARTY</label>
                                <select name="party_id" id="party_id" class="form-control">
                                    <option value="5">NDC</option>
                                    <option value="4">NPP</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">DISABLED</option>
                                    <option value="1">ENABLED</option>
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


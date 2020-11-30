
     <!-- AGENTS ADMIN -->
     <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">
                    <span>POLLING AGENT MENUS</span>
                    <a href="" class="pull-right btn btn-sm btn-danger"><i class="fa fa-offline"></i> OFFLINE MODE</a>
                </h5><hr/>
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('entries') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-edit  fa-4x mb-2"></i>
                                <b><center>RESULT ENTRIES</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('resultsum') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-list fa-4x mb-2"></i>
                                <b><center>POLLING RESULTS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('candid') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-4x mb-2 fa-bar-chart-o" aria-hidden="true"></i>
                                <b><center>DETAILED RESULTS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    
                   <div class="col-md-3 col-xs-12">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('candid') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-cog fa-4x mb-2"></i>
                                <b><center>SETTINGS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                  
                </div>
              </div>
          </div>
      </div>
    </div>
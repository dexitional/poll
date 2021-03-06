
    <!-- CONSTITUENCY ADMIN -->
    <div class="row">
      <div class="col-lg-10">
          <div class="main-card mb-3 card">
              <div class="card-body">
                <h5 class="card-title ">ADMIN MENUS</h5><hr/>
                <div class="row">
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a target="_blank" href="<?= $app->urlFor('resultall') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-list fa-4x mb-2"></i>
                                <b><center>OVERALL RESULTS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a target="_blank" href="<?= $app->urlFor('resultstation') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-4x mb-2 fa-bar-chart-o" aria-hidden="true"></i>
                                <b><center>DETAILED RESULTS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('station') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-university  fa-4x mb-2"></i>
                                <b><center>POLLING STATIONS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('agent',['cid'=>$_SESSION['user']['constituency_id'],'eid'=>$_SESSION['user']['election_id']]) ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-users fa-4x mb-2"></i>
                                <b><center>POLLING AGENTS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('candid') ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-users fa-4x mb-2"></i>
                                <b><center>CANDIDATES</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    <!--
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card bg-danger">
                            <a href="<?= $app->urlFor('agent',['cid'=>$_SESSION['user']['constituency_id'],'eid'=>$_SESSION['user']['election_id']]) ?>" class="no-border">
                            <div class="card-body text-center text-white">
                                <i class="fa fa-cog fa-4x mb-2"></i>
                                <b><center>SETTINGS</center></b>
                            </div>
                            </a>
                        </div>
                    </div>
                    -->
                    <div class="col-md-3 col-xs-12 mt-3">
                        <div class="card" style="background:brown">
                            <div class="card-body text-center text-white">
                                <h3><?= $voters?></h3>
                                <b><center>TOTAL REGISTERED VOTERS</center></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 mt-3">
                        <div class="card bg-dark" style="background:dark">
                            <div class="card-body text-center text-white">
                                <h3>DEC 6, 2020</h3>
                                <b><center><?= $_SESSION['user']['election_name'] ?></center></b>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </div>


<?php 
if(!isset($_SESSION)){
  session_start();
}

// Curl Fetch Command
function fetch($url){
   $ch = curl_init();
   $headers = array(
     'Accept: application/json',
     'Content-Type: application/json',
   );
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
   curl_setopt($ch, CURLOPT_TIMEOUT, 30);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
};

// Authentication Checker
function authenticate() {
   $_SESSION['user'] = ['name'=> 'Kobby','id'=> '1'];
   if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
      $app = \Slim\Slim::getInstance();
      $app->flash('error', 'Login required');
      $app->redirect($app->urlFor('login'));
   }
}


/* Entry or Index Page */
$app->get('/', 'authenticate',function () use ($app) {
   if(isset($_SESSION['user'])){
      if($_SESSION['user']['role_id'] == '5'){
         $app->render($app->urlFor('dashagent')); # Auth Login
      }else{
         $app->render($app->urlFor('dashadmin')); # Auth Login
      }
   }else{
      $app->redirect($app->urlFor('login')); # Auth Login
   }
   
})->name('index');


$app->get('/dashagent',function () use ($app) {
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/dashagent.php',
      'slug' => 'agent',
      'title' => 'AGENT DASHBOARD',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
   ]);
})->name('dashagent');

$app->get('/dashadmin',function () use ($app) {
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/dashagent.php',
      'slug' => 'agent',
      'title' => 'AGENT DASHBOARD',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
   ]);
})->name('dashadmin');

/* EduRoam Routes */
$app->get('/test',function () use ($app) {
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/agent.php',
      'slug' => 'agent'
   ]);
})->name('test');


$app->get('/result',function () use ($app) {
   $app->render('pages/admin/resultoview.php',[
      'page' => 'pages/admin/resultoview.php',
      'slug' => 'agent'
   ]);
})->name('result');


    
// ----  MAIN ROUTES ----

/* Users Routes */
$app->get('/user', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select u.*,date_format(dob,'%Y-%m-%d') as dob,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,r.role_name as privilege, c.constituency_name as constituency from `users` u left join constituencies c on c.id = u.constituency_id left join `roles` r on r.id = u.role_id");
   $data = [];
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/user.php',
       'slug' => 'user',
       'title' => 'USERS & ACCOUNTS',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data,'app' => $app
   ]);
})->name('user');

$app->get('/adduser', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $data = []; $roles = []; $consts = [];
   $sql2 = $db->query("select * from `roles` where status = 1");
   $sql3 = $db->query("select * from `constituencies` where status = 1");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adduser.php',
       'slug' => 'user',
       'title' => 'ADD USER ACCOUNT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0], 'roles' => $roles, 'consts' => $consts, 'app' => $app
   ]);
})->name('adduser');

$app->get('/edituser/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $data = []; $roles = []; $consts = [];
   $sql = $db->query("select * from `users` where id = ".$id);
   $sql2 = $db->query("select * from `roles` where status = 1");
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $row = null ; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adduser.php',
       'slug' => 'user',
       'title' => 'EDIT USER ACCOUNT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row, 'roles' => $roles, 'consts' => $consts, 'app' => $app
   ]);
})->name('edituser');

$app->get('/deluser/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("delete from `users` where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'User deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete user!');
   }
   $app->redirect($app->urlFor('user'));
})->name('deluser');

$app->post('/user', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['dob'] = $r['dob'] == '' ? date('1970-01-01') : $r['dob'];
   if($r['id'] > 0){
       $ins = $db->query("update `users` set fname = '${r['fname']}', mname = '${r['mname']}', lname = '${r['lname']}', username = '${r['username']}', cellphone = '${r['cellphone']}', dob = '${r['dob']}', role_id = ${r['role_id']}, constituency_id = ${r['constituency_id']}, status = ${r['status']} where id = ".$r['id']);
   }else{
       $ins = $db->query("insert into `users`(fname,mname,lname,username,cellphone,dob,role_id,constituency_id,status)  values('${r['fname']}','${r['mname']}','${r['lname']}','${r['username']}','${r['cellphone']}','${r['dob']}',${r['role_id']},${r['constituency_id']},${r['status']})");
   }
   if($ins){
      $app->flash('success', 'User saved successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('user'));
})->name('postuser');




/* Constituency Routes */
$app->get('/const', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select c.* from constituencies c left join regions r on r.id = c.region_id where c.status = 1");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/const.php',
       'slug' => 'user',
       'title' => 'CONSTITUENCIES',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('const');

$app->get('/addconst', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $regions = [];
   $sql2 = $db->query("select * from `regions` where status = 1");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addconst.php',
       'slug' => 'user',
       'title' => 'ADD USER ACCOUNT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0], 'regions' => $regions,'app' => $app
   ]);
})->name('addconst');

$app->get('/editconst/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $data = []; $roles = []; $consts = [];
   $sql = $db->query("select * from constituencies where id = ".$id);
   $regions = [];
   $sql2 = $db->query("select * from regions where status = 1 order by region_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $regions[] = $row; }}
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addconst.php',
       'slug' => 'const',
       'title' => 'EDIT CONSTITUENCY',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row, 'regions' => $regions, 'app' => $app
   ]);
})->name('editconst');

$app->get('/dashconst/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $data = []; $roles = []; $consts = [];
   $sql = $db->query("select * from `users` where id = ".$id);
   $sql2 = $db->query("select * from `roles` where status = 1");
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $row = null ; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adduser.php',
       'slug' => 'user',
       'title' => 'EDIT CONSTITUENCY | '.$row['constituency_name'],
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row, 'roles' => $roles, 'consts' => $consts, 'app' => $app
   ]);
})->name('dashconst');

$app->get('/delconst/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("delete from constituencies where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'Constituency deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete constituency!');
   }
   $app->redirect($app->urlFor('const'));
})->name('delconst');

$app->post('/const', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['registered_voters'] = $r['registered_voters'] == '' ? 0 : $r['registered_voters'];
   $r['region_id'] = $r['region_id'] == '' ? 0 : $r['region_id'];
   
   if($r['id'] > 0){
      $sql = "update constituencies set const_code = '${r['const_code']}', constituency_name = '${r['constituency_name']}', registered_voters = ${r['registered_voters']}, region_id = ${r['region_id']}, status = ${r['status']} where id = ".$r['id'];
       $ins = $db->query($sql);
       //var_dump($sql);exit;
   }else{
       $ins = $db->query("insert into constituencies(const_code,constituency_name,registered_voters,region_id,status)  values('${r['const_code']}','${r['constituency_name']}',${r['registered_voters']},${r['region_id']},${r['status']})");
   }
   if($ins){
      $app->flash('success', 'Constituency saved successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('const'));
})->name('postconst');




/* District Routes */
$app->get('/district', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select c.* from districts c left join regions r on r.id = c.region_id where c.status = 1");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/district.php',
       'slug' => 'district',
       'title' => 'DISTRICTS',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('district');

$app->get('/adddistrict', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $regions = [];
   $sql2 = $db->query("select * from `regions` where status = 1");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adddistrict.php',
       'slug' => 'user',
       'title' => 'ADD DISTRICT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0], 'regions' => $regions,'app' => $app
   ]);
})->name('adddistrict');

$app->get('/editdistrict/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select * from districts where id = ".$id);
   $regions = [];
   $sql2 = $db->query("select * from regions where status = 1 order by region_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $regions[] = $row; }}
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adddistrict.php',
       'slug' => 'const',
       'title' => 'EDIT DISTRICT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row, 'regions' => $regions, 'app' => $app
   ]);
})->name('editdistrict');

$app->get('/deldistrict/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("delete from districts where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'District deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete district!');
   }
   $app->redirect($app->urlFor('district'));
})->name('deldistrict');

$app->post('/district', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['registered_voters'] = $r['registered_voters'] == '' ? 0 : $r['registered_voters'];
   $r['region_id'] = $r['region_id'] == '' ? 0 : $r['region_id'];
   
   if($r['id'] > 0){
      $sql = "update districts set district_name = '${r['district_name']}', newly_created = ${r['newly_created']}, region_id = ${r['region_id']}, status = ${r['status']} where id = ".$r['id'];
       $ins = $db->query($sql);
   }else{
       $ins = $db->query("insert into districts(district_name,newly_created,region_id,status)  values('${r['district_name']}',${r['newly_created']},${r['region_id']},${r['status']})");
   }
   if($ins){
      $app->flash('success', 'District saved successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('district'));
})->name('postdistrict');



/* Election Routes */
$app->get('/election', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select *,upper(date_format(election_date,'%M %d, %Y')) as election_date from elections where status = 1");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/election.php',
       'slug' => 'election',
       'title' => 'ELECTIONS',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('election');

$app->get('/addelection', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addelection.php',
       'slug' => 'election',
       'title' => 'ADD ELECTION',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0],'app' => $app
   ]);
})->name('addelection');

$app->get('/editelection/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select * from elections where id = ".$id);
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addelection.php',
       'slug' => 'election',
       'title' => 'EDIT ELECTION',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row,'app' => $app
   ]);
})->name('editelection');

$app->get('/delelection/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("delete from elections where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'Election deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete election!');
   }
   $app->redirect($app->urlFor('district'));
})->name('delelection');

$app->post('/election', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['election_date'] = $r['election_date'] == '' ? date('Y-m-d') : $r['election_date'];
   
   if($r['id'] > 0){
      $sql = "update elections set election_name = '${r['election_name']}', election_date = '${r['election_date']}', status = ${r['status']} where id = ".$r['id'];
       $ins = $db->query($sql);
   }else{
       $ins = $db->query("insert into elections(election_name,election_date,status)  values('${r['election_name']}','${r['election_date']}',${r['status']})");
   }
   if($ins){
      $app->flash('success', 'Election saved successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('election'));
})->name('postelection');



/* Polling Station Routes */
$app->get('/station', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select p.*,e.area_name,c.constituency_name as constituency from polling_stations p left join constituencies c on c.id = p.constituency_id left join electoral_areas e on p.area_id = e.id  where p.status = 1");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/station.php',
       'slug' => 'station',
       'title' => 'POLLING STATIONS',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('station');

$app->get('/addstation', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $areas = []; $consts = [];
   $sql2 = $db->query("select * from `electoral_areas` where status = 1");
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $areas[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addstation.php',
       'slug' => 'station',
       'title' => 'ADD POLLING STATION',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0],'areas' => $areas,'consts' => $consts,'app' => $app
   ]);
})->name('addstation');

$app->get('/editstation/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $areas = []; $consts = [];
   $sql2 = $db->query("select e.*,c.constituency_name as constituency from `electoral_areas` e left join constituencies c on e.constituency_id = c.id where e.status = 1 order by c.constituency_name,e.area_name");
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $areas[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $sql = $db->query("select * from polling_stations where id = ".$id);
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addstation.php',
       'slug' => 'station',
       'title' => 'EDIT POLLING STATION',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row,'areas' => $areas,'consts' => $consts,'app' => $app
   ]);
})->name('editstation');

$app->get('/delstation/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("delete from polling_stations where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'Station deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete station!');
   }
   $app->redirect($app->urlFor('district'));
})->name('delstation');

$app->post('/station', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['area_id'] =  $r['area_id'] == '' ? 0 : $r['area_id'];
   if($r['id'] > 0){
      $sql = "update polling_stations set station_name = '${r['station_name']}', station_code = '${r['station_code']}', serial_num = '${r['serial_num']}', total_reg_voters = '${r['total_reg_voters']}', constituency_id = ${r['constituency_id']}, area_id = ${r['area_id']}, status = ${r['status']} where id = ".$r['id'];
       $ins = $db->query($sql);
   }else{
       $ins = $db->query("insert into polling_stations(station_name,station_code,serial_num,total_reg_voters,constituency_id,area_id,status)  values('${r['station_name']}','${r['station_code']}','${r['serial_num']}',${r['total_reg_voters']},${r['constituency_id']},${r['area_id']},${r['status']})");
   }
   if($ins){
      $app->flash('success', 'Station saved successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('station'));
})->name('poststation');


/* Polling Agents Routes */
$app->get('/agent/:cid/:eid', 'authenticate',function ($cid,$eid) use ($app) {
   require_once './config/db.php';
   $_SESSION['eid'] = $eid;
   $_SESSION['cid'] = $cid;
   //$eid = !isset($_SESSION['site']['election_id']) ? $app->request()->get('eid') : $_SESSION['site']['election_id'];
   //$cid = !isset($_SESSION['site']['constituency_id']) ? $cid : $_SESSION['site']['constituency_id'];
   $sql = $db->query("select u.*,p.station_name,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,v.total_reg_voters,v.posted,date_format(v.posted_at,'%M %d, %Y %h:%i %p') as posted_at from `users` u left join polling_stations p on p.id = u.station_id left join polling_voters v on p.id = v.station_id  where u.role_id = 5 and v.election_id = ${eid} and u.status = 1");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/agent.php',
       'slug' => 'agent',
       'title' => 'POLLING AGENTS',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('agent');

$app->get('/addagent', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $users = []; $stations = [];
   $cid = $_SESSION['cid'];
   $eid = $_SESSION['eid'];
   $sql2 = $db->query("select *,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name from users u where role_id = 5 and status = 1 and constituency_id =".$cid." order by name");
   $sql3 = $db->query("select * from polling_stations where status = 1 and constituency_id = ".$cid." order by station_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $users[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $stations[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addagent.php',
       'slug' => 'agent',
       'title' => 'ADD POLLING AGENT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0,'constituency_id'=>$cid,'election_id' => $eid],'users' => $users,'stations' => $stations,'app' => $app
   ]);
})->name('addagent');

$app->get('/editagent/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $users = []; $stations = [];
   $sql = $db->query("select *,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name from users u where id = ".$id);
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $sql2 = $db->query("select *,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name from users u where role_id = 5 and status = 1 and constituency_id =".$row['constituency_id']." order by name");
   $sql3 = $db->query("select * from polling_stations where status = 1 and constituency_id = ".$row['constituency_id']." order by station_name");
   if($sql2->num_rows > 0){ while($row2 = $sql2->fetch_assoc()){ $users[] = $row2; }}
   if($sql3->num_rows > 0){ while($row3 = $sql3->fetch_assoc()){ $stations[] = $row3; }}
   $row['election_id'] = $_SESSION['eid'];
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addagent.php',
       'slug' => 'agent',
       'title' => 'EDIT POLLING AGENT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row,'users' => $users,'stations' => $stations,'app' => $app
   ]);
})->name('editagent');

$app->get('/delagent/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $sql = $db->query("update users set station_id = null where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'Agent removed from post!');
   }else{
      $app->flash('error', 'Unable to depost agent!');
   }
   $app->redirect($app->urlFor('agent'));
})->name('delagent');

$app->post('/agent','authenticate',function () use ($app) {
   require_once './config/db.php';
   $cid = $_SESSION['cid'];
   $eid = $_SESSION['eid'];
   $r = $app->request()->post();
   if($r['id'] > 0){
      $sql = "update users set station_id = '${r['station_id']}' where id = ".$r['id'];
      $ins = $db->query($sql);
      if($ins){
         $app->flash('success', 'Agent saved successfully!');
      }else{
         $app->flash('error', 'Saving failed!');
      }
   }  $app->redirect($app->urlFor('agent',['cid' => $cid,'eid' => $eid]));
})->name('postagent');







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
    //$_SESSION['user'] = ['name'=> 'Kobby','id'=> '1','role_id'=> 5];
    if (!isset($_SESSION['user']) || $_SESSION['user'] == null) {
      $app = \Slim\Slim::getInstance();
      $app->flash('error', 'Login required');
      $app->redirect($app->urlFor('login'));
   }
}


/* Entry or Index Page */
$app->get('/', 'authenticate',function () use ($app) {
   if(isset($_SESSION['user'])){
      if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == '5'){
         $app->redirect($app->urlFor('dashagent')); 
      }else{
         $app->redirect($app->urlFor('dashadmin')); 
      }
   }else{
      $app->redirect($app->urlFor('login')); # Auth Login
   }
})->name('index');


$app->get('/main/:usn', 'authenticate',function ($usn) use ($app) {
   require_once './config/db.php';
   $s = $db->query("select s.* from sites s left join users u on s.id = u.site_id where s.id = ".$usn." or s.slug = '".$usn."'");
   if($s->num_rows > 0){
      $row = $s->fetch_assoc();
      $_SESSION['site'] = $row;
      // Redirect to Login Page
      $app->redirect($app->urlFor('login')); 
   }else{
      // Redirect to Registration Page
      $app->redirect('404');
   }
   
})->name('main');




$app->get('/dashagent',function () use ($app) {
   require_once './config/db.php';
   $s = $db->query("select sum(total_reg_voters) as voters  from polling_voters where station_id = ".$_SESSION['user']['station_id']." and site_id = ".$_SESSION['user']['site_id'])->fetch_assoc();
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/dashagent.php',
      'slug' => 'dashagent',
      'title' => 'AGENT DASHBOARD',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'app' => $app,'voters' => $s['voters']
   ]);
})->name('dashagent');

$app->get('/dashadmin',function () use ($app) {
   require_once './config/db.php';
   $s = $db->query("select sum(total_reg_voters) as voters from polling_voters where site_id = ".$_SESSION['user']['site_id'])->fetch_assoc();
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/dashadmin.php',
      'slug' => 'dashadmin',
      'title' => 'ADMIN DASHBOARD',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'app' => $app, 'voters' => $s['voters']
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
   if($_SESSION['user']['role_id'] == 4){
      $sql2 = $db->query("select * from `roles` where status = 1 and id in (4,5)");
      $sql = $db->query("select u.*,date_format(dob,'%Y-%m-%d') as dob,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,r.role_name as privilege, c.constituency_name as constituency from `users` u left join constituencies c on c.id = u.constituency_id left join `roles` r on r.id = u.role_id where u.role_id <> 1 and u.site_id = ".$_SESSION['user']['site_id']);
   }else{
      $sql2 = $db->query("select * from `roles` where status = 1");
      $sql = $db->query("select u.*,date_format(dob,'%Y-%m-%d') as dob,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,r.role_name as privilege, c.constituency_name as constituency from `users` u left join constituencies c on c.id = u.constituency_id left join `roles` r on r.id = u.role_id");
   }
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
   $data = []; $roles = []; $consts = []; $sites = [];
   if($_SESSION['user']['role_id'] == 4){
      $sql2 = $db->query("select * from `roles` where status = 1 and id in (4,5)");
   }else{
      $sql2 = $db->query("select * from `roles` where status = 1");
   }
   $sql3 = $db->query("select * from `constituencies` where status = 1");
   $sql4 = $db->query("select * from sites");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   if($sql4->num_rows > 0){ while($row = $sql4->fetch_assoc()){ $sites[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adduser.php',
       'slug' => 'user',
       'title' => 'ADD USER ACCOUNT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0], 'roles' => $roles, 'consts' => $consts, 'sites' => $sites, 'app' => $app
   ]);
})->name('adduser');

$app->get('/edituser/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $data = []; $roles = []; $consts = []; $sites = [];
   $sql = $db->query("select * from `users` where id = ".$id);
   if($_SESSION['user']['role_id'] == 4){
      $sql2 = $db->query("select * from `roles` where status = 1 and id in (4,5)");
   }else{
      $sql2 = $db->query("select * from `roles` where status = 1");
   }
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   $sql4 = $db->query("select * from sites");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $roles[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   if($sql4->num_rows > 0){ while($row = $sql4->fetch_assoc()){ $sites[] = $row; }}
   $row = null ; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/adduser.php',
       'slug' => 'user',
       'title' => 'EDIT USER ACCOUNT',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => $row, 'roles' => $roles, 'sites' => $sites,  'consts' => $consts, 'app' => $app
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
      if($_SESSION['user']['role_id'] == 1){ $siteid = $r['site_id'];}else{$siteid = $_SESSION['user']['site_id'];} 
      $password = md5($r['password']);
      $ins = $db->query("insert into `users`(fname,mname,lname,username,cellphone,dob,role_id,constituency_id,status,password,site_id) values('${r['fname']}','${r['mname']}','${r['lname']}','${r['username']}','${r['cellphone']}','${r['dob']}',${r['role_id']},${r['constituency_id']},${r['status']},'${password}',${siteid})");
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
   $sql = $db->query("select p.*,e.area_name,c.constituency_name as constituency,v.total_reg_voters from polling_stations p left join constituencies c on c.id = p.constituency_id left join electoral_areas e on p.area_id = e.id left join polling_voters v on v.station_id = p.id  where p.status = 1");
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
       'row' => ['id'=> 0,'pid'=> 0],'areas' => $areas,'consts' => $consts,'app' => $app
   ]);
})->name('addstation');

$app->get('/editstation/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $areas = []; $consts = [];
   $sql2 = $db->query("select e.*,c.constituency_name as constituency from `electoral_areas` e left join constituencies c on e.constituency_id = c.id where e.status = 1 order by c.constituency_name,e.area_name");
   $sql3 = $db->query("select * from `constituencies` where status = 1 order by constituency_name");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $areas[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $consts[] = $row; }}
   $sql = $db->query("select p.*,v.total_reg_voters,v.id as pid from polling_stations p left join polling_voters v on p.id = v.station_id where p.id = ".$id." and v.site_id = ".$_SESSION['user']['site_id']." and v.election_id = ".$_SESSION['user']['election_id']);
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
   $app->redirect($app->urlFor('station'));
})->name('delstation');

$app->post('/station', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['area_id'] =  $r['area_id'] == '' ? 0 : $r['area_id'];
   if($r['id'] > 0){
       $ins = $db->query("update polling_stations set station_name = '${r['station_name']}', station_code = '${r['station_code']}', serial_num = '${r['serial_num']}', total_reg_voters = '${r['total_reg_voters']}', constituency_id = ${r['constituency_id']}, area_id = ${r['area_id']}, status = ${r['status']} where id = ".$r['id']);
       $ins = $db->query("update polling_voters set total_reg_voters = '${r['total_reg_voters']}' where id = ".$r['pid']);
   }else{
       $ins = $db->query("insert into polling_stations(station_name,station_code,serial_num,total_reg_voters,constituency_id,area_id,status)  values('${r['station_name']}','${r['station_code']}','${r['serial_num']}',${r['total_reg_voters']},${r['constituency_id']},${r['area_id']},${r['status']})");
       $ins = $db->query("insert into polling_voters(station_id,election_id,total_reg_voters,site_id) values(".$db->insert_id.",".$_SESSION['user']['election_id'].",".$r['total_reg_voters'].",".$_SESSION['user']['site_id'].")");
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
   $sql = $db->query("select u.*,p.station_name,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,v.total_reg_voters,v.posted,date_format(v.posted_at,'%M %d, %Y %h:%i %p') as posted_at from `users` u left join polling_stations p on p.id = u.station_id left join polling_voters v on p.id = v.station_id  where u.role_id = 5 and v.election_id = ${eid} and u.status = 1 and u.site_id = ".$_SESSION['user']['site_id']);
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





/* Candidate Routes */
$app->get('/candid', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $sql = $db->query("select c.*,t.party_code,e.election_type,concat(fname,ifnull(concat(' ',mname),''),' ',lname) as name from candidates c left join political_parties t on c.party_id = t.id left join election_types e on e.id = c.election_type_id where site_id = ".$_SESSION['user']['site_id']." order by election_type_id,ballot_position");
   $data = []; 
   if($sql->num_rows > 0){ while($row = $sql->fetch_assoc()){ $data[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/candid.php',
       'slug' => 'candid',
       'title' => 'CANDIDATES',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'data' => $data, 'app' => $app
   ]);
})->name('candid');

$app->get('/addcandid', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $parties = []; $types = [];
   $sql2 = $db->query("select * from `political_parties` where status = 1");
   $sql3 = $db->query("select * from `election_types` where status = 1");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $parties[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $types[] = $row; }}
   $app->render('mainlayout.php',[
       'page' => 'pages/admin/addcandid.php',
       'slug' => 'candid',
       'title' => 'ADD CANDIDATE',
       'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
       'row' => ['id'=> 0],'types' => $types,'parties' => $parties,'app' => $app
   ]);
})->name('addcandid');

$app->get('/editcandid/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $parties = []; $types = [];
   $sql2 = $db->query("select * from `political_parties` where status = 1");
   $sql3 = $db->query("select * from `election_types` where status = 1");
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $parties[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $types[] = $row; }}
   $sql = $db->query("select * from candidates where id = ".$id);
   $row = null; if($sql->num_rows > 0){ $row = $sql->fetch_assoc();}
   $app->render('mainlayout.php',[
     'page' => 'pages/admin/addcandid.php',
     'slug' => 'candid',
     'title' => 'EDIT CANDIDATE',
     'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
     'row' => $row, 'types' => $types, 'parties' => $parties, 'app' => $app
   ]);
})->name('editcandid');

$app->get('/delcandid/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $ss = $db->query("select head_id from votes_dump where candidate_id = ".$id);
   if($ss->num_rows > 0){ 
     while($row = $ss->fetch_assoc()){
       $m1 = $db->query("delete from votes_head where id = ".$row['head_id']);
       $m2 = $db->query("delete from votes_dump where head_id = ".$row['head_id']);
     }
   }
   $sql = $db->query("delete from candidates where id = ".$id);
   if($sql->affectedRows > 0){
      $app->flash('success', 'Candidate deleted successfully!');
   }else{
      $app->flash('error', 'Unable to delete candidate!');
   }
   $app->redirect($app->urlFor('candid'));
})->name('delcandid');

$app->post('/candid', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $r['area_id'] =  $r['area_id'] == '' ? 0 : $r['area_id'];
   if($r['id'] > 0){
      $ins = $db->query("update `candidates` set fname = '${r['fname']}', mname = '${r['mname']}', lname = '${r['lname']}', sex = '${r['sex']}', election_type_id = ${r['election_type_id']}, ballot_position = ${r['ballot_position']}, party_id = ${r['party_id']}, status = ${r['status']} where id = ".$r['id']);
   }else{
      $r['site_id'] = $_SESSION['user']['site_id'];
      $r['election_id'] = $_SESSION['user']['election_id'];
      $r['constituency_id'] = $_SESSION['user']['constituency_id'];
      $ins = $db->query("insert into `candidates`(fname,mname,lname,sex,election_type_id,ballot_position,party_id,election_id,constituency_id,site_id,status) values('${r['fname']}','${r['mname']}','${r['lname']}','${r['sex']}',${r['election_type_id']},${r['ballot_position']},${r['party_id']},${r['election_id']},${r['constituency_id']},${r['site_id']},${r['status']})");
      $cid = $db->insert_id;
      // If New Candidate is added, Populate candidacy for all Polling Stations
      $sql = $db->query("select v.station_id from polling_voters v left join polling_stations p on p.id = v.station_id where site_id = ".$r['site_id']." and p.constituency_id = ".$r['constituency_id']." order by v.station_id");
      if($sql->num_rows > 0){ 
         while($row = $sql->fetch_assoc()){
            // Check votes_head exist then Insert if not!
            $hid = 0;
            $ss = $db->query("select id from votes_head where station_id = ${row['station_id']} and election_id = ${r['election_id']} and election_type_id = ${r['election_type_id']} and site_id = ${r['site_id']}");
            if($ss->num_rows > 0){ 
               $sx = $ss->fetch_assoc();
               $hid = $sx['id'];
            }else{
               $ins1 = $db->query("insert into `votes_head`(station_id,election_id,election_type_id,site_id) values(${row['station_id']},${r['election_id']},${r['election_type_id']},${r['site_id']})");
               $hid = $db->insert_id;
            }
            // Dump votes_dump of candidate
            $ins2 = $db->query("insert into `votes_dump`(head_id,candidate_id,station_id,site_id) values(${hid},${cid},${row['station_id']},${r['site_id']})");
         }
      }
   
      
   }
   if($ins){
      $app->flash('success', 'Candidacy staged successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }
   $app->redirect($app->urlFor('candid'));
})->name('postcandid');



/* Polling Entries Routes */
$app->get('/entries', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $pres = []; $pars = [];
   $sql2 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 2 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$_SESSION['user']['station_id']);
   $sql3 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 1 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$_SESSION['user']['station_id']);
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $pres[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $pars[] = $row; }}
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/entries.php',
      'slug' => 'entries',
      'title' => 'ADANSI SOKWA POLLING STATIONS RESULTS ENTRY',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'pres' => $pres, 'pars' => $pars,'app' => $app
   ]);
})->name('entries');

/* Polling Entries Routes */
$app->get('/entries/:id', 'authenticate',function ($id) use ($app) {
   require_once './config/db.php';
   $pres = []; $pars = [];
   $sql2 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 2 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$id);
   $sql3 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 1 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$id);
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $pres[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $pars[] = $row; }}
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/entries.php',
      'slug' => 'entries',
      'title' => 'ADANSI SOKWA POLLING STATIONS RESULTS ENTRY',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'pres' => $pres, 'pars' => $pars,'app' => $app
   ]);
})->name('pollentries');


$app->post('/entries', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $r = $app->request()->post();
   $keys = array_keys($r);
   foreach($keys as $key){
      $mk = explode('_',$key);
      $votes = $r[$key];
      $id = $mk[1];
      if($mk[0] == 'votes'){
        $ins = $db->query("update votes_dump set valid_votes = ${votes}, updated_by = ".$_SESSION['user']['id']." where id =".$id);
      }else if($mk[0] == 'rvotes'){
        $ins = $db->query("update votes_head set posted = 1,rejected_votes = ${votes}, updated_by = ".$_SESSION['user']['id'].", posted_by = ".$_SESSION['user']['id']." where id =".$id);
      }
   }
   if($ins){
      $app->flash('success', 'Result posted successfully!');
   }else{
      $app->flash('error', 'Saving failed!');
   }  $app->redirect($app->urlFor('index'));
})->name('postentries');


/* Polling Station Results Routes */
$app->get('/resultsum', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $pres = []; $pars = [];
   $vars = $db->query("select c.constituency_name,e.election_name from sites s left join constituencies c on c.id = s.constituency_id left join elections e on e.id = s.election_id where s.id = ".$_SESSION['user']['site_id'])->fetch_assoc();
   $sql2 = $db->query("select distinct d.candidate_id,v.election_type_id,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where d.site_id = ".$_SESSION['user']['site_id']." and v.election_type_id = 2");
   $sql3 = $db->query("select distinct d.candidate_id,v.election_type_id,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where d.site_id = ".$_SESSION['user']['site_id']." and v.election_type_id = 1");
   $n = $db->query("select ifnull(sum(rejected_votes),0) as rvotes,ifnull(sum(total_votes_cast),0) as tvotes from votes_head where election_type_id = 2 and site_id = ".$_SESSION['user']['site_id'])->fetch_assoc();
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ 
      $m = $db->query("select ifnull(sum(valid_votes),0) as votes from votes_dump where candidate_id = ".$row['candidate_id']." and site_id = ".$_SESSION['user']['site_id'])->fetch_assoc();
      $row['valid_votes'] = $m['votes'];
      $row['rejected_votes'] = $n['rvotes'];
      $row['total_votes_cast'] = $n['tvotes'];
      $pres[] = $row;  
   }}

   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ 
      $m = $db->query("select ifnull(sum(valid_votes),0) as votes from votes_dump where candidate_id = ".$row['candidate_id']." and site_id = ".$_SESSION['user']['site_id'])->fetch_assoc();
      $row['valid_votes'] = $m['votes'];
      $row['rejected_votes'] = $n['rvotes'];
      $row['total_votes_cast'] = $n['tvotes'];
      $pars[] = $row;
   }}
   $app->render('pages/admin/resultoview.php',[
      'slug' => 'resultoview',
      'title' => 'ADANSI SOKWA POLLING STATIONS RESULTS ENTRY',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'pres' => $pres, 'pars' => $pars,'app' => $app, 'vars' => $vars
   ]);
})->name('resultsum');


$app->get('/resultstation', 'authenticate',function () use ($app) {
   require_once './config/db.php';
   $id = $_SESSION['user']['station_id'];
   $pres = []; $pars = [];
   $sql2 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes,v.total_votes_cast from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 2 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$id);
   $sql3 = $db->query("select d.*,concat(c.fname,ifnull(concat(' ',c.mname),''),' ',c.lname) as name,c.ballot_position,p.party_code,v.rejected_votes,v.total_votes_cast from votes_dump d left join votes_head v on d.head_id = v.id left join candidates c on c.id = d.candidate_id left join political_parties p on p.id = c.party_id where v.election_type_id = 1 and d.site_id = ".$_SESSION['user']['site_id']." and d.station_id = ".$id);
   if($sql2->num_rows > 0){ while($row = $sql2->fetch_assoc()){ $pres[] = $row; }}
   if($sql3->num_rows > 0){ while($row = $sql3->fetch_assoc()){ $pars[] = $row; }}
   $app->render('mainlayout.php',[
      'page' => 'pages/admin/resultdetail.php',
      'slug' => 'entries',
      'title' => 'ADANSI SOKWA POLLING STATIONS RESULTS ENTRY',
      'subtitle' => 'ADANSI-ASOKWA CONSTITUENCY.',
      'pres' => $pres, 'pars' => $pars,'app' => $app
   ]);
})->name('resultstation');





<?php 
if(!isset($_SESSION)){
  session_start();
}


// Curl Fetch Command
function apipost($url,$form){
   try{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $form);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , false);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
   }catch(Exception $e){
      throw $e;
   }
};




/* Login Page */
$app->get('/login', function () use ($app) {
   $app->render('pages/auth/login.php',['app'=>$app]);
})->name('login');

$app->get('/logout', function () use ($app)   {
   unset($_SESSION['user']);
   unset($_SESSION['access_token']);
   $_SESSION['user'] = null;
   $_SESSION['access_token'] = null;
   $app->redirect($app->urlFor('login'));
})->name('logout');


/* Local Provider */
$app->post('/postlogin', function () use ($app) {
  require './config/db.php';
  $r = $app->request();
  $username = trim($r->post('username'));
  $password = md5(trim($r->post('password')));
  if($username == '' || $password == ''){
     $app->flash('error', 'Please enter username or password!');
     $app->redirect($app->urlFor('login'));

  }else{
     if(!empty(trim($username)) && !empty(trim($password))){
        $sl = "select u.*,r.role_name,concat(u.fname,ifnull(concat(' ',u.mname),''),' ',u.lname) as name,s.* from users u left join roles r on u.role_id = r.id left join sites s on s.id = u.site_id where u.username = '".$username."' and password = '".$password."'";
            $res = $db->query($sl);
            if($res->num_rows > 0){
                  $row = $res->fetch_assoc();
                  // Initialise Session
                  $_SESSION['user'] = $row;
                  $app->redirect($app->urlFor('index'));
                 
            }else{
                  $app->flash('error', 'Wrong user credentials!');
                  $app->redirect($app->urlFor('login'));
            }
     }else{
         $app->flash('error', $resp['msg']);
         $app->redirect($app->urlFor('login'));
     }
  }
})->name('postlogin');



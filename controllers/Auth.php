<?php
    
    
    require('../models/Auth.php');

   

    ini_set('display_errors', 1);

    if(isset($_POST['Login'])){
        
        //echo "inside login route";
        $login = FALSE;
        $login_data = array($_POST['username'], $_POST['password']);
        
        $login = login_check($login_data);
        if($login == TRUE){
            header('Location:../pages/home.php');
            exit;
        }else{
            header('Location:../login.php');
        }
    }

    /*
    logout user
	*/
	function logout()
	{
		unset_session();
        header('Location:../login.php');
        exit;
	}







?>
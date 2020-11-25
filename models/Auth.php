<?php
    
    require('../config/Database.php');

    /*
	Authenticate user log in
	*/
	function login_check($data)
	{
        $errors = array();
        $conn = get_connection();
		$sql = "SELECT * FROM ems.users WHERE username=\"$data[0]\"";
        $result = $conn->query($sql);
        $row = $result->fetch();
        
        if($row){
            $db_password = $row['password'];
            $hash_password = md5($data[1]);
            //$hash_password = password_hash($data[1], PASSWORD_DEFAULT);
            if($hash_password == $db_password){
                                
                $_SESSION['ROLE']=$row['role_id'];
                $_SESSION['USER']=$row['username'];
                $_SESSION['STATION']=$row['station_id'];
                $_SESSION['CONSTITUENCY']=$row['constituency_id'];
                
                return TRUE;
            }else{
                $errors[]='Incorrect username or password! ';
                return FALSE;
            }
            
        } 
        else{
            $errors[]='Login Error! ';
            return FALSE;
        }
	}

    /*
	Gets all users
	*/
	function get_all_users()
	{
		$qry = 'SELECT ';
		return $results;
	}

    /*
	Gets user data
	*/
	function get_user_data($id)
	{
		$qry = 'SELECT ';
		return $results;
	}



?>
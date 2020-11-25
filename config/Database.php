<?php



    /*
	Mysql Connection PDO
	*/
    function get_connection()
    {
        
        $db = "ems";
        $host="localhost";
        $user="root";
        $passwd="DHRCdodowa1";
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $passwd);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }


?>
<?php
if(!isset($_SESSION)) session_start();
     $_SESSION['connect'] = ['host'=>'127.0.0.1','user'=>'root','pass'=>'DHRCdodowa1','db'=>'ems'];
     $db = new mysqli($_SESSION['connect']['host'],$_SESSION['connect']['user'],$_SESSION['connect']['pass'],$_SESSION['connect']['db']);
    
    

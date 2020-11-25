<?php if(!isset($_SESSION)){session_start();}?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ELECTION MANAGER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Election Manager">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= $_SESSION['asset']?>/public/css/main.css" rel="stylesheet">
   
    <style>
         .thead_red{
           background: #cf152b;
           color:#fff;
           border-radius:10px;
         }

         .thead_green{
           background: #196436;
           color:#fff;
         }

         .main-card {
           border:3px solid #196436;
         }

         input[type=text].form-control,select.form-control,.vote_input,input[type=date].form-control {
            background: #d4f7e1;
            border: 1px dashed #196436;
            border-radius: 0;
            box-shadow: none;
            outline-color: none;
            color: #196436;
            font-weight: bolder;
            font-size:11px;
            text-transform:uppercase;
        }

        .vote_input{
          padding: 5px 10px;
        }

        label{
          color:brown;
          font-weight:bolder;
          font-size:12px;
        }

    </style>
</head>
<body>
    
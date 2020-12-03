<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>2020 GENERAL ELECTION MONITORING</title>
    
<link rel="stylesheet" href="./public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="./public/css/main_style.css"> 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
 <script type="text/javascript">
    $(function(){
        setTimeout(function(){
          $('#msg').hide();
        },3000);
    });
    
</script>
</head>

<body class="login-body">
    <div class="login-cover">
        <form method="post" action="postlogin" class="login-form">
            <img class="login-logo" src="<?= $_SESSION['asset'];?>/public/images/ndc_logo.png"/>
            <h2 class="title"><?= $_SESSION['site']['party_code'];?> LOGIN</h2>
            
            <?php if(isset($_SESSION['slim.flash']['error'])){ ?>
            <div class="error" id="error">
                <span class="error-text"><?= strtoupper($_SESSION['slim.flash']['error']); ?></span>
            </div>
            <?php } ?>
           
            <div class="form-group">
                <label for="Username" class="login-label">Username</label>
                <input type="text" name="username" class="form-control login-input" id="username" required>
            </div>
            
            <div class="form-group">
                <label for="Password" class="login-label">Password</label>
                <input type="password" name="password" class="form-control login-input" id="password" required>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-danger form-control login-btn" value="SIGN IN">
            </div>

            <small class="adamu">&copy; <?= date('Y'); ?>, All rights reserved. Powered By Joel Consultancy Limited.  </small>
        </form>
    </div>
    
</body>
</html>
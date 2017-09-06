<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Ad Creator Test Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="bootstrap-3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script type="text/javascript" src="js/main.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
     	        <header>
     	            <a class="logo col-sm-8 col-sm-offset-2" href="/"></a>
<div id="status"></div>
     	        </header>
                <div class="col-sm-8 col-sm-offset-2">
<?php
include('lib/fb-auth.php');
$fb = getFacebook();
$user = getUser($fb);
if($user) {
  header('Location: /');
  exit;
} 
login($fb, "http://$_SERVER[HTTP_HOST]/login-callback.php");
?>

		</div>
            </div>
        </div>
    </body>
</html>


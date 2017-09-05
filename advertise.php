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
     	            <div class="logo col-sm-8 col-sm-offset-2"></div>
     	        </header>
                <div class="col-sm-8 col-sm-offset-2 centered">
 <?php

include('main.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST["url"])) {
    $url = $_POST["url"];
    echo main($url);
    ?>
      <br/>
      Ad created, <a href="https://www.facebook.com/ads/manager/account/ads/">activate it now in the ad manager</a>.
      <br/>Or <a href="/">give it another shot here</a>.
    <?php
  }
  else {
    ?>
    url is expected in POST data, go back to <a href="/">test page</a>
    <?php
  }
}
else {
?>
POST request expected, go back to <a href="/">test page</a>
<?php
}
?>
        </div>
    </body>
</html>




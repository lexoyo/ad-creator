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
<div id="status" class="col-sm-4 col-sm-offset-2"></div>
     	        </header>
                <div class="col-sm-8 col-sm-offset-2">
<?php
include('lib/fb-auth.php');
$fb = getFacebook();
if(!isLoggedIn($fb) || !getUser($fb)) {
  header('Location: /login.php');
  exit;
}
$user = getUser($fb);
displayUser($user);
?>
     	            <!-- <h1>Ad Creator Test Page</h1> -->
                    <form id="form" action="./generate.php" method="GET" class="row">
                        <div class="field-set">
                            <legend>Advertise an URL</legend>
                            <div class="form-group col-md-9 no-padding-left">
                                <label>URL</label>
                                <input id="url" name="url" type="url" class="form-control"/>
                            </div>
			    <!-- 
                            <div class="form-group col-md-3">
                                <label>Option</label>
                                <select id="option" name="option" class="form-control">
                                    <option value="test">to do</option>
                                </select>
                            </div>
			    -->
                        </div>
                        <!--
                        <div class="field-set" data-jw-player-options>
                            <legend>Preview</legend>
                        </div>
			-->
                        <div class="form-group clear">
                            <input type="submit" name="op" value="Run" class="btn btn-primary submit" />
                        <!--
                            <input type="reset" value="Reset" class="btn btn-default" />
                            <a href="?" class="btn btn-default">Defaults</a>
                        -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


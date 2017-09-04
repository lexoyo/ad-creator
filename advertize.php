<?php

include('fb.php');
newCampaign('test auto generate campaign');


/**
 * GET: display a form to ask for an URL
 * POST: post a URL to generate an ad on Facebook
 */

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $url= "Please provide URL";
  if(isset($_POST["url"])) {
    $url = $_POST["url"];
  }
  file_put_contents('logs.txt', $_SERVER['REQUEST_METHOD'] . " - " . $url . "\n",  FILE_APPEND );


?>
Ad created, <a href="https://www.facebook.com/ads/manager/account/ads/">activate it now in the ad manager</a>
<?php
}
else {
?>

  <form action="" method="post">
    <input type="url" name="url" value="" required />
    <input type="submit" name="Submit" value="Submit" />
  </form>

<?php
}



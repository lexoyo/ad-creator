<?php

require_once __DIR__ . '/vendor/autoload.php';
include('fb.php');

function checkEnvVar($name, $val) {
  if(!$val) {
    echo "env var $name is required";
    die();
  }
}
$ad_account_id = getenv('FB_ACCOUNT_ID');
checkEnvVar('FB_ACCOUNT_ID', $ad_account_id);
$app_id = getenv('FB_APP_ID');
checkEnvVar('FB_APP_ID', $app_id);
$app_secret = getenv('FB_APP_SECRET');
checkEnvVar('FB_APP_SECRET', $app_secret);
$access_token = getenv('FB_APP_ACCESS_TOKEN');
checkEnvVar('FB_APP_ACCESS_TOKEN', $access_token);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST["url"])) {
    $url = $_POST["url"];
    initFBSDK($app_id, $app_secret, $access_token);
    echo createAdFromContent($ad_account_id, $url, 'assets/ad2.jpg', 'Generated creative', 'body');
    ?>
      <br/>
      Ad created, <a href="https://www.facebook.com/ads/manager/account/ads/">activate it now in the ad manager</a>
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




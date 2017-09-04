<?php

require_once __DIR__ . '/vendor/autoload.php';
include('fb.php');

function checkEnvVar($name, $val) {
  if(!$val) {
    echo "env var $name is required";
    die();
  }
}
function main($url) {
  $ad_account_id = getenv('FB_ACCOUNT_ID');
  checkEnvVar('FB_ACCOUNT_ID', $ad_account_id);
  $app_id = getenv('FB_APP_ID');
  checkEnvVar('FB_APP_ID', $app_id);
  $app_secret = getenv('FB_APP_SECRET');
  checkEnvVar('FB_APP_SECRET', $app_secret);
  $access_token = getenv('FB_APP_ACCESS_TOKEN');
  checkEnvVar('FB_APP_ACCESS_TOKEN', $access_token);

  $imageUrl = 'http://aotw-pd.s3.amazonaws.com/images/crash_test_baixa.jpg';

  initFBSDK($app_id, $app_secret, $access_token);
  return createAdFromContent($ad_account_id, $url, $imageUrl, 'Generated creative', 'body');
}

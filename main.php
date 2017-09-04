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
  // Embed
  $embedUrl = 'https://api.embed.rocks/api/?key=85f6a5c5-06f8-45d9-b3cc-c41f931c79d2&url=' . urlencode($url);
  $embedData = json_decode(file_get_contents($embedUrl));
  //print_r($embedData);

  $title = preg_replace('/[^ \w]+/', '', $embedData->title); // Ads can only contain letters, numbers, punctuation marks, and spaces.
  $body = $embedData->description;
  $imageUrl = $embedData->images[0]->url;

  //echo "$title\n$body\n$imageUrl";
  
  // FB
  $ad_account_id = getenv('FB_ACCOUNT_ID');
  checkEnvVar('FB_ACCOUNT_ID', $ad_account_id);
  $app_id = getenv('FB_APP_ID');
  checkEnvVar('FB_APP_ID', $app_id);
  $app_secret = getenv('FB_APP_SECRET');
  checkEnvVar('FB_APP_SECRET', $app_secret);
  $access_token = getenv('FB_APP_ACCESS_TOKEN');
  checkEnvVar('FB_APP_ACCESS_TOKEN', $access_token);

  // $imageUrl = 'http://aotw-pd.s3.amazonaws.com/images/crash_test_baixa.jpg';

  initFBSDK($app_id, $app_secret, $access_token);
  return createAdFromContent($ad_account_id, $url, $imageUrl, $title, $body);
}

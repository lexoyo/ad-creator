<?php

date_default_timezone_set('Europe/Bucharest');
require_once __DIR__ . '/vendor/autoload.php';
include('fb.php');

if(file_exists('config.php'))
  include 'config.php';

function getConfig($name) {
  // look for the env var
  $val = getenv($name);
  print_r($val);
  // look for the config var defined in config.php
  if(!$val && isset($GLOBALS[$name])) {
    $val = $GLOBALS[$name];
  }
  // check that it exists
  if(!$val) {
    echo "env var $name is required ($val)";
    die();
  }
  return $val;
}
function main($url) {
  // Embed
  $embedUrl = 'https://api.embed.rocks/api/?key=85f6a5c5-06f8-45d9-b3cc-c41f931c79d2&url=' . urlencode($url);

  $embedDataStr = file_get_contents($embedUrl);
  if(!$embedDataStr) {
    echo "Error: Was not able to load data from $embedUrl";
    throw "Error: Was not able to load data from $embedUrl";
  }
  $embedData = json_decode($embedDataStr);
  //print_r($embedData);

  $title = preg_replace('/[^ \w]+/', '', $embedData->title); // Ads can only contain letters, numbers, punctuation marks, and spaces.
  $body = $embedData->description;
  $imageUrl = $embedData->images[0]->url;

  //echo "$title\n$body\n$imageUrl";
  
  // FB
  $ad_account_id = getConfig('FB_ACCOUNT_ID');
  $app_id = getConfig('FB_APP_ID');
  $app_secret = getConfig('FB_APP_SECRET');
  $access_token = getConfig('FB_APP_ACCESS_TOKEN');

  // $imageUrl = 'http://aotw-pd.s3.amazonaws.com/images/crash_test_baixa.jpg';

  initFBSDK($app_id, $app_secret, $access_token);
  return createAdFromContent($ad_account_id, $url, $imageUrl, $title, $body);
}

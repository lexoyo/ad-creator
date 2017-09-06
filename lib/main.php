<?php

require_once 'config.php';
require_once 'fb-ads.php';


function main($url, $user) {
  // Embed
  $embedUrl = 'https://api.embed.rocks/api/?key=85f6a5c5-06f8-45d9-b3cc-c41f931c79d2&url=' . urlencode($url);

  $embedDataStr = file_get_contents($embedUrl);
  if(!$embedDataStr) {
    echo "Error: Was not able to load data from $embedUrl";
    throw "Error: Was not able to load data from $embedUrl";
  }
  $embedData = json_decode($embedDataStr);

  $title = preg_replace('/[^ \w]+/', '', $embedData->title); // Ads can only contain letters, numbers, punctuation marks, and spaces.
  $body = $embedData->description;
  $imageUrl = $embedData->images[0]->url;

  // echo "$title\n$body\n$imageUrl";
  
  // FB
  $ad_account_id = getConfig('FB_ACCOUNT_ID');
  $app_id = getConfig('FB_APP_ID');
  $app_secret = getConfig('FB_APP_SECRET');
  $access_token = getConfig('FB_APP_ACCESS_TOKEN');

  initFBSDK($app_id, $app_secret, $access_token);
  return createAdFromContent($ad_account_id, $url, $imageUrl, $title, $body, $user);
}

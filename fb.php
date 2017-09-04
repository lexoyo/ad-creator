<?php

require_once __DIR__ . '/vendor/autoload.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Init PHP Sessions
session_start();

$fb = new Facebook([
  'app_id' => '1948258332120118',
  'app_secret' => 'cd1c95cbe42d3c6935515435aa263d4b',
]);

$helper = $fb->getRedirectLoginHelper();

if (!isset($_SESSION['facebook_access_token'])) {
  $_SESSION['facebook_access_token'] = null;
}

if (!$_SESSION['facebook_access_token']) {
  $helper = $fb->getRedirectLoginHelper();
  try {
    $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
  } catch(FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
}

if ($_SESSION['facebook_access_token']) {
  echo "You are logged in!";
} else {
  $permissions = ['ads_management'];
  $loginUrl = $helper->getLoginUrl('http://localhost:8888/marketing-api/', $permissions);
  echo '<a href="' . $loginUrl . '">Log in with Facebook</a>';
} 












// use FacebookAds\Object\Campaign;
// use FacebookAds\Object\Fields\CampaignFields;
// use FacebookAds\Object\Values\CampaignObjectiveValues;
// 
// function newCampaign($name) {
// 
//   $campaign = new Campaign(null, 'act_<AD_ACCOUNT_ID>');
//   $campaign->setData(array(
//     CampaignFields::NAME => $name,
//     CampaignFields::OBJECTIVE => CampaignObjectiveValues::LINK_CLICKS,
//   ));
//   
//   $campaign->create(array(
//     Campaign::STATUS_PARAM_NAME => Campaign::STATUS_PAUSED,
//   ));
// } 
// 
// 

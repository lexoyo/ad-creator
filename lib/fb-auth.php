<?php
require_once 'config.php';

use Facebook\Facebook;
use Facebook\Helpers\FacebookRedirectLoginHelper;

function getFacebook() { 
  $ad_account_id = getConfig('FB_ACCOUNT_ID');
  $app_id = getConfig('FB_APP_ID');
  $app_secret = getConfig('FB_APP_SECRET');
  //$access_token = getConfig('FB_APP_ACCESS_TOKEN');

  $fb = new \Facebook\Facebook([
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.11',
    //'default_access_token' => '{access-token}', // optional
  ]);
 
  return $fb;
}
function isLoggedIn($fb) {
  return isset($_SESSION['facebook_access_token']);
}


function logout() {
  $_SESSION['facebook_access_token'] = null;
}

function login($fb, $callbackUrl) {
  $helper = $fb->getRedirectLoginHelper();
  $permissions = ['email', 'user_posts']; // optional
  $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);
  header('Location: ' . $loginUrl);
}

function loginCallback($fb) {
  $helper = $fb->getRedirectLoginHelper();
  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
  
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
  } elseif ($helper->getError()) {
    // The user denied the request
    exit;
  }
  else {
    echo "login failed";
  }
}


function getUser($fb) {
  $accessToken = $_SESSION['facebook_access_token'];
  try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', $accessToken);
  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    //echo 'Graph returned an error: ' . $e->getMessage();
    //exit;
    return null;
  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    // echo 'Facebook SDK returned an error: ' . $e->getMessage();
    // exit;
    return null;
  }
  
  $me = $response->getGraphUser();
  return $me;
}

function displayUser($user) {
  $name = $user->getName();
  echo "<script>document.getElementById('status').innerHTML='$name<br><a href=\"/logout.php\">Logout</a>';</script>";
}


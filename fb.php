<?php



use FacebookAds\Object\AdCreativeLinkData;
use FacebookAds\Object\Fields\AdCreativeLinkDataFields;
use FacebookAds\Object\AdCreativeObjectStorySpec;
use FacebookAds\Object\Fields\AdCreativeObjectStorySpecFields;


// wrap up all following methods calls into 1
function createAdFromContent($ad_account_id, $url, $imageUrl, $title, $body) {
  $account = getAccount($ad_account_id);
  $adset = getAdSets($account)[0];
  cleanupAdset($adset);
  $path = saveTmpImage($imageUrl);
  $image = createAdImage($account, $path);
  $creative = createAdCreative($account, $image, 'Generated creative '.date('m-d-Y_hia'), $title, $body, $url);
  $ad = createAd($account, $adset, $creative, 'Generated ad '.date('m-d-Y_hia'));
  $preview = getPreview($creative);
  return $preview->body;
}
function saveTmpImage($url) {
  $array = explode('.', $url);
  $extension = end($array);
  $path = 'assets/' . 'fb-proto-tmp-' . uniqid(rand(), true) . ".$extension";
  file_put_contents(
    $path,
    file_get_contents($url)
  );
  return $path;
}


// init FB SDK
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
function initFBSDK($app_id, $app_secret, $access_token) {
  $api = Api::init($app_id, $app_secret, $access_token);
  Api::instance()->setLogger(new CurlLogger(fopen("./log.txt", "w")));

}

// upload image
use FacebookAds\Object\AdImage;
use FacebookAds\Object\Fields\AdImageFields;
function createAdImage($account, $file) {
  $image = new AdImage();
  $image->{AdImageFields::FILENAME} = $file;
  $image->setParentId($account->id);
  $image->create();
  // echo "**************** Image Hash: ($file)".$image->{AdImageFields::HASH}.PHP_EOL;
  return $image;
}

// get the account out of the config
use FacebookAds\Object\AdAccount;
function getAccount($ad_account_id) {
  return new AdAccount($ad_account_id);
}

// list images
function listAdImages($account) {
  $images = $account->getAdImages();
  //echo count($images);
  foreach ($images as $image) {
    echo $image->{AdImageFields::HASH}.PHP_EOL;
  }
}

// get the adsets for this account
use FacebookAds\Object\Ad;
use FacebookAds\Object\Fields\AdSetFields;
function getAdSets($account) {
  $adsets = $account->getAdSets(array(
    AdSetFields::NAME,
  ));

  // This will output the name of all fetched ad sets.
  // foreach ($adsets as $adset) {
  // echo 'adset found: ' . $adset->name;
  // }
  // $adset_id = $adsets[0]->id;
  //echo "choose adset " ;
  //print_r($adset_id);
  return $adsets;
}

// if there is too many ads in the adset,
// delete all ads from the adset
function cleanupAdset($adset) {
  $ads = $adset->getAds();
  // echo "Found " . count($ads) . " ads in adset";
  if(count($ads) > 45) {
    foreach($ads as $ad) {
      $ad->deleteSelf();
    }
    // delete all ads from the adset
    echo "Found " . count($ads) . " ads in adset, had to cleanup";
  }
}


// Create an AdCreative
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;
function createAdCreative($account, $image, $name, $title, $body, $url) {
  $creative = new AdCreative();
  $creative->setParentId($account->id);

  $creative->setData(array(
          AdCreativeFields::NAME => $name,
          AdCreativeFields::TITLE => $title,
          AdCreativeFields::BODY => $body,
          AdCreativeFields::IMAGE_HASH => $image->hash,
          AdCreativeFields::OBJECT_URL => $url,
      ));
  $creative->create();
  echo 'Creative ID: '.$creative->id . "\n<br/>\n";
  return $creative;
}


// Create an Ad
use FacebookAds\Object\Fields\AdFields;
function createAd($account, $adset, $creative, $name) {
  $ad = new Ad();
  $ad->setParentId($account->id);

  $ad->setData(array(
          AdFields::CREATIVE =>
              array('creative_id' => $creative->id),
      	        AdFields::NAME => $name,
  		AdFields::ADSET_ID => $adset->id,
  		Ad::STATUS_PARAM_NAME => Ad::STATUS_PAUSED,
      	    ));
  $ad->create();
  echo 'Ad ID:' . $ad->id . "\n<br/>\n";
  return $ad;
}

// ad preview
// TODO: pass the type of preview (desktop, mobile, right col)
use FacebookAds\Object\Fields\AdPreviewFields;
use FacebookAds\Object\Values\AdPreviewAdFormatValues;
function getPreview($creative) {
  $previews = $creative->getPreviews(array(), array(
    AdPreviewFields::AD_FORMAT => AdPreviewAdFormatValues::RIGHT_COLUMN_STANDARD,
  ));
  $preview = $previews->offsetGet(0);
  // print_r($preview->{AdPreviewFields::BODY});
  return $preview;
}


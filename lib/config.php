<?php

session_start();
date_default_timezone_set('Europe/Bucharest');
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once __DIR__ . '/../vendor/autoload.php';


if(file_exists(__DIR__.'/../config.php'))
  include __DIR__.'/../config.php';

function getConfig($name) {
  // look for the env var
  $val = getenv($name);
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

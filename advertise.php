<?php

include('main.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST["url"])) {
    $url = $_POST["url"];
    echo main($url);
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




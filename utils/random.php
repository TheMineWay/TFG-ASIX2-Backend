<?php
  function randomText($len, $origin = "wxyzstumnop789ijkldqr0123abcv456efgh") {
    $txt = "";
    for($i = 0; $i < $len; $i++) {
      $txt = $txt.$origin[rand(0,strlen($origin) - 1)];
    }
    return $txt;
  }
?>
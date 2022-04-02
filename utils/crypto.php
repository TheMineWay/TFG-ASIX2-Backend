<?php
  function hashWithSalt(string $text, $rand = null) {
    if($rand == null) $rand = iv();
    return $rand.":".doHash($rand.$text);
  }

  function doHash(string $text) {
    return hash('sha3-512' , $text);
  }

  function compareHash(string $unhashed, string $hashed) {
    if(strpos($hashed, ":")) {
      $splitted = explode(":", $hashed);
      $salt = $splitted[0];
      return $splitted[1] === doHash($salt.$unhashed);
    }
    return $hashed == doHash($unhashed);
  }

  function iv($len = 32) {
    return randomText($len);
  }
?>
<?php
  // TODO: enable salt rounds
  function doHash(string $text) {
    return hash('sha3-512' , $text);
  }

  // TODO: should check salt rounds
  function compareHash(string $unhashed, string $hashed) {
    return $hashed == doHash($unhashed);
  }
?>
<?php
  // https://www.npmjs.com/package/react-google-map-picker

  function validate(array $structure, array $toValidate) {
    foreach($toValidate as $index => $value) {
      if(is_array($value)) return false;
      $func = null;
        switch($structure[$index]) {
          case "isPhone": $func = function ($text) {return isPhone($text);}; break;
          case "isEmail": $func = function ($text) {return isEmail($text);}; break;
          case "isCard": $func = function ($text) {return isCard($text);}; break;
          case "isPersonalId": $func = function ($text) {return isPersonalId($text);}; break;
          default: $func = function(string $txt) {return false;}; break;
        }

        if(!$func($value)) return false;
    }
    return true;
  }

  function isEmail(string $text) {
    if(filter_var($text, FILTER_VALIDATE_EMAIL)) return $text;
    error406();
  }

  function isPhone(string $text) {
    if(validateRegexp($text, '/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/')) return $text;
    error406();
  }

  function isCard(string $text) {
    if(validateRegexp($text, '^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$^')) return $text;
    error406();
  }

  function isPersonalId(string $text) {
    if(validateRegexp($text, '^[0-9]{8}([a-z]{1}|[A-Z]{1})^')) return $text;
    error406();
  }

  function validateRegexp(string $text, string $regexp) {
    $res = filter_var($text, FILTER_VALIDATE_REGEXP, [
      "options"=>[
          "regexp"=>$regexp
        ]
      ]
    );
    if($res) return $text;
    error406();
  }

  function validateLength(string $text, array $opts) {
    $len = strlen($text);
    $min = $opts["min"] ?? 0;
    $max = $opts["max"] ?? $len;
    

    if($len >= $min && $len <= $max) return $text;
    error406();
  }

  function validatePassword(string $text) {
    if(validateLength($text,["min"=>8,"max"=>128])) return $text;
    error406();
  }

  function validateDate($date, array $opts = []) {
    if(!$date) error406();

    return $date;
  }

  function validateNumberRange($number, array $opts) {
    $min = $opts["min"] ?? null;
    $max = $opts["max"] ?? null;

    if($min != null) {
      if($number < $min) error406();
    }

    if($max != null) {
      if($number > $max) error406();
    }

    return $number;
  }

  function validateBoolean($value) {
    if(is_bool($value)) return $value;
    error406();
  }
?>
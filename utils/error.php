<?php
  function throwHttpError($code = "500", $section = "http") {
    echo json_encode([
      "code"=>$code,
      "section"=>$section
    ]);
    exit;
  }

  function error500() {
    throwHttpError();
  }
?>
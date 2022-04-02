<?php
  function throwHttpError($code = "500", $section = "http") {
    echo json_encode([
      "code"=>$code,
      "section"=>$section
    ]);
    exit;
  }

  // Internal error
  function error500() {
    throwHttpError();
  }

  // Data not acceptable
  function error406() {
    throwHttpError("406");
  }

  // Unauthorized error
  function unauthorizedError() {
    throwHttpError("403");
  }
  
?>
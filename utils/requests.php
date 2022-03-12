<?php
  function request() {
    $server = $_SERVER;

    $ip = $server['REMOTE_ADDR'];
    $post = $_POST;
  
  
    return [
      "ip"=>$ip,
      "post"=>$post
    ];
  }

  function answer(array $data) {
    echo json_encode(
      [
        "code"=>"200",
        "section"=>"http",
        "data"=>$data
      ]
    );
    exit;
  }
?>
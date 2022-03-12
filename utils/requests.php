<?php
  function request() {
    $server = $_SERVER;

    $ip = $server['REMOTE_ADDR'];
    $post = json_decode(file_get_contents('php://input'), true);
    $data = $post["data"];
  
  
    return [
      "ip"=>$ip,
      "post"=>$post,
      "data"=>$data
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
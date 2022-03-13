<?php
  function request() {
    $server = $_SERVER;

    $ip = $server['REMOTE_ADDR'];
    $post = json_decode(file_get_contents('php://input'), true);
    $data = $post["data"];

    $user = false;
    if(isset($post["auth"])) {
      $user = fetchAuthUser($post, $ip);
    }

    return [
      "ip"=>$ip,
      "post"=>$post,
      "data"=>$data,
      "user"=>$user ?? false,
      "roles"=>$roles ?? []
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

  function fetchAuthUser($post, $ip) {
    $result = select("activeSessions", ["where"=>"id = ".sanitize($post["auth"]["session"])]);
    $session = $result["data"][0] ?? null;

    if($session == null) {
      throwHttpError('404','sess'); // ❌: Session not found
    }

    if($session["ip"] != $ip && false) {
      throwHttpError('401','sess'); // ❌: Session IP does not match
    }

    $uid = $session["user"];

    $user = select("users", ["where"=>"id = \"$uid\"", "limit"=>1])["data"][0] ?? false;

    return $user;
  }
?>
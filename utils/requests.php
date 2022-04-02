<?php
  function request() {
    $server = $_SERVER;

    $ip = $server['REMOTE_ADDR'];
    $post = json_decode(file_get_contents('php://input'), true);
    $data = $post["data"] ?? [];

    $user = false;
    if(isset($post["auth"])) {
      $user = fetchAuthUser($post, $ip);
    }

    $userPermissionsList = [];
    $userRolesList = [];
    if($user) {
      // Fetch user roles
      $userRolesList = fetchUserRoles($user["id"]);

      // Fetch user permissions
      $userPermissionsList = fetchUserPermissions($user["id"]);
    }

    return [
      "ip"=>$ip,
      "post"=>$post,
      "data"=>$data,
      "user"=>$user ?? false,
      "visibleUser"=>is_array($user) ? getUserVisibleData($user) : false,
      "rolesList"=>$userRolesList ?? [],
      "permissionsList"=>$userPermissionsList ?? []
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

  function fetchUserPermissions($uid) {
    // uid does not need sanitization because it is provided by an internal process
    return array_map(function($row) {
      return $row["name"];
    }, query("SELECT DISTINCT name FROM activeUserPermissions WHERE user = \"$uid\";"));
  }

  function fetchUserRoles($uid) {
    // uid does not need sanitization because it is provided by an internal process
    return array_map(function($row) {
      return $row["name"];
    }, query("SELECT DISTINCT name FROM activeUserRoles WHERE user = \"$uid\";"));
  }

  function fetchAuthUser($post, $ip) {
    $result = select("activeSessions", ["where"=>"id = ".sanitize($post["auth"]["session"])]);
    $session = $result["data"][0] ?? null;

    if($session == null) {
      throwHttpError('404','sess'); // ❌: Session not found
    }

    if($session["ip"] != $ip) {
      throwHttpError('401','sess'); // ❌: Session IP does not match
    }

    $uid = $session["user"];

    $user = select("users", ["where"=>"id = \"$uid\"", "limit"=>1])["data"][0] ?? false;

    return $user;
  }

  function getUserVisibleData(array $user) {
    return lodash($user, ["id", "name", "lastName", "email", "login", "phone", "birthdate", "createdAt", "updatedAt", "deletedAt"]);
  }
?>
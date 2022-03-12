<?php
  include('../utils/cors.php');
  include('../bbdd/bbdd.php');
  include('../utils/error.php');
  include('../utils/crypto.php');
  include('../utils/uuid.php');
  include('../utils/requests.php');

  $request = request();

  $data = $request["data"];

  // DEBUG VALUES
  $login = sanitize($data["login"], "");
  $password = sanitize($data["password"], "");
  
  $user = select("users", [
    "where"=>"login = \"$login\"",
    "limit"=>1
  ])["data"][0] ?? null;

  if($user == null) {
    throwHttpError("404","auth"); // ❌: User not found
  }

  if(!compareHash($password, $user["password"])) {
    throwHttpError("403","auth"); // ❌: Wrong password
  }

  // ✅: Nice user auth

  $sessionId = uuid("sessions","id");
  $result = insert("sessions", [[$sessionId, $user["id"], ["DATE_ADD(SYSDATE(), INTERVAL 1 DAY)"], $request["ip"]]], ["id","user","expiresAt","ip"]);
  if(!$result) {
    error500(); // ❌: Internal error
  }  

  answer(["token"=>$sessionId]); // ✅: Give access token
?>
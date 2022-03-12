<?php
  include('../global.php');

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
  $expiresAt = new Datetime("tomorrow");
  $expiresAt = $expiresAt->format('Y-m-d H:i:s');

  $result = insert("sessions", [[$sessionId, $user["id"], $expiresAt, $request["ip"]]], ["id","user","expiresAt","ip"]);
  
  if(!$result) {
    error500(); // ❌: Internal error
  }  

  answer([
    "token"=>$sessionId,
    "expiresAt"=>$expiresAt,
    "user"=>lodash($user, ["id","name","lastname","phone","isEmailVerified","createdAt"])
  ]); // ✅: Give access token
?>
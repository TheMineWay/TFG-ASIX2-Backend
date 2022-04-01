<?php
    include('../../global.php');

    $request = request();

    requireAuth($request);

    $user = $request["user"];
    $uid = $user["id"];
    $data = $request["data"];

    // Check if there is repeated data
    if($user["login"] != $data["login"]) {
        if(existsOnBBDD("users", "login", $data["login"])) {
            throwHttpError("login-in-use", "auth");
        }
    }

    if($user["email"] != $data["email"]) {
        if(existsOnBBDD("users", "email", $data["email"])) {
            throwHttpError("email-in-use", "auth");
        }
    }

    update('users', "id = '$uid'", [
        "name"=>validateLength($data["name"], ["min"=>1,"max"=>32]),
        "lastName"=>validateLength($data["lastName"], ["min"=>1,"max"=>32]),
        "phone"=>isPhone($data["phone"]),
        "email"=>isEmail($data["email"]),
        "login"=>validateLength($data["login"], ["min"=>6,"max"=>32]),
        "birthdate"=>validateDate($data["birthdate"])
    ]);

    $request = request();

    answer([
        "user"=>$request["visibleUser"],
    ]);
?>
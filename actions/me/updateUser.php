<?php
    include('../../global.php');

    $request = request();

    requireAuth($request);

    $uid = $request["user"]["id"];
    $data = $request["data"];

    // Check the email and login are unique

    update('users', "id = '$uid'", [
        "name"=>validateLength($data["name"], ["min"=>1,"max"=>32]),
        "lastName"=>validateLength($data["lastName"], ["min"=>1,"max"=>32]),
        "phone"=>isPhone($data["phone"]),
        "email"=>isEmail($data["email"]),
        "login"=>validateLength($data["login"], ["min"=>6,"max"=>32])
    ]);

    $request = request();

    answer([
        "user"=>$request["visibleUser"],
    ]);
?>
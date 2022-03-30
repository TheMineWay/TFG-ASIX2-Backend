<?php

    include('../../global.php');

    $request = request();

    $data = $request["data"];
    $user = $request["user"];

    if(!compareHash($data["old"], $user["password"])) {
        throwHttpError("403","auth"); // ❌: Wrong password
    }

    $newPassword = hashWithSalt(validatePassword($data["new"]));

    $uid = $user["id"];
    update("users", "id = '$uid'", ["password"=>$newPassword]);

    answer([]);
?>
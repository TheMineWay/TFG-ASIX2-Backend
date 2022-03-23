<?php
    include('../../global.php');

    $request = request();

    answer([
        "user"=>$request["user"],
        "permissions"=>$request["permissionsList"],
        "roles"=>$request["rolesList"],
    ]);
?>
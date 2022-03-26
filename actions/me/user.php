<?php
    include('../../global.php');

    $request = request();

    answer([
        "user"=>$request["visibleUser"],
        "permissions"=>$request["permissionsList"],
        "roles"=>$request["rolesList"],
    ]);
?>
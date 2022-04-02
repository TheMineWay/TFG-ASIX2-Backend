<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermission(['adminUsers'], $request);
    
    answer([
        "users"=>array_map(function ($user) {
            return lodash($user["data"], ["name","lastName","email","birthdate","login"]);
        }, select("users"));
    ]);

?>
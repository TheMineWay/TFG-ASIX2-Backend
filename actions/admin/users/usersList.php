<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);

    answer([
        "users"=>array_map(function ($user) {
            return getUserVisibleData($user);
        }, select("users", ["paranoid"=>false])["data"])
    ]);

?>
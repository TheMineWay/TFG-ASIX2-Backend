<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);

    $uid = sanitize($data["userId"]);

    answer([
        "user"=>array_map(function ($user) {
            return getUserVisibleData($user);
        }, select("users", [
            "paranoid"=>false,
            "where"=>"id = $uid"
        ])["data"])[0] ?? null
    ]);

?>
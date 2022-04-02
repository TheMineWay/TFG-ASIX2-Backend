<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    
    recover("users", "id = $uid");
    
    answer([]);

?>
<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermission(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    
    delete("users", "id = $uid");
    
    answer([]);

?>
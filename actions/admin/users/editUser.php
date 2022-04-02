<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermission(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    
    //update("users", "id = $uid", ["isBanned"=>'1']);
    
    answer([]);

?>
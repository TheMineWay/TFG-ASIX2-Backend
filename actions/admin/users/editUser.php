<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    
    //update("users", "id = $uid", ["isBanned"=>'1']);
    
    answer([]);

?>
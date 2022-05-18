<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    $roleId = sanitize($data["roleId"]);
    $action = $data["action"] == "1" ? "1" : "0";
    
    // Always try to delete the role assign
    delete("rolesAssign", "role = $roleId AND user = $uid");

    if($action == "1") {
        // Adding role
        insert("rolesAssign", [[uuid("id"), $data["roleId"], $data["user"]]], ["id","role","user"]);
    }
    
    answer([]);

?>
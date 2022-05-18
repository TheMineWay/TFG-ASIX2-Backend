<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminUsers'
    ], $request);

    $roles = select("rolesAssign")["data"];

    answer([
        "assign"=>$roles
    ]);
?>
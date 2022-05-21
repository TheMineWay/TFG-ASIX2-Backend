<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminRoles'
    ], $request);

    $data = $request["data"];
    $roleId = sanitize($data["id"]);

    delete('roles', "id = $roleId");

    answer([]);
?>
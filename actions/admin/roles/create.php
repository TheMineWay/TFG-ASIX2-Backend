<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminRoles'
    ], $request);

    $data = $request["data"];

    insert("roles", [[
        uuid("roles"),
        $data["name"],
        ['0']
    ]], ["id","name","superadmin"]);

    answer([]);
?>
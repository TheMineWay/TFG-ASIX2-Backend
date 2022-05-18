<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminRoles'
    ], $request);

    answer([
        "roles"=>select("permissions", ["fields"=>["id","name"]])["data"]
    ]);
?>
<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminUsers'
    ], $request);

    answer([
        "roles"=>select("permissions", ["fields"=>["id","name"]])["data"]
    ]);
?>
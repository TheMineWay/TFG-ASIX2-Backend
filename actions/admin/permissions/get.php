<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminUsers'
    ], $request);

    answer([
        "permissions"=>select("permissions", ["fields"=>["id","name"]])["data"]
    ]);
?>
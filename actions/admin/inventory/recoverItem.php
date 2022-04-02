<?php
    include('../../../global.php');

    $request = request();
    $data = $request["data"];
    
    requirePermissions([
        'adminInventory'
    ], $request);

    $id = sanitize($data["itemId"]);

    recover('inventory', "id = $id");

    answer([]);
?>
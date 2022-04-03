<?php
    include('../../../global.php');

    $request = request();
    $data = $request["data"];
    
    requirePermissions([
        'adminInventory'
    ], $request);

    $id = sanitize($data["itemId"]);

    delete('inventory', "id = $id");

    answer([]);
?>
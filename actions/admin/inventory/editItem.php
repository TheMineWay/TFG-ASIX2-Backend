<?php
    include('../../../global.php');

    $request = request();
    $data = $request["data"];
    $item = $data["item"];
    
    requirePermissions([
        'adminInventory'
    ], $request);

    $id = sanitize($data["itemId"]);

    $values = [
        "name"=>validateLength($item["name"], ["min"=>2,"max"=>32]),
        "description"=>validateLength($item["description"], ["min"=>2,"max"=>255]),
        "discount"=>validateNumberRange($item["discount"], ["min"=>0,"max"=>100]),
        "price"=>validateNumberRange($item["price"], ["min"=>0]),
        "stock"=>validateNumberRange($item["stock"], ["min"=>0])
    ];

    update('inventory', "id = $id", $values);

    answer([]);
?>
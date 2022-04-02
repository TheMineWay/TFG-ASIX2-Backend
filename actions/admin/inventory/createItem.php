<?php
    include('../../../global.php');

    $request = request();
    $data = $request["data"];
    $item = $data["item"];
    
    requirePermissions([
        'adminInventory'
    ], $request);

    $values = [
        uuid('inventory'),
        validateLength($item["name"], ["min"=>2,"max"=>32]),
        validateLength($item["description"], ["min"=>2,"max"=>255]),
        validateNumberRange($item["discount"], ["min"=>0,"max"=>100]),
        validateNumberRange($item["price"], ["min"=>0]),
        validateNumberRange($item["stock"], ["min"=>0]) // Maybe -1 in case of infinite
    ];

    insert('inventory', [$values], ["id","name","description","discount","price","stock"]);

    answer([]);
?>
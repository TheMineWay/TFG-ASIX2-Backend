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
        "description"=>validateLength($item["description"], ["min"=>2,"max"=>300]),
        "discount"=>validateNumberRange($item["discount"], ["min"=>0,"max"=>100]),
        "price"=>validateNumberRange($item["price"], ["min"=>0]),
        "stock"=>validateNumberRange($item["stock"], ["min"=>0]),
        "imageUrl"=>validateLength($item["imageUrl"], ["min"=>1,"max"=>511]),
        "isDrive"=>validateBoolean($item["isDrive"])
    ];

    update('inventory', "id = $id", $values);

    answer([]);
?>
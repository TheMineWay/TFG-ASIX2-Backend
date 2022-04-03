<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminInventory'
    ], $request);

    $inventory = array_map(function ($inv) {
        return lodash($inv, ["id","name","price","stock","discount","description", "deletedAt", "createdAt", "updatedAt","imageUrl"]);
    }, select('inventory', ["paranoid"=>false])["data"]);

    answer([
        "inventory"=>$inventory
    ]);
?>
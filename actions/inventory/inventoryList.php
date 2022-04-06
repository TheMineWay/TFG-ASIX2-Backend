<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $inventory = array_map(function ($inv) {
        return lodash($inv, ["id","name","price","stock","discount","description","imageUrl"]);
    }, select('inventory')["data"]);

    answer([
        "inventory"=>$inventory
    ]);
?>
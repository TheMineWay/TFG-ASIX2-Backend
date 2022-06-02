<?php
    include('../../global.php');

    $request = request();
    // Authentication is no longer required
    //requireAuth($request);

    $inventory = array_map(function ($inv) {
        return lodash($inv, ["id","name","price","stock","discount","description","imageUrl","isDrive"]);
    }, select('inventory')["data"]);

    answer([
        "inventory"=>$inventory
    ]);
?>
<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $itemId = sanitize($request["data"]["id"]);

    $item = lodash(select("inventory", ["where"=>"id = $itemId"])["data"][0], ["id","name","price","stock","discount","description","imageUrl","isDrive"]);

    answer([
        "item"=>$item
    ]);
?>
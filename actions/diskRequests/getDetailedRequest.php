<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $userId = $request["user"]["id"];

    $purchaseId = $request["data"]["id"];

    $purchase = select("detailedPurchases", ["where"=>"user = '$userId'"])["data"][0];
    $purchaseId = $purchase["id"];
    $states = select("purchaseState", ["where"=>"purchase = '$purchaseId'"])["data"];

    answer([
        "purchase"=>lodash($purchase, ["id", "user", "createdAt", "address", "state", "amount"]),
        "states"=>array_map(function ($row) {
            return lodash($row, ["id", "createdAt", "comment", "state"]);
        }, $states), // Object
        "payment"=>[], // Object
        "builds"=>[], // Array
    ]);
?>
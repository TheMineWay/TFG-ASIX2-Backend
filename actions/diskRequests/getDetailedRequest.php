<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $userId = $request["user"]["id"];

    $purchaseId = $request["data"]["id"];

    $purchase = select("detailedPurchases", ["where"=>"user = '$userId'"])["data"][0];

    answer([
        "purchase"=>lodash($purchase, ["id", "user", "createdAt", "address", "state", "amount"]),
        "states"=>[], // Object
        "payment"=>[], // Object
        "builds"=>[], // Array
    ]);
?>
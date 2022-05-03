<?php
    include('../../../global.php');

    $request = request();
    requireAuth($request);
    requirePermissions([
        'adminDiskRequests'
    ], $request);

    $purchasesList = [];

    // Get purchase
    $purchases = select("detailedPurchases")["data"];
    foreach($purchases as $purchase) {
        $purchaseId = $purchase["id"];

        // Get states
        $states = select("purchaseState", ["where"=>"purchase = '$purchaseId'", "paranoid"=>false])["data"];

        // Get payment
        $paymentId = $purchase["payment"];
        $payment = select("payments", ["where"=>"id = '$paymentId'"])["data"][0];

        // Get builds
        $builds = select("purchaseBuild", [
            "where"=>"purchase = '$purchaseId'",
            "fields"=>["id", "amount", "disk"
        ]])["data"];

        $purchasesList[] = [
            "purchase"=>lodash($purchase, ["id", "user", "createdAt", "address", "state", "amount"]),
            "states"=>array_map(function ($row) {
                return lodash($row, ["id", "createdAt", "comment", "state"]);
            }, $states), // Object
            "payment"=>$payment, // Object
            "builds"=>array_map(function ($row) {
                $buildId = $row["id"];
                return [
                    "build"=>$row,
                    "items"=>array_map(function ($item) {
                        return $item["item"];
                    }, select("purchaseItems", ["where"=>"build = '$buildId'", "fields"=>["item"]])["data"])
                ];
            }, $builds), // Array
        ];
    }

    answer([
        "purchases"=>$purchasesList
    ]);
?>
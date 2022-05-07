<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $userId = $request["user"]["id"];

    $diskRequests = select("detailedPurchases", ["where"=>"user = '$userId'"])["data"];

    answer([
        "requests"=>array_map(function($diskRequest) {
            return lodash($diskRequest, ["id", "user", "createdAt", "address", "state", "amount"]);
        }, $diskRequests)
    ]);
?>
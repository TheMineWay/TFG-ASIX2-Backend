<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $userId = $request["user"]["id"];

    $diskRequest = $request["data"]["request"];

    $payment = $diskRequest["payment"];
    $send = $diskRequest["send"];
    $disks = $diskRequest["disks"];

    $sendTo = $send["address"].", ".$send["city"].", ".$send["postalCode"];

    // ITEMS
    $itemsIdList = [];
    foreach($disks as $disk) {
        $itemsIdList[] = sanitize($disk["disk"]); // Disk ID
        foreach($disk["items"] as $item) {
            $itemsIdList[] = sanitize($item);
        }
    }

    // PAYMENT
    $totalAmount = queryOne("SELECT SUM(i.price-((i.discount*i.price)/100)) as 'total' FROM activeInventory i WHERE i.id IN (".implode(",", $itemsIdList).");")["total"];
    $creditCard = $payment["card"];

    $paymentId = uuid("payments");

    insert("payments", [[$paymentId, $totalAmount, substr($creditCard, 0, 4), doHash($creditCard)]], ["id", "amount", "card", "cardHash"]);

    // CREATE PURCHASE

    $purchaseId = uuid("purchases");
    insert("purchases", [[$purchaseId, $userId, $paymentId, $sendTo]], ["id", "user", "payment", "address"]);

    // ADD BUILDS
    foreach($disks as $build) {
        $purchaseBuildId = uuid("purchaseBuild");
        insert("purchaseBuild", [[$purchaseBuildId, $purchaseId, $build["amount"], json_encode($build), $build["disk"]]], ["id", "purchase", "amount", "purchaseObject", "disk"]);
        foreach($build["items"] as $item) {
            insert("purchaseItems", [[uuid("purchaseItems"), $purchaseBuildId, $item]], ["id", "build", "item"]);
        }
    }


    // SET STATE
    insert("purchaseState", [[uuid("purchaseState"), $purchaseId, "pending"]], ["id","purchase","state"]);

    answer([]);
?>
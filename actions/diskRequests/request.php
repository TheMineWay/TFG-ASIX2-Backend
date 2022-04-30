<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

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
    $totalAmount = query("SELECT SUM(i.price-((i.discount*i.price)/100)) as 'total' FROM inventory i WHERE i.id IN (".implode(",", $itemsIdList).");")[0]["total"];
    $creditCard = $payment["card"];

    $paymentId = uuid("payments");

    insert("payments", [[$paymentId, $totalAmount, substr($creditCard, 0, 4), doHash($creditCard)]], ["id", "amount", "card", "cardHash"]);

    answer([]);
?>
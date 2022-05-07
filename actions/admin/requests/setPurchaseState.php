<?php
    include('../../../global.php');

    $request = request();
    requireAuth($request);
    requirePermissions([
        'adminDiskRequests'
    ], $request);

    // Sanitized data
    $id = sanitize($request["data"]["id"]);
    $state = sanitize($request["data"]["state"]);

    // Non sanitized data, the function auto sanitizes all values
    delete("purchaseState", "purchase = $id AND deletedAt IS NULL");
    insert("purchaseState", [[uuid("purchaseState"), $request["data"]["id"], $request["data"]["state"]]], ["id", "purchase", "state"]);

    answer([]);
?>
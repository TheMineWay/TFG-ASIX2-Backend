<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminPayments'
    ], $request);

    $payments = array_map(function ($inv) {
        return lodash($inv, ["id","amount","deletedAt", "createdAt", "updatedAt", "user", "card"]);
    }, select('paymentsWithUser', ["paranoid"=>false])["data"]);

    answer([
        "payments"=>$payments
    ]);
?>
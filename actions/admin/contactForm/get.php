<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminContactForm'
    ], $request);

    answer([
        "contactForm"=>select("contactForm", [
            "paranoid"=>false
        ])["data"]
    ]);
?>
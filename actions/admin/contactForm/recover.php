<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminContactForm'
    ], $request);

    $id = sanitize($request["data"]["id"]);

    recover('contactForm', "id = $id");

    answer([]);
?>
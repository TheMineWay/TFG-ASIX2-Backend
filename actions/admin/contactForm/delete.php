<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminContactForm'
    ], $request);

    $id = sanitize($request["data"]["id"]);

    delete('contactForm', "id = $id");

    answer([]);
?>
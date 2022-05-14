<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminContactForm'
    ], $request);

    $data = $request["data"];

    $formId = sanitize($data["id"]);
    $state = ($data["state"] ?? "1") == "1" ? "1" : "0";

    update('contactForm', "id = $formId", ["opened"=>[$state]]);

    answer([]);
?>
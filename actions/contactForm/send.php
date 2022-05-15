<?php
    include('../../global.php');

    $request = request();

    $data = $request["data"];

    insert("contactForm", [[
        uuid("contactForm"),
        isEmail($data["email"]),
        validateLength($data["name"], ["min"=>2,"max"=>64]),
        validateLength($data["message"], ["min"=>5,"max"=>500]),
        $request["ip"],
    ]], ["id", "email", "name", "message", "ip"]);

    answer([]);
?>
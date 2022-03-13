<?php
    include('../../global.php');

    $request = request();

    $data = $request["data"];

    // Insert the new user
    insert('users', [[
        uuid('users'),
        $data["name"],
        $data["lastName"],
        $data["email"],
        $data["phone"],
        doHash($data["password"]),
        $data["login"]
    ]], ["id","name","lastName","email","phone","password","login"]);

    // Authenticate
    include('login.php');
?>
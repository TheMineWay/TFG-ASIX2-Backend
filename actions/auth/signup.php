<?php
    include('../../global.php');

    $request = request();

    $data = $request["data"];

    // Lowerize
    $data["login"] = strtolower($data["login"]);
    $data["email"] = strtolower($data["email"]);

    // Check if there is repeated data
    if(existsOnBBDD("users", "login", $data["login"])) {
        throwHttpError("login-in-use", "auth");
    }

    if(existsOnBBDD("users", "email", $data["email"])) {
        throwHttpError("email-in-use", "auth");
    }

    // Insert the new user
    $userId = uuid('users');

    insert('users', [[
        $userId,
        validateLength($data["name"], ["min"=>1,"max"=>32]),
        validateLength($data["lastName"], ["min"=>1,"max"=>32]),
        isEmail($data["email"]),
        isPhone($data["phone"]),
        hashWithSalt(validatePassword($data["password"])),
        validateLength($data["login"], ["min"=>6,"max"=>32]),
        validateDate($data["birthdate"])
    ]], ["id","name","lastName","email","phone","password","login","birthdate"]);

    doLog('register', $userId, $request);

    // Authenticate
    include('login.php');
?>
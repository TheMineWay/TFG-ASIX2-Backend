<?php
    
    include('../../../global.php');
    
    $request = request();
    $data = $request["data"];
    
    requirePermissions(['adminUsers'], $request);
    
    $uid = sanitize($data["userId"]);
    $values = [
        "name"=>validateLength($data["values"]["name"], ["min"=>1,"max"=>32]),
        "lastName"=>validateLength($data["values"]["lastName"], ["min"=>1,"max"=>32]),
        "email"=>isEmail($data["values"]["email"]),
        "phone"=>isPhone($data["values"]["phone"]),
        "login"=>validateLength($data["values"]["login"], ["min"=>6,"max"=>32]),
        "birthdate"=>validateDate($data["values"]["birthdate"])
    ];

    $password = $data["values"]["password"] ?? null;
    
    update("users", "id = $uid", $values);

    if($password != null) {
        update("users", "id = $uid", ["password"=>hashWithSalt(validatePassword($password))]);
    }
    
    answer([]);

?>
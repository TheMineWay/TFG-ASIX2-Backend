<?php
    include('../../global.php');

    $request = request();

    $data = $request["data"];
    $password = hashWithSalt(validatePassword($data["password"]));
    $token = sanitize($data["token"]);
    
    $recoverRow = select('activePasswordRecover', ["where"=>"token = $token"])["data"][0] ?? false;

    if($recoverRow == false) {
        throwHttpError('404','auth');
    }

    $uid = $recoverRow["user"];

    update('users', "id = '$uid'", ["password"=>$password]);
    delete('passwordRecover', "token = $token");

    answer([]);
?>
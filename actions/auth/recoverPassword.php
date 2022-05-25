<?php
    include('../../global.php');

    $request = request();

    $data = $request["data"];
    $email = sanitize($data["email"]);

    $user = select('users', ["where"=>"email=$email"])["data"][0] ?? false;

    if($user == false) {
        throwHttpError('404','auth');
    }

    $uid = $user["id"];
    $last = select('activePasswordRecover', ["where"=>"user='$uid'"])["data"][0] ?? false;

    if($last != false) {
        throwHttpError('429','auth');
    }

    $token = randomText(128);
    insert('passwordRecover', [[uuid('passwordRecover'), $user["id"], $token]], ['id', 'user', 'token']);
    recoverPasswordMail($user["email"], $user["name"], $token);

    answer([]);
?>
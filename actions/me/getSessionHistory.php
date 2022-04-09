<?php
    include('../../global.php');

    $request = request();

    $uid = $request["user"]["id"];

    $sessions = select('sessions', ["where"=>"user = '$uid'"])["data"];

    answer([
        "sessions"=>$sessions
    ]);
?>
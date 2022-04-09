<?php
    include('../../global.php');

    $request = request();

    $uid = $request["user"]["id"];

    $sessions = array_map(function ($session) {
        return lodash($session, ["id","createdAt","ip"]);
    }, select('sessions', ["where"=>"user = '$uid'"])["data"]);

    answer([
        "sessions"=>$sessions
    ]);
?>
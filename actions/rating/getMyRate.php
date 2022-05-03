<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $uid = $request["user"]["id"];

    answer([
        "rate"=>select("opinions", ["where"=>"user = '$uid'"])["data"][0]
    ]);
?>
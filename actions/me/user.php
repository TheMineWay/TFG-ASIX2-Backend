<?php
    include('../../global.php');

    $request = request();

    answer([
        "user"=>$request["user"]
    ]);
?>
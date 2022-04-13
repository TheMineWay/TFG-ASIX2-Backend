<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $diskRequest = $request["data"]["request"];

    answer([]);
?>
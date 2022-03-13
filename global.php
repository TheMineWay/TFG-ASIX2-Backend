<?php
    if($global_loaded ?? false) return;

    include('utils/cors.php');
    include('utils/crypto.php');
    include('utils/error.php');
    include('utils/lodash.php');
    include('utils/requests.php');
    include('utils/uuid.php');

    include('bbdd/bbdd.php');

    $global_loaded = true;
?>
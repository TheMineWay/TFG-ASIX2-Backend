<?php
    if($global_loaded ?? false) return;

    include('utils/cors.php');
    include('utils/random.php');
    include('utils/crypto.php');
    include('utils/error.php');
    include('utils/lodash.php');
    include('utils/requests.php');
    include('utils/uuid.php');
    include('utils/validators.php');

    include('bbdd/bbdd.php');

    include('utils/roles.php');
    include('utils/permissions.php');
    include('utils/log.php');
    include('utils/sendgrid.php');

    $global_loaded = true;
?>
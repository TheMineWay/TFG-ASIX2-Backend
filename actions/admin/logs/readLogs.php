<?php

    include('../../../global.php');

    $request = request();

    requirePermissions([
        'viewLogs'
    ], $request);

    $logs = select('logs');

    answer($logs["data"]);

?>
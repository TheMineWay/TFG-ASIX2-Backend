<?php

    include('../../../global.php');

    // TODO: check viewLogs permission

    $logs = select('logs');

    answer($logs["data"]);

?>
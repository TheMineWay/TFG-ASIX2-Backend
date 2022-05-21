<?php
    // CORS errors
    /*
        This might work in the future but nowadays it is broken
    */

    include('../../global.php');

    $request = request();

    requireAuth($request);

    answer([]);
?>
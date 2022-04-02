<?php
    
    function doLog(string $action, string $uid, $request) {

        insert("logs", [[
            uuid("logs"),
            $uid,
            $action,
            $request["ip"]
        ]], [
            "id",
            "user",
            "action",
            "ip"
        ]);

    }

?>
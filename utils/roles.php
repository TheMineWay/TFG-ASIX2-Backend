<?php

    function userRoles(string $uid) {
        $uid = sanitize($uid);
        $result = query("SELECT * FROM activeUserRoles WHERE user = $uid;") ?? [];

        return array_map(function ($row) {
        return lodash($row, ["name", "role"]);
        }, $result);
    }

    function rolesList() {
        return select("roles")["data"];
    }

?>
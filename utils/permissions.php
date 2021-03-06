<?php

    function userPermissions(string $uid) {
        $uid = sanitize($uid);
        $result = query("SELECT * FROM activeUserPermissions WHERE user = $uid");
        return array_map(function($row) {
        return lodash($row, ["id", "name"]);
        }, $result);
    }

    function permissionsList() {
        return select("permissions")["data"];
    }

    /*SELECT DISTINCT p.id, p.name, r.id AS 'role', ra.`user` AS 'user' FROM activeRoles r, activeRolesAssign ra, activePermissions p, activePermissionsAssign pa
    WHERE p.id = pa.permission AND pa.`role` = r.id AND r.id = ra.`role`;*/

    function requirePermissions(array $permissions, $request) {
        $userPerms = $request["permissionsList"] ?? [];

        foreach($permissions as $perm) {
            // If not include throw error
            if(!in_array($perm, $userPerms)) unauthorizedError();
        }

        return true;
    }

    function isAuthenticated($request) {
        if($request["user"] == false) return false;
        return true;
    }

    function requireAuth($request) {
        if(isAuthenticated($request)) return true;
        unauthorizedError();
    }

?>
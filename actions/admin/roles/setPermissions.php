<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminRoles'
    ], $request);

    $role = $request["data"]["role"];
    $roleId = sanitize($request["data"]["role"]);

    if((select("roles", ["where"=>"id = $roleId"])["data"][0]["superadmin"] == '1') ?? false) {
        unauthorizedError();
    }

    $permissions = array_map(function ($perm) {
        return sanitize($perm);
    }, $request["data"]["permissions"]);

    $currentPerms = array_map(function ($perm) {
        return $perm["permission"];
    }, select("permissionsAssign", ["where"=>"role = $roleId"])["data"]);
    $permissionsToAdd = [];

    foreach($request["data"]["permissions"] as $perm) {
        if(in_array($perm, $currentPerms)) {
            continue;
        }
        $permissionsToAdd[] = $perm;
    }

    if(count($permissionsToAdd) > 0) {
        
        $insertValues = [];
        foreach($permissionsToAdd as $perm) {
            $insertValues[] = [uuid("permissionsAssign"), $role, $perm];
        }
        
        insert('permissionsAssign', $insertValues, ["id","role","permission"]);
    }

    $permissions = implode(",", $permissions);
    delete('permissionsAssign', "`role` = $roleId AND permission NOT IN ($permissions)");

    answer([]);
?>
<?php
    include('../../../global.php');

    $request = request();
    
    requirePermissions([
        'adminUsers'
    ], $request);

    $roles = select("roles", ["fields"=>["id","name","superadmin"]])["data"];

    // View que contè els permisos amb els seus rols
    answer([
        "roles"=>array_map(function ($role) {
            $roleId = $role["id"];
            $permissions = array_map(function($permission) {
                return $permission["permissionId"];
            }, select("filledPermissionsAssign", ["where"=>"roleId = '$roleId'"])["data"]);

            return [
                "id"=>$roleId,
                "name"=>$role["name"],
                "superadmin"=>$role["superadmin"],
                "permissions"=>$permissions
            ];
        }, $roles)
    ]);
?>
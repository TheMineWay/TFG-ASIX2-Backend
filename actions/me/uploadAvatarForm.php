<?php
    include('../../global.php');

    $request = request();

    $get = $_GET;
    $session = $get["session"] ?? 'no';

    $user = fetchAuthUser([
        "auth"=>[
            "session"=>$session
        ]
    ], $request['ip']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <p>Selecciona un avatar</p>
        <div>
            <?php

            ?>
        </div>
        <?php
            echo "<form action='/api/uploads/avatars/uploadAvatar.php?session=$session' method='post' enctype='multipart/form-data'>
            <input type='file' name='avatar'/>
            <input type='submit' value='submit'/>
        </form>";
        ?>
    </body>
</html>
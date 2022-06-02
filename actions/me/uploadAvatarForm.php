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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            .disclaimer {
                display: none;
            }
        </style>
    </head>
    <body>
        <p>Selecciona un avatar</p>
        <?php
            echo "<form action='/api/uploads/avatars/uploadAvatar.php?session=$session' method='post' enctype='multipart/form-data'>
            <input class='form-control' type='file' name='avatar' required/>
            <br/>
            <input class='form-control material-icons' type='submit' value='cloud_upload'/>
        </form>";
        ?>
    </body>
</html>
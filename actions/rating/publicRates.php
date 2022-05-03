<?php
    include('../../global.php');

    $request = request();

    answer([
        "opinions"=>select("opinions", ["fields"=>["rating","opinion","createdAt"]])["data"]
    ]);
?>
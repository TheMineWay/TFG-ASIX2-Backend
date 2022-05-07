<?php
    include('../../global.php');

    $request = request();

    answer([
        "opinions"=>select("publicOpinions", ["fields"=>["rating","opinion","createdAt","isPublic"]])["data"]
    ]);
?>
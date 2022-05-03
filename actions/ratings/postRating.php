<?php
    include('../../global.php');

    $request = request();
    requireAuth($request);

    $uid = $request["user"]["id"];
    
    $opinion = validateLength($request["data"]["opinion"], ["min"=>0,"max"=>500]);
    $rating = validateNumberRange($request["data"]["rating"], ["min"=>1,"max"=>5]);

    $sanRating = sanitize($rating);
    $sanOpinion = sanitize($opinion);

    delete("opinions", "user = '$uid'");
    select("opinions", ["where"=>"rating=$sanRating AND opinion=$sanOpinion"])["data"];
    insert("opinions", [[uuid("opinions"), $uid, $rating, $opinion]], ["id", "user", "rating", "opinion"]);

    answer([]);
?>
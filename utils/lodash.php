<?php
    function lodash(array $arr, array $select) {
        $result = [];

        foreach($arr as $index => $value) {
            if(in_array($index, $select)) {
                $result[$index] = $value;
            }
        }

        return $result;
    }
?>
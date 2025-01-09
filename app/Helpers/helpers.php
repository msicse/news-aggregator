<?php
if (!function_exists('toSqlDate')) {
    function toSqlDate($date) {
        $dateTime = new \DateTime($date);
        return $dateTime->format('Y-m-d H:i:s');;
    }
}

?>
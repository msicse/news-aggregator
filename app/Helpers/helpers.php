<?php
if (!function_exists('toSqlDate')) {
    function toSqlDate($date)
    {
        $dateTime = new \DateTime($date);
        return $dateTime->format('Y-m-d H:i:s');;
    }
}
if (!function_exists('parseArrayInput')) {
    function parseArrayInput($input)
    {
        if (is_array($input)) {
            return $input;
        }

        return array_map('trim', explode(',', $input));
    }
}

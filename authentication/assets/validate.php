<?php
// Clean input data function функция очистки данных от тегов
function clean($array): array
{
    foreach ($array as $key => $value) {
        if ($key != 'password') {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            $array[$key] = $value;
        }
    }
    return $array;
}
// Length checking function
function check_length($value, $min, $max): bool
{
    $length = strlen($value);
    if ($length >= $min AND $length <= $max) {
        $result = TRUE;
    } else $result = FALSE;
    return $result;
}
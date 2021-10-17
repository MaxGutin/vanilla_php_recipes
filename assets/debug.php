<?php
// Debug functions.
function debug1($v)
{
    if ($v) {
        echo "<pre>";
        print_r($v);
        echo '</pre>';
    } else echo '== UNDEFINED ==';
}
function debug2($v)
{
    if ($v) {
        echo "<pre>";
        var_dump($v);
        echo '</pre>';
    } else echo '== UNDEFINED ==';
}
<?php

function parse_number($str)
{
    if (preg_match('#(\d+)\s+(\d+)/(\d+)#', $str, $m)) {
        return $m[1] + $m[2] / $m[3];
    }
    return 0;
}

function round_up($value, $places = 0)
{
    $mult = pow(10, abs($places));
    return $places < 0 ?
        ceil($value / $mult) * $mult :
        ceil($value * $mult) / $mult;
}

function total_area($width = '', $height = '')
{
    $value_width = round_up(parse_number($width));
    $value_height = round_up(parse_number($height));
    $total = $value_width * $value_height / 144;
    if ($total < 1) {
        return 1;
    } else {
        return round_up($total, 1);
    }
}
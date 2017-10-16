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

function calculate_width($width = '',$param1 = '',$param2 = '',$panelparam = '')
{
    $fraction1 = str_to_fraction($width);
    $param1_fraction = str_to_fraction($param1);
    $param2_fraction =str_to_fraction($param2);
    $panelparam_fraction = str_to_fraction($panelparam);
    $tmp_fraction1 = fraction_multiply($param1_fraction,$param2_fraction);
    $tmp_fraction2 = fraction_subtract($fraction1,$tmp_fraction1);
    $final_fraction = fraction_add($tmp_fraction2,$panelparam_fraction);
    return fraction_to_str($final_fraction);
}

function fraction_add($fraction1,$fraction2)
{
    $numerator_tmp = $fraction1[0] * $fraction2[1] + $fraction2[0] * $fraction1[1];
    $denominator_tmp = $fraction1[1] * $fraction2[1];
    brachylogy_fraction($numerator_tmp,$denominator_tmp);
    return array($numerator_tmp,$denominator_tmp);
}

function fraction_subtract($fraction1,$fraction2)
{
    $numerator_tmp = $fraction1[0] * $fraction2[1] - $fraction2[0] * $fraction1[1];
    $denominator_tmp = $fraction1[1] * $fraction2[1];
    brachylogy_fraction($numerator_tmp,$denominator_tmp);
    return array($numerator_tmp,$denominator_tmp);
}

function fraction_multiply($fraction1,$fraction2)
{
    $numerator_tmp = $fraction1[0] * $fraction2[0];
    $denominator_tmp = $fraction1[1] * $fraction2[1];
    brachylogy_fraction($numerator_tmp,$denominator_tmp);
    return array($numerator_tmp,$denominator_tmp);
}

function brachylogy_fraction(&$numerator,&$denominator){
    $numerator_tmp = abs($numerator);
    $denominator_tmp = abs($denominator);
    $a = ($numerator_tmp < $denominator_tmp) ? $numerator_tmp : $denominator_tmp;
    while(1)
    {
        if($numerator_tmp % $a == 0 && $denominator_tmp % $a == 0)
        {
            break;
        }
        $a --;
    }
    $numerator = $numerator / $a;
    $denominator =  $denominator / $a;
}

function fraction_to_str($fraction)
{
    if($fraction[1] == 1)
    {
        return intval($fraction[0] / $fraction[1]);
    }else
    {

        $str1 = intval($fraction[0] / $fraction[1]);
        $str2  = $fraction[0] % $fraction[1];
        if($str1 == 0)
        {
            return $str2.'/'.$fraction[1];
        }else
        {
            return $str1." ".$str2.'/'.$fraction[1];
        }
    }
}

function str_to_fraction($str){
    $numerator = 1;
    $denominator = 1;
    $arraylist = explode(" ",$str);
    if(count($arraylist) >1)
    {
        $tmp_array = explode("/",$arraylist[1]);
        $numerator = intval($tmp_array[1]) * intval($arraylist[0]) + intval($tmp_array[0]);
        $denominator = intval($tmp_array[1]);
    }else{
        $tmp_array1 = explode(".",$str);
        if(count($tmp_array1)>1)
        {
            $numerator = intval($tmp_array1[1]);
            $denominator = pow(10,strlen($tmp_array1[1]));
            brachylogy_fraction($numerator,$denominator);
            $numerator = $numerator + $denominator * intval($tmp_array1[0]);
        }else
        {
            $numerator = intval($tmp_array1[0]);
        }
    }
    return array($numerator,$denominator);
}


function classActivePath($path)
{
    return Request::is($path) ? ' class="active"' : '';
}

function classActiveSegment($segment, $value)
{
    if(!is_array($value)) {
        return Request::segment($segment) == $value ? ' class="active"' : '';
    }
    foreach ($value as $v) {
        if(Request::segment($segment) == $v) return ' class="active"';
    }
    return '';
}
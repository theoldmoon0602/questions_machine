<?php
/**
 * Created by PhpStorm.
 * User: TOMORI
 * Date: 2016/06/04
 * Time: 21:54
 */

function load_problems($f)
{
    $xs = json_decode(file_get_contents($f), true);
    return $xs;
}

function validate($s)
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function save_problems($f, $xs)
{
    $json = json_encode($xs, true);
    return file_put_contents($f, $json);
}

function enabled_problems($xs)
{
    $xs = array_filter($xs, function($v) {
        return !(isset($v["disabled"]) && $v["disabled"] === 1);
    });
    return array_values($xs);
}

function is_problem_disabled($p) 
{
    return (isset($p["disabled"]) && $p["disabled"] === 1);
}
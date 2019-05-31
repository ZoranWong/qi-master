<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/5/31
 * Time: 11:19 AM
 */
if (!function_exists('underScoreCaseToCamelCase')) {
    function underScoreCaseToCamelCase(string $key)
    {
        return preg_replace_callback('/(_([a-zA-Z]))/', function ($matches) {
            return strtoupper($matches[2]);
        }, $key);
    }
}

if (!function_exists('camelCaseToUnderScoreCase')) {
    function camelCaseToUnderScoreCase(string $key)
    {
        return preg_replace_callback('/([A-Z])/', function ($matches) {
            return '_'.strtolower($matches[0]);
        }, $key);
    }
}

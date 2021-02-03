<?php


if (!function_exists('base64UrlEncode')) {
    function base64UrlEncode($data)
    {
        //return strtr(base64_encode($data), '+/=', '-_,');
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($data)
        );
    }
}


if (!function_exists('base64UrlDecode')) {
    function base64UrlDecode($data)
    {
        return base64_decode(str_replace(
            ['-', '_'],
            ['+', '/'],
            $data
        ));
        //return base64_decode(strtr($data, '-_,', '+/='));
    }
}

if (!function_exists('date_custom_format')) {
    function date_custom_format($date)
    {
        return Carbon\Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }
}


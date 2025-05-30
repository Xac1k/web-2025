<?php
function getOrDefault(&$value, $default): mixed
{
    return isset($value) ? $value : $default;
}

function isImageFormatSupported(?string &$url): bool
{
    if (!isset($url)) return false;
    return preg_match('/^\w+.png$/u', $url);
}
<?php

function make_excerpt($text, $length = 200)
{
    $value = trim(preg_replace('/\n\r|\n|\r+/', '', strip_tags($text)));
    return \Str::limit($value, $length);
}

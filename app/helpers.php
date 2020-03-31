<?php

function make_excerpt($text, $length=200)
{
    $text = trim(preg_replace('/\n\r|\n|\r+/', '' ,strap_tags($text)));
    return \Str::limit($text, $length);
}

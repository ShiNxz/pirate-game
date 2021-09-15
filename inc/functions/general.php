<?php

function Redirect($url = URL){
    header('Location: '.$url);
    exit;
}

function generateRandom($min = 1, $max = 20) {
    if (function_exists('random_int')):
        return random_int($min, $max); // more secure
    elseif (function_exists('mt_rand')):
        return mt_rand($min, $max); // faster
    endif;
    return rand($min, $max); // old
}
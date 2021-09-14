<?php

function Redirect($url = URL){
    header('Location: '.$url);
    exit;
}
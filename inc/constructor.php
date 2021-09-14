<?php
session_start();

// Load Functions
foreach(glob($_SERVER['DOCUMENT_ROOT'].'/includes/php/functions/*.php') as $file){
    require $file;
}

// Load Database Config
require $_SERVER['DOCUMENT_ROOT'].'/includes/database.php';


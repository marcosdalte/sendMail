<?php

$extension_static = ['png','jpg','jpeg','gif','css','js','otf','eot','woff2','woff','ttf','svg','html'];

$parse_url_path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$extension = pathinfo($parse_url_path,PATHINFO_EXTENSION);

if (in_array($extension,$extension_static)) {
    return false;
}

require ("src/bootstrap.php");

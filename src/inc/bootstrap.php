<?php
error_reporting(E_ALL);
setlocale(LC_ALL, 'nl_NL');

require_once 'cls/config.php';
require_once 'cls/location.php';
require_once 'cls/productCategory.php';
require_once 'cls/productExtra.php';
require_once 'cls/product.php';

$config = new Config(json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'config.json'), true));
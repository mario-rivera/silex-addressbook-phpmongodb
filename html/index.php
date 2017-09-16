<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new App\AddressBook();
$app->load()->run();

<?php

use Steampixel\Route;
use Machinacyfrowa\CornyApi\Joke;

require_once('vendor/autoload.php'); 

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

Route::add('/random', function() {
    header('Content-Type: application/json');
    return json_encode(['joke' => Joke::getRandom()]);
});

$db->close();

Route::run($_ENV['REWRITE_BASE']);
?>
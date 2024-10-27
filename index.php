<?php
//Requite composer autoloader to load all classes from our namespace and imported packages
require_once('vendor/autoload.php'); 
//Import namespaces to use classes from them
use Steampixel\Route;
use Machinacyfrowa\CornyApi\Joke;

//Read .env file and load variables
//we use whole namespace since we did not import Dotenv class earlier
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create a database connection - use credentials from .env file
$db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
//add a simple example route - fetch a ranom joke from database and return it as json
Route::add('/random', function() use($db){
    header('Content-Type: application/json');
    return json_encode(['joke' => Joke::getRandom($db)]);
});
//add a second route - fetch the latest joke from database and return it as json
Route::add('/latest', function() use($db){
    header('Content-Type: application/json');
    return json_encode(['joke' => Joke::getLatest($db)]);
});

//Start up the router
Route::run($_ENV['REWRITE_BASE']);

//close the database connection
$db->close();
?>
<?php
//Autoloader od composera - odpowiada za automatyczne ładowanie klas zainstalowanych przez composera oraz naszych klas z katalogu src
require_once('vendor/autoload.php'); 
//Importujemy klasy z naszego namespace i namespace Steampixel
use Steampixel\Route;
use Machinacyfrowa\CornyApi\Joke;

//Wczytujemy zmienne z pliku .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Tworzymy połączenie z bazą danych - używamy zmienne z pliku .env
$db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
//dodajemy najprostszą ścieżkę - pobieranie losowego żartu z bazy danych i zwracanie go w formacie JSON
Route::add('/random', function() use($db){
    header('Content-Type: application/json');
    return json_encode(['joke' => Joke::getRandom()]);
});
//Zamykamy połączenie z bazą danych
$db->close();
//Uruchamiamy router
Route::run($_ENV['REWRITE_BASE']);
?>
<?php
namespace Machinacyfrowa\CornyApi;

use \mysqli;

/**
 * Class Joke
 * @package Machinacyfrowa\CornyApi
 * This class is responsible for fetching jokes from database and contains all the logic related
 * to joke table in database
 */

class Joke
{
    public static function getRandom(mysqli $db) : string
    {
        //order all by random and pull the first one
        $sql = "SELECT joke FROM joke ORDER BY RAND() LIMIT 1";
        //query database
        $result = $db->query($sql);
        //fetch result - no need for while loop as we are fetching only one row
        $row = $result->fetch_assoc();
        //return joke
        return $row['joke'];
    }
    public static function getLatest(mysqli $db) : string
    {
        //order all by id and pull the first one
        $sql = "SELECT joke FROM joke ORDER BY id DESC LIMIT 1";
        //query database
        $result = $db->query($sql);
        //fetch result - no need for while loop as we are fetching only one row
        $row = $result->fetch_assoc();
        //return joke
        return $row['joke'];
    }
}

?>
<?php

// Jiazheng Huang
class DatabaseAdaptor
{

    private $DB;

    // The instance variable used in every method

    // Connect to an existing data based named 'first'
    public function __construct()
    {
        $dataBase = 'mysql:dbname=imdb_small;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }

    public function getAllMovies($movie)
    {
        $stmt = $this->DB->prepare("SELECT movies.name FROM movies WHERE movies.name LIKE '%" . $movie . "%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRoles($role)
    {
        $stmt = $this->DB->prepare("SELECT roles.role FROM roles WHERE roles.role LIKE '%". $role ."%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllActors($actor)
    {
        $stmt = $this->DB->prepare("SELECT actors.first_name, actors.last_name" 
            . " FROM actors" 
            . " WHERE actors.first_name LIKE '%" . $actor . "%'"
            . " or actors.last_name LIKE '%" . $actor . "%';");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $theDBA = new DatabaseAdaptor();
// $arr = $theDBA->getAllMovies('A'); // name
// $arr = $theDBA->getAllRoles('Blut'); // role
// $arr = $theDBA->getAllActors('will'); // first_name, lat_name
// print_r($arr);
?>
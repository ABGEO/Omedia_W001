<?php
//Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('functions/movies.php');

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
    //Delete movie

    if (isset($_SERVER['PATH_INFO'])) {
        $movieTitle = substr($_SERVER['PATH_INFO'], 8);

        echo RemoveMovie($movieTitle);
    }
} else {
    //Show movies
    if (isset($_SERVER['PATH_INFO'])) {
        if ($_SERVER['PATH_INFO'] == '/movies') {
            //Get all movies

            //header('Content-type: application/json, text/yaml');
            header('Content-type: application/json');

            echo GetMovie();
        } else if (strpos($_SERVER['PATH_INFO'], '/movies/') !== false) {
            //Get single movie
            $movieTitle = substr($_SERVER['PATH_INFO'], 8);
            $response = GetMovie($movieTitle);

            if ($response == '404')
                echo "Error 404: Movie Not Found!";
            else {
                header('Content-type: application/json');
                echo $response;
            }
        }
    }
}

//Add new movie
if (isset($_POST['movies'])) {
    if (isset($_POST['title']) && isset($_POST['genre']) &&
        isset($_POST['release_date']) && isset($_POST['imdb_rating'])) {
        $data = array(
            "title" => $_POST['title'],
            "genre" => $_POST['genre'],
            "release_date" => $_POST['release_date'],
            "imdb_rating" => $_POST['imdb_rating']
        );

        echo AddMovie($data);
    } else
        echo "Invalid data!";
}
<?php
//Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('functions/movies.php');
require_once('functions/requests.php');

$request = Request();

if ($request['action'] == 'get_movies') {
    //Get all movies

    //header('Content-type: application/json, text/yaml');
    header('Content-type: application/json');

    echo GetMovie();
} else if ($request['action'] == 'get_movie') {
    //Get single movie
    $movieTitle = $request['movie_title'];
    $response = GetMovie($movieTitle);

    if ($response == '404')
        echo "Error 404: Movie Not Found!";
    else {
        header('Content-type: application/json');
        echo $response;
    }
} else if ($request['action'] == 'delete') {
    //Delete movie
    $movieTitle = $request['movie_title'];

    echo RemoveMovie($movieTitle);
} else if ($request['action'] == 'add_movie') {
    //Add new movie
    if ($request['movie_info_validation'])
        echo AddMovie($request['movie_info']);
    else
        echo "Invalid data!";
}
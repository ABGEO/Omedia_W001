<?php
require_once('database.php');

$movies = GetFromDB();

function GetMovie($action = 'all')
{
    GLOBAL $movies;

    if ($action == 'all') {
        return $movies;
    } else {
        $movie = json_decode($movies, 1);

        if (isset($movie[$action]))
            return json_encode($movie[$action]);
        return "404";
    }
}

function AddMovie($data)
{
    GLOBAL $movies;

    $movies = json_decode($movies, 1);

    if (isset($movies[$data['title']])) {
        return "Movie \"{$data['title']}\" already exists!";
    } else {
        $movies[$data['title']] = [
            "genre" => $data['genre'],
            "release_date" => $data['release_date'],
            "imdb_rating" => $data['imdb_rating']
        ];

        $movies = json_encode($movies);
        UpdateDB($movies);

        return "Movie has been added successfully";
    }
}

function RemoveMovie($title)
{
    GLOBAL $movies;

    $movie = json_decode($movies, 1);

    if (isset($movie[$title])) {
        unset($movie[$title]);

        $movie = json_encode($movie);
        UpdateDB($movie);

        return "Movie has been deleted successfully";
    } else
        return "Error 404: Movie not found!";
}
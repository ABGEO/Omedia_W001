<?php

function Request()
{
    $response = array(
        'action' => null
    );

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
        if (isset($_SERVER['PATH_INFO'])) {
            $movieTitle = substr($_SERVER['PATH_INFO'], 8);

            $response['action'] = 'delete';
            $response['movie_title'] = $movieTitle;
        }
    } else {
        if (isset($_SERVER['PATH_INFO'])) {
            if ($_SERVER['PATH_INFO'] == '/movies') {
                $response['action'] = 'get_movies';
            } else if (strpos($_SERVER['PATH_INFO'], '/movies/') !== false) {
                $movieTitle = substr($_SERVER['PATH_INFO'], 8);

                $response['action'] = 'get_movie';
                $response['movie_title'] = $movieTitle;
            }
        }
    }

    if (isset($_POST['movies'])) {
        if (isset($_POST['title']) && isset($_POST['genre']) && isset($_POST['release_date']) && isset($_POST['imdb_rating'])) {
            $data = array(
                "title" => $_POST['title'],
                "genre" => $_POST['genre'],
                "release_date" => $_POST['release_date'],
                "imdb_rating" => $_POST['imdb_rating']
            );

            $response['action'] = 'add_movie';
            $response['movie_info_validation'] = true;
            $response['movie_info'] = $data;
        } else {
            $response['action'] = 'add_movie';
            $response['movie_info_validation'] = false;
        }
    }

    return $response;
}
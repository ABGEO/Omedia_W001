<?php
$JSONFile = 'databases/movies.json';

function GetFromDB()
{
    GLOBAL $JSONFile;
    return file_get_contents($JSONFile);
}

function UpdateDB($data)
{
    GLOBAL $JSONFile;

    $fileStream = fopen($JSONFile, 'w+');
    fwrite($fileStream, $data);
    fclose($fileStream);
}
<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'movies');

try {

    global $db;
    $db_options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    );

    $db = new PDO('mysql:host='.HOST.';dbname='.DB.'', USER, PASS, $db_options);

} catch (Exception $e) {
    exit('MySQL Connect Error >> '.$e->getMessage());
}

function query($query) {

    try {

        global $db;

        switch (strtok($query, ' ')) {
            case 'SELECT':
                return $db->query($query, PDO::FETCH_ASSOC)->fetchAll();
            break;
            case 'INSERT':
                $db->exec($query);
                return intval($db->lastInsertId());
            break;
            case 'UPDATE':
            case 'DELETE':
                $result = $db->query($query);
                return $result->rowCount();
            break;
        }

        throw new Exception('Invalid query : '.$query);

        //$query = $db->prepare('SELECT * FROM movies WHERE id = :id');
        //$query->bindValue('id', $id, PDO::PARAM_INT);
        //$query->execute();
        //$result = $query->fetchAll();

    } catch (Exception $e) {
        exit('MySQL Query Error >> '.$e->getMessage());
    }
}

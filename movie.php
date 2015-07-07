<?php
include_once 'header.php';

if (!isset($_GET['id'])) {
	exit('Undefined param id');
}

$id = intval($_GET['id']);

$movie = Movie::get($id);

include_once 'movie-common.php';
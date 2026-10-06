<?php
require_once 'db.php';
require_once 'movie_functions.php';

header('Content-Type: application/json');

$query = $_GET['q'] ?? '';
$movies = searchMovies($pdo, $query);

echo json_encode($movies);
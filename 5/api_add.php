<?php
require_once 'db.php';
require_once 'movie_functions.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$title = trim($data['title'] ?? '');
$director = trim($data['director'] ?? '');
$year = $data['year'] ?? '';
$genre = trim($data['genre'] ?? '');
$rating = $data['rating'] ?? '';

$errors = [];
if ($title === '') $errors[] = 'Назва обов\'язкова';
if ($director === '') $errors[] = 'Режисер обов\'язковий';
if (!is_numeric($year)) $errors[] = 'Рік має бути числом';
if ($genre === '') $errors[] = 'Жанр обов\'язковий';
if (!is_numeric($rating) || $rating < 0 || $rating > 10) $errors[] = 'Рейтинг має бути від 0 до 10';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
    exit;
}

$newId = addMovie($pdo, $title, $director, (int)$year, $genre, (float)$rating);

http_response_code(201);
echo json_encode([
    'id' => $newId,
    'title' => $title,
    'director' => $director,
    'year' => $year,
    'genre' => $genre,
    'rating' => $rating,
]);
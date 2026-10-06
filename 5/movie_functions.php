<?php

function searchMovies(PDO $pdo, string $query): array {
    $stmt = $pdo->prepare('SELECT * FROM movies WHERE title LIKE :query ORDER BY id DESC');
    $stmt->execute([':query' => '%' . $query . '%']);
    return $stmt->fetchAll();
}

function addMovie(PDO $pdo, string $title, string $director, int $year, string $genre, float $rating): int {
    $stmt = $pdo->prepare('INSERT INTO movies (title, director, year, genre, rating) VALUES (:title, :director, :year, :genre, :rating)');
    $stmt->execute([
        ':title' => $title,
        ':director' => $director,
        ':year' => $year,
        ':genre' => $genre,
        ':rating' => $rating,
    ]);
    return (int) $pdo->lastInsertId();
}
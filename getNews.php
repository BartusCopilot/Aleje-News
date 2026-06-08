<?php
header('Content-Type: application/json; charset=utf-8');

$conn = mysqli_connect('localhost', 'root', '', 'alejenews');

if (!$conn) {
    echo json_encode(['error' => 'Brak polaczenia z baza']);
    exit;
}

$after = isset($_GET['after']) ? (int)$_GET['after'] : 0;

$sql = "SELECT id, zdjecie, tytul, opis, czas_trwania
        FROM news
        WHERE id > $after
        ORDER BY id ASC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(['error' => 'Blad zapytania']);
    exit;
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    $fallback = mysqli_query($conn, "SELECT id, zdjecie, tytul, opis, czas_trwania FROM news ORDER BY id ASC LIMIT 1");
    $row = mysqli_fetch_assoc($fallback);
}

if (!$row) {
    echo json_encode(null);
    exit;
}

echo json_encode([
    'id' => (int)$row['id'],
    'image' => $row['zdjecie'],
    'title' => $row['tytul'],
    'subtitle' => $row['opis'],
    'time' => $row['czas_trwania'],
]);

?>
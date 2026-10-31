<?php
header('Content-Type: application/json; charset=utf-8');

$connection = mysqli_connect('localhost', 'root', '', 'alejenews');

if (!$connection) {
    echo json_encode(['error' => 'Brak polaczenia z baza']);
    exit;
}

$after = isset($_GET['after']) ? (int)$_GET['after'] : 0;

$sql = "SELECT id, plik, tytul, opis, czas_trwania, rodzaj
        FROM news
        WHERE id > $after
        ORDER BY id ASC
        LIMIT 1";

$result = mysqli_query($connection, $sql);

if (!$result) {
    echo json_encode(['error' => 'Blad zapytania']);
    exit;
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    $fallback = mysqli_query($connection, "SELECT id, plik, tytul, opis, czas_trwania , rodzaj
        FROM news ORDER BY id ASC LIMIT 1");
    $row = mysqli_fetch_assoc($fallback);
}

if (!$row) {
    echo json_encode([
        'id' => 0,
        'file' => 'visuals/aleje.jpg',
        'title' => 'Brak newsów',
        'subtitle' => '',
        'time' => 10,
        'type' => 'image'
    ]);
    exit;
}

if ($row['rodzaj'] === "pytanie_testowe") {
    $fallback = mysqli_query($connection, "SELECT id, tresc_pytania, odp_a, odp_b, odp_c, odp_d, poprawna_odp
        FROM pytania_testowe WHERE news_id = " . $row['id'] . " ORDER BY id ASC LIMIT 1 ");
    $questionRow = mysqli_fetch_assoc($fallback);
    echo json_encode([
        'id' => (int)$row['id'],
        'file' => $row['plik'],
        'title' => $row['tytul'],
        'subtitle' => $row['opis'],
        'time' => $row['czas_trwania'],
        'type' => $row['rodzaj'],
        'question' => $questionRow['tresc_pytania'],
        'options' => [
            'A' => $questionRow['odp_a'],
            'B' => $questionRow['odp_b'],
            'C' => $questionRow['odp_c'],
            'D' => $questionRow['odp_d']
        ],
        'correctAnswer' => $questionRow['poprawna_odp'],
    ]);
} else {
    echo json_encode([
        'id' => (int)$row['id'],
        'file' => $row['plik'],
        'title' => $row['tytul'],
        'subtitle' => $row['opis'],
        'time' => $row['czas_trwania'],
        'type' => $row['rodzaj']
    ]);
}
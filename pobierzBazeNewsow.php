<?php
header('Content-Type: application/json; charset=utf-8');

$polaczenie = mysqli_connect('localhost', 'root', '', 'alejenews');
if (!$polaczenie) {
    http_response_code(500);
    echo json_encode(['sukces' => false, 'komunikat' => 'Brak połączenia z bazą danych.']);
    exit;
}

mysqli_set_charset($polaczenie, 'utf8mb4');
$zapytanie = mysqli_query(
    $polaczenie,
    "SELECT
        news.id,
        news.rodzaj,
        news.plik,
        news.tytul,
        news.opis,
        news.czas_trwania,
        pytania_testowe.tresc_pytania,
        pytania_testowe.odp_a,
        pytania_testowe.odp_b,
        pytania_testowe.odp_c,
        pytania_testowe.odp_d,
        pytania_testowe.poprawna_odp
     FROM news
     LEFT JOIN pytania_testowe ON pytania_testowe.news_id = news.id
     ORDER BY news.id ASC"
);

if (!$zapytanie) {
    http_response_code(500);
    echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się pobrać newsów.']);
    exit;
}

$newsy = [];
while ($wiersz = mysqli_fetch_assoc($zapytanie)) {
    $newsy[] = [
        'id' => (int) $wiersz['id'],
        'rodzaj' => $wiersz['rodzaj'],
        'plik' => $wiersz['plik'],
        'tytul' => $wiersz['tytul'],
        'opis' => $wiersz['opis'],
        'czas' => (int) $wiersz['czas_trwania'],
        'tresc' => $wiersz['rodzaj'] === 'pytanie_testowe'
            ? $wiersz['tresc_pytania']
            : $wiersz['tytul'],
        'pytanie' => $wiersz['tresc_pytania'],
        'odpowiedzi' => [
            'A' => $wiersz['odp_a'],
            'B' => $wiersz['odp_b'],
            'C' => $wiersz['odp_c'],
            'D' => $wiersz['odp_d']
        ],
        'poprawnaOdpowiedz' => $wiersz['poprawna_odp']
    ];
}

echo json_encode(['sukces' => true, 'newsy' => $newsy]);

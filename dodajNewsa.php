<?php
ini_set('display_errors', '0');
header('Content-Type: application/json');

$conn = mysqli_connect("localhost", "root", "", "alejenews");
if (!$conn) {
    http_response_code(500);
    echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się połączyć z bazą danych.']);
    exit;
}

if (empty($_POST) && empty($_FILES) && !empty($_SERVER['CONTENT_LENGTH'])) {
    http_response_code(413);
    echo json_encode([
        'sukces' => false,
        'komunikat' => 'Plik jest za duży. Zwiększ upload_max_filesize i post_max_size w php.ini.'
    ]);
    exit;
}

$rodzaj = $_POST['rodzaj'] ?? '';
$czasTrwania = filter_input(INPUT_POST, 'czasTrwania', FILTER_VALIDATE_INT);
$dozwoloneRodzaje = ['zdjecie', 'wideo', 'pytanie_testowe'];

if (!in_array($rodzaj, $dozwoloneRodzaje, true) || $czasTrwania === false || $czasTrwania <= 0) {
    http_response_code(400);
    echo json_encode(['sukces' => false, 'komunikat' => 'Nieprawidłowe dane newsa.']);
    exit;
}

$plik = '';
$tytul = '';
$opis = '';
$przeniesionyPlik = null;
$danePytania = null;

if ($rodzaj === 'zdjecie' || $rodzaj === 'wideo') {
    $tytul = trim($_POST['tytul'] ?? '');
    $opis = trim($_POST['opis'] ?? '');
    $przeslanyPlik = $_FILES['plik'] ?? null;

    if ($tytul === '' || $opis === '' || !$przeslanyPlik || $przeslanyPlik['error'] !== UPLOAD_ERR_OK) {
        $kodBledu = $przeslanyPlik['error'] ?? UPLOAD_ERR_NO_FILE;
        $komunikat = $kodBledu === UPLOAD_ERR_INI_SIZE || $kodBledu === UPLOAD_ERR_FORM_SIZE
            ? 'Plik jest za duży. Zwiększ upload_max_filesize i post_max_size w php.ini.'
            : 'Tytuł, opis i poprawny plik są wymagane.';
        http_response_code(400);
        echo json_encode(['sukces' => false, 'komunikat' => $komunikat]);
        exit;
    }

    $rozszerzenie = strtolower(pathinfo($przeslanyPlik['name'], PATHINFO_EXTENSION));
    $dozwoloneRozszerzenia = $rodzaj === 'zdjecie'
        ? ['jpg', 'jpeg', 'png', 'gif', 'webp']
        : ['mp4', 'webm', 'ogg', 'mov'];

    if (!in_array($rozszerzenie, $dozwoloneRozszerzenia, true)) {
        http_response_code(400);
        echo json_encode(['sukces' => false, 'komunikat' => 'Niedozwolony typ pliku.']);
        exit;
    }

    $nazwaPliku = basename($przeslanyPlik['name']);
    $nazwaPliku = preg_replace('/[^A-Za-z0-9._-]/', '_', $nazwaPliku);
    $nazwaPliku = trim($nazwaPliku, '._-');
    if ($nazwaPliku === '') {
        http_response_code(400);
        echo json_encode(['sukces' => false, 'komunikat' => 'Nieprawidłowa nazwa pliku.']);
        exit;
    }

    $katalogVisuals = __DIR__ . DIRECTORY_SEPARATOR . 'visuals';
    if (!is_dir($katalogVisuals) && !mkdir($katalogVisuals, 0755, true)) {
        http_response_code(500);
        echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się utworzyć folderu visuals.']);
        exit;
    }

    $sciezkaPliku = $katalogVisuals . DIRECTORY_SEPARATOR . $nazwaPliku;
    if (file_exists($sciezkaPliku)) {
        $nazwaPliku = pathinfo($nazwaPliku, PATHINFO_FILENAME) . '_' . time() . '.' . $rozszerzenie;
        $sciezkaPliku = $katalogVisuals . DIRECTORY_SEPARATOR . $nazwaPliku;
    }

    if (!move_uploaded_file($przeslanyPlik['tmp_name'], $sciezkaPliku)) {
        http_response_code(500);
        echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się zapisać pliku w folderze visuals.']);
        exit;
    }
    $plik = $nazwaPliku;
    $przeniesionyPlik = $sciezkaPliku;
} else {
    $danePytania = [
        trim($_POST['trescPytania'] ?? ''),
        trim($_POST['odpA'] ?? ''),
        trim($_POST['odpB'] ?? ''),
        trim($_POST['odpC'] ?? ''),
        trim($_POST['odpD'] ?? ''),
        trim($_POST['poprawnaOdp'] ?? '')
    ];
    if (in_array('', $danePytania, true)) {
        http_response_code(400);
        echo json_encode(['sukces' => false, 'komunikat' => 'Dane pytania są niepełne.']);
        exit;
    }
}

$polaczenie = $conn;
$polaczenie->set_charset('utf8mb4');
$zapytanieNews = $polaczenie->prepare(
    'INSERT INTO news (plik, tytul, opis, czas_trwania, rodzaj) VALUES (?, ?, ?, ?, ?)'
);
$zapytanieNews->bind_param('sssis', $plik, $tytul, $opis, $czasTrwania, $rodzaj);

if (!$zapytanieNews->execute()) {
    if ($przeniesionyPlik && file_exists($przeniesionyPlik)) {
        unlink($przeniesionyPlik);
    }
    http_response_code(500);
    echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się zapisać newsa.']);
    exit;
}

if ($rodzaj === 'pytanie_testowe') {
    $newsId = $polaczenie->insert_id;
    [$trescPytania, $odpA, $odpB, $odpC, $odpD, $poprawnaOdp] = $danePytania;
    $mapaPoprawnychOdpowiedzi = ['odpA' => 'A', 'odpB' => 'B', 'odpC' => 'C', 'odpD' => 'D'];
    $poprawnaOdp = $mapaPoprawnychOdpowiedzi[$poprawnaOdp] ?? '';
    if ($poprawnaOdp === '') {
        mysqli_query($polaczenie, 'DELETE FROM news WHERE id = ' . (int) $newsId);
        http_response_code(400);
        echo json_encode(['sukces' => false, 'komunikat' => 'Nieprawidłowa poprawna odpowiedź.']);
        exit;
    }

    $zapytaniePytanie = $polaczenie->prepare(
        'INSERT INTO pytania_testowe (news_id, tresc_pytania, odp_a, odp_b, odp_c, odp_d, poprawna_odp) VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $zapytaniePytanie->bind_param(
        'issssss',
        $newsId,
        $trescPytania,
        $odpA,
        $odpB,
        $odpC,
        $odpD,
        $poprawnaOdp
    );
    if (!$zapytaniePytanie->execute()) {
        mysqli_query($polaczenie, 'DELETE FROM news WHERE id = ' . (int) $newsId);
        http_response_code(500);
        echo json_encode(['sukces' => false, 'komunikat' => 'Nie udało się zapisać pytania.']);
        exit;
    }
}

echo json_encode(['sukces' => true, 'komunikat' => 'News został dodany.']);
?>
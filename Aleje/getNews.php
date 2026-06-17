<?php
header('Content-Type: application/json; charset=utf-8');

$conn = mysqli_connect('localhost', 'root', '', 'alejenews');

if (!$conn) {
    echo json_encode(['error' => 'Brak polaczenia z baza']);
    exit;
}

// ========== POBIERANIE POGODY NA ŻYWO - ŁUKÓW ==========
function pobierzPogode() {
    // Współrzędne Łuków
    $lat = 51.9294;
    $lon = 22.3843;
    
    $url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current=temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m,wind_direction_10m,pressure_msl,is_day&timezone=auto";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200 || !$response) {
        return null;
    }
    
    $data = json_decode($response, true);
    return $data['current'] ?? null;
}

function opisPogody($kod) {
    $mapa = [
        0 => ['Bezchmurnie', '☀️'],
        1 => ['Przeważnie bezchmurnie', '🌤️'],
        2 => ['Częściowe zachmurzenie', '⛅'],
        3 => ['Zachmurzenie', '☁️'],
        45 => ['Mgła', '🌫️'],
        48 => ['Szron', '🌫️'],
        51 => ['Lekka mżawka', '🌦️'],
        53 => ['Umiarkowana mżawka', '🌧️'],
        55 => ['Gęsta mżawka', '🌧️'],
        61 => ['Lekki deszcz', '🌧️'],
        63 => ['Umiarkowany deszcz', '🌧️'],
        65 => ['Silny deszcz', '⛈️'],
        71 => ['Lekki śnieg', '🌨️'],
        73 => ['Umiarkowany śnieg', '🌨️'],
        75 => ['Silny śnieg', '❄️'],
        77 => ['Ziarna śniegu', '🌨️'],
        80 => ['Lekkie opady deszczu', '🌧️'],
        81 => ['Umiarkowane opady deszczu', '🌧️'],
        82 => ['Silne opady deszczu', '⛈️'],
        85 => ['Lekkie opady śniegu', '🌨️'],
        86 => ['Silne opady śniegu', '❄️'],
        95 => ['Burza', '⛈️'],
        96 => ['Burza z gradem', '⛈️'],
        99 => ['Silna burza z gradem', '⛈️'],
    ];
    return $mapa[$kod] ?? ['Nieznane', '❓'];
}

function kierunekWiatru($stopnie) {
    $kierunki = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'];
    $index = round($stopnie / 22.5) % 16;
    return $kierunki[$index];
}

// Pobierz pogodę
$pogoda = pobierzPogode();
$pogodaData = null;

if ($pogoda) {
    [$opis, $ikona] = opisPogody($pogoda['weather_code']);
    $pogodaData = [
        'temperatura' => round($pogoda['temperature_2m']),
        'odczuwalna' => round($pogoda['apparent_temperature']),
        'opis' => $opis,
        'ikona' => $ikona,
        'wilgotnosc' => $pogoda['relative_humidity_2m'],
        'wiatr' => round($pogoda['wind_speed_10m']),
        'kierunek_wiatru' => kierunekWiatru($pogoda['wind_direction_10m']),
        'cisnienie' => round($pogoda['pressure_msl']),
        'noc' => $pogoda['is_day'] === 0,
        'czas' => $pogoda['time']
    ];
}

// ========== POBIERANIE NEWSÓW Z BAZY ==========
$after = isset($_GET['after']) ? (int)$_GET['after'] : 0;

$sql = "SELECT id, plik, tytul, opis, czas_trwania, rodzaj
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
    $fallback = mysqli_query($conn, "SELECT id, plik, tytul, opis, czas_trwania, rodzaj FROM news ORDER BY id ASC LIMIT 1");
    $row = mysqli_fetch_assoc($fallback);
}

if (!$row) {
    echo json_encode([
        'id' => 0,
        'file' => 'visuals/aleje.jpg',
        'title' => 'Pogoda na żywo',
        'subtitle' => $pogodaData ? "{$pogodaData['ikona']} {$pogodaData['temperatura']}°C, {$pogodaData['opis']}" : 'Brak danych pogodowych',
        'time' => 10,
        'rodzaj' => 'zdjecie',
        'pogoda' => $pogodaData
    ]);
    exit;
}

echo json_encode([
    'id' => (int)$row['id'],
    'file' => $row['plik'],
    'title' => $row['tytul'],
    'subtitle' => $row['opis'],
    'time' => $row['czas_trwania'],
    'rodzaj' => $row['rodzaj'],
    'pogoda' => $pogodaData
]);
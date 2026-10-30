<?php
header('Content-Type: application/json; charset=utf-8');

$connection = mysqli_connect('localhost', 'root', '', 'alejenews');

if (!$connection) {
    echo json_encode(['error' => 'Brak polaczenia z baza']);
    exit;
}

function fetchWeather() {
    $lat = 51.9294;
    $lon = 22.3843;
    
    $url = "https://api.open-meteo.com/v1/forecast?latitude={$lat}&longitude={$lon}&current=temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m,wind_direction_10m,pressure_msl,is_day&timezone=auto";
    
    $curlHandle = curl_init();
    curl_setopt_array($curlHandle, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_FOLLOWLOCATION => true,
    ]);
    
    $response = curl_exec($curlHandle);
    $httpCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
    curl_close($curlHandle);
    
    if ($httpCode !== 200 || !$response) {
        return null;
    }
    
    $weatherData = json_decode($response, true);
    return $weatherData['current'] ?? null;
}

function describeWeather($code) {
    $weatherDescriptions = [
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
    return $weatherDescriptions[$code] ?? ['Nieznane', '❓'];
}

function getWindDirection($degrees) {
    $directions = ['N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW'];
    $directionIndex = round($degrees / 22.5) % 16;
    return $directions[$directionIndex];
}

$weather = fetchWeather();
$weatherData = null;

if ($weather) {
    [$description, $icon] = describeWeather($weather['weather_code']);
    $weatherData = [
        'temperature' => round($weather['temperature_2m']),
        'feelsLike' => round($weather['apparent_temperature']),
        'description' => $description,
        'icon' => $icon,
        'humidity' => $weather['relative_humidity_2m'],
        'wind' => round($weather['wind_speed_10m']),
        'windDirection' => getWindDirection($weather['wind_direction_10m']),
        'pressure' => round($weather['pressure_msl']),
        'isNight' => $weather['is_day'] === 0,
        'time' => $weather['time']
    ];
}

$after = isset($_GET['after']) ? (int)$_GET['after'] : 0;

$sql = "SELECT id, plik AS file_name, tytul AS title, opis AS description,
               czas_trwania AS duration, rodzaj AS content_type
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
    $fallback = mysqli_query($connection, "SELECT id, plik AS file_name, tytul AS title, opis AS description,
                                                  czas_trwania AS duration, rodzaj AS content_type
                                           FROM news ORDER BY id ASC LIMIT 1");
    $row = mysqli_fetch_assoc($fallback);
}

if (!$row) {
    echo json_encode([
        'id' => 0,
        'file' => 'visuals/aleje.jpg',
        'title' => 'Pogoda na żywo',
        'subtitle' => $weatherData ? "{$weatherData['icon']} {$weatherData['temperature']}°C, {$weatherData['description']}" : 'Brak danych pogodowych',
        'time' => 10,
        'type' => 'image',
        'weather' => $weatherData
    ]);
    exit;
}

echo json_encode([
    'id' => (int)$row['id'],
    'file' => $row['file_name'],
    'title' => $row['title'],
    'subtitle' => $row['description'],
    'time' => $row['duration'],
    'type' => $row['content_type'] === 'zdjecie' ? 'image' : ($row['content_type'] === 'wideo' ? 'video' : $row['content_type']),
    'weather' => $weatherData
]);
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminPanelStyle.css">
    <title>Admin Panel</title>
</head>
<body>
    <div id="menuGlowne">
        <h1>Panel admina Aleje news</h1>
        <button onclick="zmienWidok('dodajNewsa')">Dodaj newsa</button>
        <button onclick="zmienWidok('baza')"> Wyswietl baze </button>
    </div>
    <div id="dodajNewsa">
        <div id="formularz">
            <h1>Dodaj newsa</h1>
            <p>Rodzaj: </p>
            <select name="rodzaj" id="rodzaj">
                <option value="zdjecie">Zdjecie</option>
                <option value="wideo">Wideo</option>
                <option value="pytanie_testowe">Pytanie testowe</option>
            </select><br>
            <div type="zdjecie">
                <label for="tytul">Tytuł newsa:</label>
                <input type="text" id="tytul" name="tytul"><br>
                <label for="zdjecie">Zdjęcie:</label>
                <input type="file" id="zdjecie" name="zdjecie"><br>
                <label for="opis">Opis:</label>
                <input type="text" id="opis" name="opis"><br>
                <label for="czasTrwania">Czas trwania (w sekundach):</label>
                <input type="number" id="czasTrwania" name="czasTrwania"><br>
                <button onclick="dodajNewsa()">Dodaj newsa</button>
            </div>
            <div type="zdjecie" style="display: none;">

            </div>
            <div type="pytanie_testowe" style="display: none;">

            </div>
        </div>
        <div id="podglad">
            <iframe src="index.html?preview=true"></iframe>
        </div>
    </div>
    <div id="baza" style="display: none;">
        <h1>Baza newsów</h1>
        <div id="tabelaBaza">

        </div>
    </div>
</body>
</html>
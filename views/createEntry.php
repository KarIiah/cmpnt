<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telefonbuch</title>
</head>

<body>
    <form method="POST" action="/controller/publicHandler/createEntryHandler.php">
        <label for="firstName">Vorname: </label>
        <input required type="text" maxlength="50" id="firstName" name="firstName" placeholder="Vorname...">
        <br> <br>

        <label for="lastName">Nachname: </label>
        <input required type="text" maxlength="50" id="lastName" name="lastName" placeholder="Nachname...">
        <br> <br>

        <label for="telephoneNr">Telefonnummer: </label>
        <input required type="text" maxlength="20" id="telephoneNr" name="telephoneNr" placeholder="+49 ...">
        <br> <br>

        <button type="submit">Speichern</button>
        <button onclick="location.href='/'">Zurück zur Übersicht</button>
    </form>
</body>
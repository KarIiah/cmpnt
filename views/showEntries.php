<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telefonbuch</title>
</head>

<body>
    <button onclick="location.href='../controller/createEntryHandler.php'">Neuer Eintrag</button>

    <br> <hr> <br>

    <form method="POST" action="/controller/getEntriesHandler.php">
        <label for="search">T9 Suche: </label>
        <input type="number" maxlength="50" id="search" name="search" placeholder="..."><br>
        <button type="submit">Suchen</button>
    </form>

    <br> <hr> <br>

    <table>
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Telefonnummer</th>
        </tr>
        <tr>
            <?php
            if (isset($entries)) {
                foreach ($entries as $entry) {
                    echo "<tr>";
                    echo "<td>" . $entry->getFirstname() . "</td>";
                    echo "<td>" . $entry->getLastname() . "</td>";
                    echo "<td>" . $entry->getTelephoneNr() . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<td> - </td>";
                echo "<td> - </td>";
                echo "<td> - </td>";
            }
            ?>
        </tr>
    </table>
</body>
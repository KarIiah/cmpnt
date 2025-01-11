<?php

include_once '../../entities/Entry.php';
include_once '../database/EntryController.php';
include_once '../../views/createEntry.php';
include_once '../errorHandling/ErrorHandler.php';

$errorHandler = new ErrorHandler();

// Checkt, ob die richtige Methode verwendet und die Pflichtfelder gesetzt sind
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstName'], $_POST['lastName'], $_POST['telephoneNr'])) {
    // Sanitize input
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $telephoneNr = htmlspecialchars(trim($_POST['telephoneNr']));
    $firstNameT9 = getT9($firstName);
    $lastNameT9 = getT9($lastName);

    try {
        $controller = new EntryController();
        $data = new Entry();
        $data
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setTelephoneNr($telephoneNr)
            ->setFirstNameT9($firstNameT9)
            ->setLastNameT9($lastNameT9);

        $controller->insertEntry($data);
    } catch (PDOException $e) {
        $errorHandler->handleException(new PDOException($e->getMessage()));
    }
}

/**
 * Wandelt einen String (Namen) in einen T9-String um.
 *
 * @param string $string
 * @return string
 */
function getT9(string $string): string {
    $t9String = "";
    $t9Mapping = [
        '1' => ['a', 'b', 'c'],
        '2' => ['d', 'e', 'f'],
        '3' => ['g', 'h', 'i'],
        '4' => ['j', 'k', 'l'],
        '5' => ['m', 'n', 'o'],
        '6' => ['p', 'q', 'r', 's'],
        '7' => ['t', 'u', 'v'],
        '8' => ['w', 'x', 'y', 'z'],
        '9' => []
    ];

    foreach (str_split(strtolower($string)) as $char) {
        foreach ($t9Mapping as $number => $letters) {
            if (in_array($char, $letters)) {
                $t9String .= $number;
                break;
            }
        }
    }

    return $t9String;
}
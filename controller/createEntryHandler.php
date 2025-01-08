<?php

include_once '../entities/Entry.php';
include_once '../database/EntryController.php';
include_once '../views/createEntry.php';
include_once '../controller/ErrorHandler.php';

$errorHandler = new ErrorHandler();

// Checkt, ob die richtige Methode verwendet und die Pflichtfelder gesetzt sind
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstName'], $_POST['lastName'], $_POST['telephoneNr'])) {
    // Sanitize input
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $telephoneNr = htmlspecialchars(trim($_POST['telephoneNr']));

    try {
        $controller = new EntryController();
        $data = new Entry();
        $data->setFirstName($firstName)->setLastName($lastName)->setTelephoneNr($telephoneNr);

        $controller->insertEntry($data);
    } catch (PDOException $e) {
        $errorHandler->handleException(new PDOException($e->getMessage()));
    }
}
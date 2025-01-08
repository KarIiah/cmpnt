<?php

include_once '../database/EntryController.php';
include_once '../controller/ErrorHandler.php';

$errorHandler = new ErrorHandler();

// Checkt, ob die richtige Methode verwendet wird
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $controller = new EntryController();

        $entries = $controller->getEntries();

        include_once '../views/showEntries.php';
    } catch (PDOException $e) {
        $errorHandler->handleException(new PDOException($e->getMessage()));
    }
}

//  Checkt, ob die richtige Methode verwendet wird und die Suche gesetzt ist
if ($_SERVER['REQUEST_METHOD'] === 'POST' || isset($_POST['search'])) {
    try {
        $search = htmlspecialchars(trim($_POST['search']));
        $controller = new EntryController();

        $entries = $controller->getEntries($search);

        include_once '../views/showEntries.php';
    } catch (PDOException $e) {
        $errorHandler->handleException(new PDOException($e->getMessage()));
    }
}
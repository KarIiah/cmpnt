<?php

include_once '../../entities/Entry.php';
include_once '../errorHandling/ErrorHandler.php';

class EntryController
{
    private PDO $pdo;
    private ErrorHandler $errorHandler;

    public function __construct()
    {
        $this->errorHandler = new ErrorHandler();

        // sollte dann idealerweise aus einer Config o.ä. kommen, könnte ggf auch ausgelagert werden
        $dsn = 'mysql:host=localhost;dbname=CMPNT_TELEPHONE';
        $dbusernamen = 'root';
        $dbpasswort = '';

        try {
            $pdo = new PDO($dsn, $dbusernamen, $dbpasswort);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        } catch (PDOException $e) {
            $this->errorHandler->handleException(new PDOException($e->getMessage()));
        }
    }

    /**
     * Fügt einen neuen Eintrag in die Tabelle Entry ein
     *
     * @param Entry $data Objekt der Klasse Entry
     * @return void verweist auf die Fehlerseite, sobald ein Fehler auftritt
     */
    public function insertEntry(Entry $data): void
    {
        $firstName = $data->getFirstName();
        $lastName = $data->getLastName();
        $firstNameT9 = $data->getFirstNameT9();
        $lastNameT9 = $data->getLastNameT9();
        $telephoneNr = $data->getTelephoneNr();

        if (empty($firstName) || empty($lastName) || empty($telephoneNr)) {
            echo "Ungültige Eingabe: Vorname, Nachname und Telefonnummer sind erforderlich.";
        }

        try {
            // SQL statement vorbereiten
            $query = $this->pdo->prepare("
                INSERT INTO Entry (firstName, lastName, telephoneNr, firstNameT9, lastNameT9) 
                VALUES (:firstName, :lastName, :telephoneNr, :firstNameT9, :lastNameT9)
            ");

            // Parameter binden
            $query->bindParam(':firstName', $firstName);
            $query->bindParam(':lastName', $lastName);
            $query->bindParam(':firstNameT9', $firstNameT9);
            $query->bindParam(':lastNameT9', $lastNameT9);
            $query->bindParam(':telephoneNr', $telephoneNr);

            $query->execute();
        } catch (PDOException $e) {
            $this->errorHandler->handleException(new PDOException($e->getMessage()));
        }
    }

    /**
     * holt alle Einträge für die Gesamtübersicht und die Suche (falls $search gesetzt ist)
     *
     * @param Number $search
     * @return array von Entry
     */
    public function getEntries($search = null): array {
        try {
            $where = "";

            if (!empty($search)) {
                $where = " WHERE firstNameT9 LIKE :search OR lastNameT9 LIKE :search";
            }

            $query = $this->pdo->prepare("SELECT firstName, lastName, telephoneNr FROM Entry " . $where);
            
            if (!empty($search)) {
                $likeSearch = "%$search%";
                $query->bindParam(':search', $likeSearch);
            }

            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'Entry');
        } catch (PDOException $e) {
            $this->errorHandler->handleException(new PDOException($e->getMessage()));
            return [];
        }
    }
}
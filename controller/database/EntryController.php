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
    public function insertEntry(Entry $data)
    {
        $firstName = $data->getFirstName();
        $lastName = $data->getLastName();
        $telephoneNr = $data->getTelephoneNr();

        if (empty($firstName) || empty($lastName) || empty($telephoneNr)) {
            echo "Ungültige Eingabe: Vorname, Nachname und Telefonnummer sind erforderlich.";
        }

        try {
            // SQL statement vorbereiten
            $query = $this->pdo->prepare("
                INSERT INTO Entry (firstName, lastName, telephoneNr) 
                VALUES (:firstName, :lastName, :telephoneNr)
            ");

            // Parameter binden
            $query->bindParam(':firstName', $firstName);
            $query->bindParam(':lastName', $lastName);
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
            $where = $this->handleSearch($search);
            $sql = "SELECT firstName, lastName, telephoneNr FROM Entry " . $where;

            // SQL statement vorbereiten
            $query = $this->pdo->prepare($sql);

            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'Entry');
        } catch (PDOException $e) {
            $this->errorHandler->handleException(new PDOException($e->getMessage()));
            return [];
        }
    }

    /**
     * iteriert die eingegebenen Zahlen der Suche durch und mappt diese zu den zugehörigen T9-chars und joined alle
     * Kombinationen in einen WHERE String
     *
     * @param Number $search
     * @return string gibt einen WHERE String zurück, der an die SQL gejoined werden kann
     */
    private function handleSearch($search): string {
        $where = "";
        if (!empty($search)) {

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

            $t9Combinations = [''];

            for ($i = 0; $i < strlen($search); $i++) {
                $digit = $search[$i];
                if (isset($t9Mapping[$digit])) {
                    $newCombinations = [];
                    foreach ($t9Combinations as $combo) {
                        foreach ($t9Mapping[$digit] as $char) {
                            $newCombinations[] = $combo . $char;
                        }
                    }
                    $t9Combinations = $newCombinations;
                }
            }

            $conditions = [];
            foreach ($t9Combinations as $combination) {
                $conditions[] = "firstName LIKE '" . $combination . "%'";
                $conditions[] = "lastName LIKE '" . $combination . "%'";
            }

            if (count($conditions) > 0) {
                $where = "WHERE (" . implode(" OR ", $conditions) . ")";
            }
        }

        return $where;
    }
}
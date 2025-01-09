<?php

class ErrorHandler
{
    /**
     * sehr vereinfachter Error-Handler, der eine Fehlerseite einbindet und den Fehler anzeigt
     *
     * @param Exception $exception
     * @return void
     */
    public function handleException(Exception $exception): void
    {
        $errorMessage = $exception->getMessage();
        include_once '../../views/errorPage.php';
    }
}

<?php

class Entry
{
    private string $firstName;
    private string $lastName;
    private string $telephoneNr;

    /** @return String */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param String $firstName
     * @return Entry
     */
    public function setFirstName(string $firstName): Entry
    {
        $this->firstName = $firstName;
        return $this;
    }

    /** @return String */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param String $lastName
     * @return Entry
     */
    public function setLastName(string $lastName): Entry
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return String
     */
    public function getTelephoneNr(): string
    {
        return $this->telephoneNr;
    }

    /**
     * @param String $telephoneNr
     * @return Entry
     */
    public function setTelephoneNr(string $telephoneNr): Entry
    {
        $this->telephoneNr = $telephoneNr;
        return $this;
    }
}
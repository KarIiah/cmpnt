<?php

class Entry
{
    private string $firstName;
    private string $lastName;
    private string $telephoneNr;
    private string $firstNameT9;
    private string $lastNameT9;

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
    /** @return String */
    public function getFirstNameT9(): string
    {
        return $this->firstNameT9;
    }

    /**
     * @param String $firstName
     * @return Entry
     */
    public function setFirstNameT9(string $firstNameT9): Entry
    {
        $this->firstNameT9 = $firstNameT9;
        return $this;
    }

    /** @return String */
    public function getLastNameT9(): string
    {
        return $this->lastNameT9;
    }

    /**
     * @param String $lastNameT9
     * @return Entry
     */
    public function setLastNameT9(string $lastNameT9): Entry
    {
        $this->lastNameT9 = $lastNameT9;
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
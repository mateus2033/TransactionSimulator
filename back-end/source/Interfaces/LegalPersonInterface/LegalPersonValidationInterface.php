<?php

namespace Source\Interfaces\LegalPersonInterface;

interface LegalPersonValidationInterface
{
    public function validateLegalPerson(array $legalPeople);
    public function mountAccountLegal() : array;
    public function validateFormAccountLegal($data);
}
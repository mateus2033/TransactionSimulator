<?php

namespace Source\Interfaces\PersonInterface;

interface PersonFindInterface 
{
    public function validateUser($user) : array;
    public function findUser($user);
    public function findPhysicalPeople(string $cpf);
    public function findLegalPeople(string $cnpj);
}
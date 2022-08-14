<?php

namespace Source\Interfaces\PersonInterface;

interface PersonValidInterface 
{
    public function validateUser(string $user) : array;
    public function validateFormAccountHoulder(string $user); 
}
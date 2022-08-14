<?php

namespace Source\Interfaces\AuthenticationInterface;

interface AuthenticationInterface
{

    public function authenticarFields(string $login, string $passowrd);
    public function authenticationPerson(object $person) : string;
    public function validPersonPassword(object $person, string $passowrd);
    public function login(string $login, string $passowrd);
    public function mountAuthenticationLog($accountHolder, $message, string $level) : bool;
    public function logout();
}
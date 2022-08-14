<?php 

namespace Source\Interfaces\HistoricInterface;

interface HistoricInterface 
{
    public function storageHistoric(string $action, string $message, object $account, float $value, $number = null): bool;
    public function storageHistoricPhysicalPerson(string $action, string $message, int $person_id, float $value, $number): bool;
    public function storageHistoriLegalPerson(string $action, string $message, int $person_id, float $value, $number): bool;
}
<?php

namespace Source\Repository\PhysicalPersonRepository;

use Exception;
use Source\Interfaces\PhysicalPersonInterface\PhysicalPersonInterface;
use Source\Logs\Logs;
use Source\Model\PhysicalPersonModel;
use Source\Repository\AccountHolderRepository\AccountHolderDeleteRepository;
use Source\Repository\AccountRepository\AccountRepository;
use Source\Repository\AddressRepository\AddressRepository;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;

class PhysicalPersonRepository extends PhysicalPersonModel implements PhysicalPersonInterface
{

    public function checkAccounPhysical(array $data)
    {
        $physicalPersonValidation = new PhysicalPersonValidation();
        $response = $physicalPersonValidation->validateAccountHolder($data);
        if (isset($response->message)) {
            $result = json_encode($response->message);
            throw new Exception($result, 400);
        } else {
            return $response;
        }
    }

    public function checkRelations(array $accountPhysical, $address_id, int $account_id = null) : array
    {
        $accountPhysical['address_id'] = $address_id;
        $accountPhysical['account_id'] = $account_id;
        return $accountPhysical;
    }

    public function storageAddress(array $address) : int
    {
        $addresRepository = new AddressRepository();
        $address_id = $addresRepository->storageAddress($address);
        return $address_id;
    }

    public function storageAccount(array $account) : int
    {
        $accounReposioty = new AccountRepository();
        $account_id = $accounReposioty->createAccount($account);
        return $account_id;
    }

    public function storagePhysicalAccount(array $accountPhysical)
    {   
        try {
            $address = $this->storageAddress($accountPhysical['address']);
            $account = $this->storageAccount($accountPhysical['account']);
            $accountPhysical = $this->checkRelations($accountPhysical, $address, $account);
            $user = $this->checkAccounPhysical($accountPhysical);
            $user = $this->create($user); 
            $this->mountAccountHolderLog($user, MessageLogs::$accountCreated . ':' . 'user' . ':' , LevelLogs::DEBUG);
            return $user;
        } catch (Exception $e) {

            (new AccountHolderDeleteRepository())->removeFromDataBase();
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    /**
     * @param $accountHolder
     * @param string $message
     * @param string $level
     * 
     * @return bool
     */
    public function mountAccountHolderLog($accountHolder, $message, string $level): bool
    {
        if (!$accountHolder->cpf == null) {
            Logs::logAccountHolder($message, $accountHolder->cpf, $level);
        }

        if (!$accountHolder->cnpj == null) {
            Logs::logAccountHolder($message, $accountHolder->cnpj, $level);
        }

        return true;
    }
}
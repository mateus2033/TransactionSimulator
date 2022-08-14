<?php

namespace Source\Repository\LegalPersonRepository;

use Exception;
use Source\Interfaces\LegalPersonInterface\LegalPersonInterface;
use Source\Logs\Logs;
use Source\Model\LegalPersonModel;
use Source\Repository\AccountHolderRepository\AccountHolderDeleteRepository;
use Source\Repository\AccountRepository\AccountRepository;
use Source\Repository\AddressRepository\AddressRepository;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;

class LegalPersonRepository extends LegalPersonModel implements LegalPersonInterface
{

    public function checkAccounLegal(array $data)
    {
        $legalPersonValidationRepository = new LegalPersonValidationRepository();
        $response = $legalPersonValidationRepository->validateLegalPerson($data);
        if (isset($response->message)) {
            $result = json_encode($response->message);
            throw new Exception($result, 400);
        } else {
            return $response;
        }
    }

    public function checkRelations(array $accountLegal, $address_id, int $account_id = null) 
    {
        $accountLegal['address_id'] = $address_id;
        $accountLegal['account_id'] = $account_id;
        return $accountLegal;
    }

    public function storageAddress(array $address) 
    {
        $addresRepository = new AddressRepository();
        $address_id = $addresRepository->storageAddress($address);
        return $address_id;
    }

    public function storageAccount(array $account) 
    {
        $accounReposioty = new AccountRepository();
        $account_id = $accounReposioty->createAccount($account);
        return $account_id;
    }

    public function storageLegalAccount(array $accountLegal)
    {
        try {
            $address = $this->storageAddress($accountLegal['address']);
            $account = $this->storageAccount($accountLegal['account']);
            $legal   = $this->checkAccounLegal($accountLegal);
            $user  = $this->checkRelations($legal, $address, $account);
            $user  = $this->create($user);
            $this->mountAccountHolderLog($user, MessageLogs::$accountCreated . ':' . 'user' . ':' , LevelLogs::DEBUG);
            return $user;
        } catch (\Exception $e) {

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
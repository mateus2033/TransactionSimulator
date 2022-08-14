<?php

namespace Source\Repository\AccountHolderRepository;

use Exception;
use Source\Interfaces\AccountHolderInterface\AccountHolderInterface;
use Source\Logs\Logs;
use Source\Repository\AccountRepository\AccountUpdateRepository;
use Source\Repository\HistoricRepository\HistoricRepository;
use Source\Repository\PersonRepository\PersonFindRepository;
use Source\Utils\FormatExceptionError;
use Source\Utils\LevelLogs;
use Source\Utils\MessageHistoric;
use Source\Utils\MessageLogs;
use Source\Utils\MessageValidation;

class AccountHolderRepository implements AccountHolderInterface
{

    public function historicList($user)
    {
        try {
            $person = new PersonFindRepository();
            $response = $person->findUser($user);
            return $response;
        } catch (\Exception $e) {
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function accountHolderList($user)
    {
        try {
            $person = new PersonFindRepository();
            $response = $person->findUser($user);
            return $response;
        } catch (\Exception $e) {
            Logs::logAccountHolder(MessageLogs::$errorFinding ,$e->getMessage(), LevelLogs::ERROR);
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function accountDeposit(string $user,  $value)
    {
        try {
            $findPerson = new PersonFindRepository();
            $user       = $findPerson->findUser($user);          
            (new AccountUpdateRepository())->depositValue($user->account, $value);
            (new HistoricRepository())->storageHistoric(MessageHistoric::deposit, MessageHistoric::depositMessage, $user, $value);
            $this->mountAccountHolderLog($user, MessageLogs::$depositMade . ':' . 'value' . ':' . $value, LevelLogs::DEBUG);
            return $user->load('account');
        } catch (Exception $e) {

            Logs::logAccount(MessageLogs::$errorDeposit, $e->getMessage(), LevelLogs::ERROR);
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function accountWithdraw(string $user,  $value)
    {
        try {
            $findPerson = new PersonFindRepository();
            $user       = $findPerson->findUser($user);  
            (new AccountUpdateRepository())->withdrawValue($user->account, $value);
            (new HistoricRepository())->storageHistoric(MessageHistoric::withdraw, MessageHistoric::withdrawMessage, $user, $value);
            $this->mountAccountHolderLog($user, MessageLogs::$withdrawSuccessfully . ':' . 'value' . ':' . $value, LevelLogs::DEBUG);
            return $user->load('account');
        } catch (Exception $e) {
            Logs::logAccountHolder(MessageLogs::$errorWithdwaw, $e->getMessage(), LevelLogs::ERROR);
            return ['message' => $e->getMessage(), 'code' => $e->getCode()];
        }
    }

    public function accountTransfer(string $user, int $numberAccount, float $value)
    {
        try {

            $findPerson = new PersonFindRepository();
            $user       = $findPerson->findUser($user);  
            (new AccountUpdateRepository())->manageTransfer($user, $numberAccount, $value);
            (new HistoricRepository())->storageHistoric(MessageHistoric::transfer, MessageHistoric::transferMessage, $user, $value, $numberAccount);
            $this->mountAccountHolderLog($user, MessageLogs::$transferMade . ':' . 'value' . ':' . $value . ':' . 'for' . ':' . $numberAccount, LevelLogs::DEBUG);
            return $user->load('account');
        } catch (Exception $e) {

            Logs::logAccountHolder(MessageLogs::$errorWhenTransferring, $e->getMessage(), LevelLogs::ERROR);
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

    public function invalidToken()
    {
        $error = FormatExceptionError::exceptionError(MessageValidation::$invalidToken);
        $error['code'] = 500;
        return $error;
    }

}

<?php

namespace Source\Controllers;

use Source\Repository\AccountHolderRepository\AccountHolderRepository;
use Source\Resource\AccountHolderResource\AccountHolderCreateResource;
use Source\Resource\AccountHolderResource\AccountHolderResource;
use Source\Resource\ListHistoricResource\ListHistoricResource;
use PlugHttp\Response;
use Source\Utils\FromJson;
use Pecee\Http\Request;
use Source\Resource\AccountResource\AccountCreateResource;

class AccountHolderController
{
    protected $accountHolder;
    protected $httpResponse;
    protected $request;
    protected $accountHolderResource;
    protected $accountHolderCreateResource;
    protected $accountCreateResource;
    protected $listHistoric;

    public function __construct(AccountCreateResource $accountCreateResource, AccountHolderRepository $accountHolder, Response $httpResponse, Request $request, AccountHolderResource $accountHolderResource, AccountHolderCreateResource $accountHolderCreateResource, ListHistoricResource $listHistoric)
    {
        $this->accountHolder = $accountHolder;
        $this->httpResponse  = $httpResponse;
        $this->request = $request;
        $this->accountHolderResource = $accountHolderResource;
        $this->accountHolderCreateResource = $accountHolderCreateResource;
        $this->listHistoric = $listHistoric;
        $this->accountCreateResource = $accountCreateResource;
    }

    public function historicList()
    {
        $user = $this->request->getInputHandler()->value('user');
        is_null($user) ? $user = 0 : (int) $user = $user;

        $response = $this->accountHolder->historicList($user);
        if (isset($response['code'])) {
            $jsonError = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($jsonError);
        } else {
            $json = $this->listHistoric->toArray($response);
            return $this->httpResponse->setStatusCode(201)->response()->json($json);
        }
    }

    public function accountHolderList()
    {
        $user = $this->request->getInputHandler()->value('user');
        is_null($user) ? $user = 0 : (string) $user = $user;

        $response = $this->accountHolder->accountHolderList($user);
        if (isset($response['code'])) {
            $jsonError = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($jsonError);
        } else {
            $json = $this->accountHolderResource->toArray($response);
            return $this->httpResponse->setStatusCode(201)->response()->json($json);
        }
    }

    public function depositAccount()
    {
        $user   = $this->request->getInputHandler()->value('user');
        $value  = $this->request->getInputHandler()->value('value');

        is_null($user)  ? $user  = 0 : $user  = (string) $user;
        is_null($value) ? $value = 0 : $value = (float) $value;

        $response = $this->accountHolder->accountDeposit($user, $value);

        if (isset($response['code'])) {
            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {
            $account = $this->accountHolderResource->toArray($response);
            return $this->httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function withdrawAccount()
    {
        $user   = $this->request->getInputHandler()->value('user');
        $value  = $this->request->getInputHandler()->value('value');

        is_null($user)   ? $user   = 0  : $user  = (string) $user;
        is_null($value)  ? $value  = 0  : $value = (float) $value;

        $response = $this->accountHolder->accountWithdraw($user, $value);
        if (isset($response['code'])) {
            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {
            $account = $this->accountHolderResource->toArray($response);
            return $this->httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function transferAccount()
    {
        $user  = $this->request->getInputHandler()->value('user');
        $numberAccount     = $this->request->getInputHandler()->value('numberAccount');
        $value             = $this->request->getInputHandler()->value('value');

        is_null($user)             ? $user          = 0    : $user             = (string) $user;
        is_null($numberAccount)    ? $numberAccount = 0    : $numberAccount    = (int) $numberAccount;
        is_null($value)            ? $value         = 0    : $value            = (float) $value;

        $response  = $this->accountHolder->accountTransfer($user, $numberAccount, $value);
        if (isset($response['code'])) {
            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {
            $account = $this->accountHolderResource->toArray($response);
            return $this->httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function invalidToken()
    {
        $response = $this->accountHolder->invalidToken();
        return $this->httpResponse->setStatusCode($response['code'])->response()->json($response);
    }
}

<?php

namespace Source\Controllers;

use PlugHttp\Response;
use Source\Utils\FromJson;
use Pecee\Http\Request;
use Source\Repository\LegalPersonRepository\LegalPersonRepository;
use Source\Resource\LegalPersonResource\LegalPersonResource;

class LegalPersonController
{
    protected $request;
    protected $httpResponse;
    protected $legalPersonRepository;
    protected $legalResource;

    public function __construct(Response $httpResponse, LegalPersonRepository $legalPersonRepository, Request $request, LegalPersonResource $legalResource)
    {
        $this->request = $request;
        $this->httpResponse = $httpResponse;
        $this->legalPersonRepository = $legalPersonRepository;
        $this->legalResource = $legalResource;   
    }

    public function storageLegalAccount()
    {
        $address  = $this->request->getInputHandler()->value('address');
        $account  = $this->request->getInputHandler()->value('account');

        $array = array(

            'name'     => $this->request->getInputHandler()->value('name'),
            'password' => $this->request->getInputHandler()->value('password'),
            'cnpj'     => $this->request->getInputHandler()->value('cnpj'),
            'stateRegistration' => $this->request->getInputHandler()->value('stateRegistration'),
            'foundationDate'    => $this->request->getInputHandler()->value('foundationDate'),
            'cellphone'         => $this->request->getInputHandler()->value('cellphone'),
            'address'           => is_null($address)  ? $address = [] : $address = $address,
            'account'           => is_null($account)  ? $account = [] : $account = $account,
            'account_id'        => null,
            'address_id'        => null,
        );

        $response = $this->legalPersonRepository->storageLegalAccount($array);
        if (isset($response['code'])) {
            $jsonError = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($jsonError);
        } else {
            $account = $this->legalResource->toArray($response);
            return $this->httpResponse->setStatusCode(201)->response()->json($account);
        }
    }
}
<?php

namespace Source\Controllers;

use PlugHttp\Response;
use Source\Utils\FromJson;
use Pecee\Http\Request;
use Source\Repository\PhysicalPersonRepository\PhysicalPersonRepository;
use Source\Resource\PhysicalPersonResource\PhysicalPersonResource;

class PhysicalPersonController
{
    protected $request;
    protected $httpResponse;
    protected $physicalPersonRepository;
    protected $physicalResource;

    public function __construct(Response $httpResponse, Request $request, PhysicalPersonRepository $physicalPersonRepository, PhysicalPersonResource $physicalResource)
    {
        $this->request = $request;
        $this->httpResponse = $httpResponse;
        $this->physicalPersonRepository = $physicalPersonRepository;
        $this->physicalResource = $physicalResource;
    }

    public function storagePhysicalAccount()
    {
        $address  = $this->request->getInputHandler()->value('address');
        $account  = $this->request->getInputHandler()->value('account');

        $array = array(
            'name'              => $this->request->getInputHandler()->value('name'),
            'cpf'               => $this->request->getInputHandler()->value('cpf'),
            'password'          => $this->request->getInputHandler()->value('password'),
            'rg'                => $this->request->getInputHandler()->value('rg'),
            'birthDate'         => $this->request->getInputHandler()->value('birthDate'),
            'cellphone'         => $this->request->getInputHandler()->value('cellphone'),
            'address'           => is_null($address)  ? $address = [] : $address = $address,
            'account'           => is_null($account)  ? $account = [] : $account = $account,
            'account_id'        => null,
            'address_id'        => null,
        );

        $response = $this->physicalPersonRepository->storagePhysicalAccount($array);
        if (isset($response['code'])) {
            $jsonError = FromJson::fromJsonError($response['message'], $response['code']);
            return $this->httpResponse->setStatusCode($response['code'])->response()->json($jsonError);
        } else {
            $account = $this->physicalResource->toArray($response);
            return $this->httpResponse->setStatusCode(201)->response()->json($account);
        }
    }
}
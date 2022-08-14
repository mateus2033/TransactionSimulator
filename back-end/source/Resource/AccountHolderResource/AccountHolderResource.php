<?php

namespace Source\Resource\AccountHolderResource;

use Source\Resource\AccountResource\AccountCreateResource;
use Source\Resource\AddressResource\AddressCreateResource;

class AccountHolderResource
{


    /**
     * Padroniza o retorno de sucesso do accountholder.
     */
    public function toArray($request)
    {

        if (isset($request->cpf)) {
            $array = array(
                'id'   => $request->id,
                'name' => $request->name,
                'cpf'  => $request->cpf,
                'rg'   => $request->rg,
                'birthDate' => $request->birthDate,
                'cellphone' => $request->cellphone,
                'address'   => (new AddressCreateResource())->toArray($request->address),
                'account'   => (new AccountCreateResource())->toArray($request->account)
            );
        }

        if (isset($request->cnpj)) {

            $array = array(
                'id'   => $request->id,
                'name' => $request->name,         
                'cnpj' => $request->cnpj,             
                'stateRegistration' => $request->stateRegistration,           
                'foundationDate' => $request->foundationDate,
                'cellphone'      => $request->cellphone,
                'address'  => (new AddressCreateResource())->toArray($request->address),
                'account'  => (new AccountCreateResource())->toArray($request->account)
            );
        }

        return $array;
    }
}

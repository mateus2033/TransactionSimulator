<?php

namespace Source\Repository\AccountHolderRepository;

use Source\Interfaces\AccountHolderInterface\AccountHolderDeleteInterface;
use Source\Model\AccountModel;
use Source\Model\AddressModel;

class AccountHolderDeleteRepository implements AccountHolderDeleteInterface
{
    private $addressModel = AddressModel::class;
    private $accountModel = AccountModel::class;

    public function removeFromDataBase()
    {

        $deleteAddress = new AddressModel();
        $addresses     = $this->addressModel::where('id' ,'>', 0)->get();
        

        foreach($addresses as $address){
            $physical = $address->physicalPerson;
            $legal    = $address->legalPerson;
            if($physical == null && $legal == null)
            {
                $deleteAddress->destroy($address->id);
            }
        }

        $accounts     = $this->accountModel::where('id', '>', 0)->get();
        $accountModel = new AccountModel();

        foreach($accounts as $account){

            $physical = $account->physicalPerson;
            $legal    = $account->legalPerson;
            if($physical == null && $legal == null)
            {
                $accountModel->destroy($account->id);
            }
        }
    }
    
}
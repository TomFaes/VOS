<?php

namespace App\Repositories;

use App\Models\TypeAccount;
use App\Repositories\Contracts\ITypeAccount;
use Illuminate\Http\Request;

/**
 * Description of TypeAccount
 *
 */
class TypeAccountRepo extends Repository implements ITypeAccount {

    public function getAllTypeAccounts()
    {
        return TypeAccount::OrderBy('Name')->get();
    }

    public function getTypeAccount($id)
    {
        $type =  TypeAccount::find($id);
        return $type;
    }

    protected function setTypeAccount(TypeAccount $typeAccount, $request)
    {
        $request->input('Name') != "" ? $typeAccount->Name = $request->input('Name') : "";
        return $typeAccount;
    }

    public function create(Request $request)
    {
        $typeAccount = new TypeAccount();
        $typeAccount = $this->setTypeAccount($typeAccount, $request);
        $typeAccount->save();
        return $typeAccount;
    }

    public function update(Request $request, $id)
    {
        $typeAccount = $this->getTypeAccount($id);
        $typeAccount = $this->setTypeAccount($typeAccount, $request);
        $typeAccount->save();
        return $typeAccount;
    }

    public function destroy($id)
    {
        $typeAccount = $this->getTypeAccount($id);
        $typeAccount->delete();
        return "Account type is deleted";
    }
}

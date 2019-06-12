<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of RoleValidation
 *
 * @author
 */
class UserValidation extends Validation {

    public function validateUser(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'FirstName' => 'required',
                'Name' => 'required',
                'Email' => 'unique:user,email,'.$id,
                'PostalCode' => 'numeric|digits:4',
                'password' => 'sometimes|string|min:6|confirmed',
            ],
            [
                'FirstName.required' => 'Name is required',
                'Name.required' => 'Name is required',
                'Email.unique' => 'Email has been taken already',
                'PostalCode.numeric' => 'PostalCode needs to be a number',
                'PostalCode.digits' => 'PostalCode needs to be 4 digets',
                'password.min' => 'paswoord moet minstens 6 karakters hebben',
            ]
        );
    }





}

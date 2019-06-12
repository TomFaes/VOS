<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of RoleValidation
 *
 * @author
 */
class RoleValidation extends Validation {

    public function validateRole(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Name' => 'required',
            ],
            [
                'Name.required' => 'Name is required',
            ]
        );
    }





}

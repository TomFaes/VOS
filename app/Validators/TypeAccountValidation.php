<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of TypeAccountValidation
 *
 * @author
 */
class TypeAccountValidation extends Validation {

    public function validateAccountType(Request $request, $id = 0){
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

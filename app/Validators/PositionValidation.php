<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of FunctionValidation
 *
 * @author
 */
class PositionValidation extends Validation {

    public function validatePosition(Request $request, $id = 0){
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

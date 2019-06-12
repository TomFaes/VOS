<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of ProcedureTypeValidation
 *
 * @author
 */
class ProcedureTypeValidation extends Validation {

    public function validateProcedureType(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Name' => 'required',
                'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'Name.required' => 'Procedure type name is required',
                'Image.image' => 'This is not an image',
                'Image.mimes' => 'This is not an image',
            ]
        );
    }





}

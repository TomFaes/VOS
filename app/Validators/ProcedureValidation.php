<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of ProcedureValidation
 *
 * @author
 */
class ProcedureValidation extends Validation {

    public function validateProcedure(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Code' => 'required',
                'Title' => 'required',
                'Description' => 'required',
                'Heading' => 'required',
                'ProcedureTypeId' => 'required',
                'RoleId' => 'required',
                'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ],
            [
                'Code.required' => 'Procedure code is required',
                'Title.required' => 'Procedure title is required',
                'Description.required' => 'Procedure description is required',
                'Heading.required' => 'Procedure heading is required',
                'ProcedureTypeId.required' => 'Procedure procedure type is required',
                'RoleId.required' => 'Procedure role is required',
                'Image.image' => 'This is not an image',
                'Image.mimes' => 'This is not an image',
            ]
        );
    }





}

<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of StepValidation
 *
 * @author
 */
class StepValidation extends Validation {

    public function validateStep(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Type' => 'required',
                'Title' => 'required',
                'ProcedureId' => 'required',
            ],
            [
                'Type.required' => 'Type is required',
                'Title.required' => 'Title is required',
                'ProcedureId.required' => 'Procedure is required',
            ]
        );
    }
}

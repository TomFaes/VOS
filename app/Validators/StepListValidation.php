<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of StepListValidation
 *
 * @author
 */
class StepListValidation extends Validation {

    public function validateStepList(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Title' => 'required',
                'StepId' => 'required',
            ],
            [
                'Title.required' => 'A Title is required',
                'StepId.required' => 'A Step is required',
            ]
        );
    }

    public function validateUpdateStepList(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Title' => 'required',
            ],
            [
                'Title.required' => 'A Title is required',
            ]
        );
    }



}

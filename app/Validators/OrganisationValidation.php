<?php

namespace App\Validators;

use Illuminate\Http\Request;

/**
 * Description of OrganisationValidation
 *
 * @author
 */
class OrganisationValidation extends Validation {

    public function validateOrganisation(Request $request, $id = 0){
        return $this->validate(
            $request,
            [
                'Name' => 'required',
                'Latitude' => 'numeric',
                'Longitude' => 'numeric',
                'PostalCode' => 'numeric|digits:4'
            ],
            [
                'Name.required' => 'Organisatie name is required',
                'Latitude.numeric' => 'Latitude needs to be a number',
                'Longitude.numeric' => 'Latitude needs to be a number',
                'PostalCode.numeric' => 'PostalCode needs to be a number',
                'PostalCode.digits' => 'PostalCode needs to be 4 digets',
            ]
        );
    }





}

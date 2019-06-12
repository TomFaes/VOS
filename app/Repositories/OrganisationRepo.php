<?php

namespace App\Repositories;

use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IOrganisation;

/**
 * Description of Function
 *
 */
class OrganisationRepo extends Repository implements IOrganisation {

    public function getAllOrganisations()
    {
        return Organisation::with(['preventieAdviseur'])->OrderBy('Name')->get();
    }

    public function getOrganisation($id)
    {
        return Organisation::with(['preventieAdviseur'])->find($id);
    }

    protected function setOrganisation(Organisation $organisatie, $request)
    {
        $request->input('Name') != "" ? $organisatie->Name = $request->input('Name') : "";
        $request->input('Street') != "" ? $organisatie->Street = $request->input('Street') : "";
        $request->input('PostalCode') != "" ? $organisatie->PostalCode = $request->input('PostalCode') : "";
        $request->input('City') != "" ? $organisatie->City = $request->input('City') : "";
        $request->input('SecretariaatTel') != "" ? $organisatie->SecretariaatTel = $request->input('SecretariaatTel') : "";
        $request->input('ClbTel') != "" ? $organisatie->ClbTel = $request->input('ClbTel') : "";
        $request->input('PreventieAdviseurId') != "" ? $organisatie->PreventieAdviseurId = $request->input('PreventieAdviseurId') : "";
        $request->input('Latitude') != "" ? $organisatie->Latitude = $request->input('Latitude') : "";
        $request->input('Longitude') != "" ? $organisatie->Longitude = $request->input('Longitude') : "";
        return $organisatie;
    }

    public function create(Request $request)
    {
        $organisatie = new Organisation();
        $organisatie = $this->setOrganisation($organisatie, $request);
        $organisatie->save();
        return $organisatie;
    }

    public function update(Request $request, $id)
    {
        $organisatie = $this->getOrganisation($id);
        $organisatie = $this->setOrganisation($organisatie, $request);
        $organisatie->save();
        return $organisatie;
    }

    public function destroy($id)
    {
        $organisatie = $this->getOrganisation($id);
        $organisatie->delete();
        return "Organisation is deleted";
    }
}

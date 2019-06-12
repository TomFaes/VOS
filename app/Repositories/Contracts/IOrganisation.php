<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IOrganisation  {
    public function getAllOrganisations();
    public function getOrganisation($id);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

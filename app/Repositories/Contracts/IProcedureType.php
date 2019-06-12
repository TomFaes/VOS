<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IProcedureType {
    public function getAllProcedureTypes();
    public function getProcedureType($id);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

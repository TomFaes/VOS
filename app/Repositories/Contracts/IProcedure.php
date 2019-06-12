<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IProcedure {
    public function getAllProcedures();
    public function getAllRoleProcedures($roleId);
    public function getProcedure($id);
    public function getProcedureFromType($typeId);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

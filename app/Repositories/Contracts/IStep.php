<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IStep  {
    public function getAllSteps();
    public function getAllRoleSteps($roleId);
    public function getStep($id);
    public function getStepsFromProcedure($procedureId);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);

    public function moveItemUpInList($id);
    public function moveItemDownInList($id);
}

<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IRole  {
    public function getAllRoles();
    public function getRole($id);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

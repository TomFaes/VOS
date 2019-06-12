<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ITypeAccount  {
    public function getAllTypeAccounts();
    public function getTypeAccount($id);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

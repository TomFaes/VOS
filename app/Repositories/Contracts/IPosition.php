<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IPosition  {
    public function getAllPositions();
    public function getPosition($id);

    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}

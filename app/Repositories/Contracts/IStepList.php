<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IStepList  {
    public function getAllStepLists();
    public function getStepList($id);


    public function create(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);

    public function moveItemUpInList($id);
    public function moveItemDownInList($id);
}

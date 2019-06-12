<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ILog  {
    public function getAllLogs();
    public function getLog($id);

    public function create(Request $request);
}

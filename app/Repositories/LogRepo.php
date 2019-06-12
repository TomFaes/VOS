<?php

namespace App\Repositories;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ILog;

/**
 * Description of Function
 *
 */
class LogRepo extends Repository implements ILog {

    public function getAllLogs()
    {
        return Log::OrderBy('created_at')->get();
    }

    public function getLog($id)
    {
        return Log::find($id);
    }

    protected function setLog(Log $log, $request)
    {
        $request->input('UserName') != "" ? $log->UserName = $request->input('UserName') : "";
        $request->input('Email') != "" ? $log->Email = $request->input('Email') : "";
        $request->input('Role') != "" ? $log->Role = $request->input('Role') : "";
        $request->input('ProcedureCode') != "" ? $log->ProcedureCode = $request->input('ProcedureCode') : "";
        $request->input('ProcedureTitle') != "" ? $log->ProcedureTitle = $request->input('ProcedureTitle') : "";
        $request->input('StepTitle') != "" ? $log->StepTitle = $request->input('StepTitle') : "";
        $request->input('Action') != "" ? $log->Action = $request->input('Action') : "";
        $request->input('CallingNumber') != "" ? $log->CallingNumber = $request->input('CallingNumber') : "";
        $request->input('SendNumber') != "" ? $log->SendNumber = $request->input('SendNumber') : "";
        return $log;
    }

    public function create(Request $request)
    {
        $log = new Log();
        $log = $this->setLog($log, $request);
        $log->save();
        return $log;
    }
}

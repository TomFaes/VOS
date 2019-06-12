<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ILog;
use App\Repositories\Contracts\IUser;
use App\Repositories\Contracts\IStep;

/**
 * This class will be used to keep track when a user uses the call or SMS function
 */
class LogController extends Controller
{
     /** @var App\Repositories\Log */
     protected $log;
     /** @var App\Repositories\User */
     protected $user;
     /** @var App\Repositories\Step */
     protected $step;

     public function __construct(ILog $log, IUser $user, IStep $step)
     {
        $this->middleware('auth:api');
        $this->middleware('admin:Editor|Admin');
        $this->log = $log;
        $this->user = $user;
        $this->step = $step;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->log->getAllLogs(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->user->getUser(auth('api')->user()->Id);

        if($request->input('StepId') !== null){
            $step = $this->step->getStep($request->input('StepId'));
            $request->request->add(['ProcedureCode' => $step->procedure->Code]);
            $request->request->add(['ProcedureTitle' => $step->procedure->Title]);
            $request->request->add(['StepTitle' => $step->Title]);
        }else{
            $request->request->add(['ProcedureCode' => "Error"]);
            $request->request->add(['ProcedureTitle' => "Error"]);
            $request->request->add(['StepTitle' => "Error"]);
        }
        $request->request->add(['UserName' => $user->UserName]);
        $request->request->add(['Email' => $user->Email]);
        $request->request->add(['Role' => $user->role->Name]);

        $log = $this->log->create($request);
        return response()->json($log, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->log->getLog($id), 200);
    }
}

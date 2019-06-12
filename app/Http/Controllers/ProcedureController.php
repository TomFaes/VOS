<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;

use App\Repositories\Contracts\IProcedure;
use App\Validators\ProcedureValidation;

/**
 * The Procedure controller will be used to manipulate or view Procedure data
 */
class ProcedureController extends Controller
{
    /** @var App\Repositories\$procedure */
    protected $procedure;
    /** @var App\Validators\$procedureValidation */
    protected $procedureValidation;

    public function __construct(IProcedure $procedure, ProcedureValidation $procedureValidation)
    {
        $this->middleware('auth:api',['except'=>['index', 'showType']]);
        $this->middleware('admin:Editor|Admin',['except' => ['index','showType']]);

        $this->procedure = $procedure;
        $this->procedureValidation = $procedureValidation;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view(){
        return view('procedure.index');
    }

    /**
     * Display a listing of the resource which belongt to a certain role. If the user is a guest
     * the guest proceduers will be returned
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleId = 3;
        if(auth('api')->user() != null){
            $roleId = auth('api')->user()->RoleId;
        }
        return response()->json($this->procedure->getAllRoleProcedures($roleId), 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllProcedures(){
        return response()->json($this->procedure->getAllProcedures(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->procedureValidation->validateProcedure($request);
        $procedure = $this->procedure->create($request);
        return response()->json($procedure, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->procedure->getProcedure($id), 200);
    }

    /**
     * Display the specified resource. If the user is a guest
     * the guest proceduers will be returned
     *
     * @return \Illuminate\Http\Response
     */
    public function showType($typeId)
    {
        $roleId = 3;
        if(auth('api')->user() != null){
            $roleId = auth('api')->user()->RoleId;
        }
        return response()->json($this->procedure->getProcedureFromType($typeId, $roleId), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->procedureValidation->validateProcedure($request);
        $type = $this->procedure->update($request, $id);
        return response()->json($type, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->procedure->destroy($id);
        return response()->json("Procedure is deleted", 204);
    }
}

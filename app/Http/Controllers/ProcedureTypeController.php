<?php

namespace App\Http\Controllers;

use App\Models\ProcedureType;
use Illuminate\Http\Request;

use App\Repositories\Contracts\IProcedureType;
use App\Validators\ProcedureTypeValidation;

/**
 * The ProcedureType controller will be used to manipulate or view ProcedureType data
 */
class ProcedureTypeController extends Controller
{
    /** @var App\Repositories\$procedureType */
    protected $procedureType;
    /** @var App\Validators\$procedureTypeValidation */
    protected $typeValidation;

    public function __construct(IProcedureType $procedureType, ProcedureTypeValidation $procedureTypeValidation) {
        $this->middleware('auth:api',['except'=>['index', 'show']]);
        $this->middleware('admin:Editor|Admin',['except' => ['index','show']]);
        $this->procedureType = $procedureType;
        $this->typeValidation = $procedureTypeValidation;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view(){
        return view('proceduretype.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->procedureType->getAllProcedureTypes(), 200);
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
        $this->typeValidation->validateProcedureType($request);
        $type = $this->procedureType->create($request);
        return response()->json($type, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcedureType  $procedureType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->procedureType->getProcedureType($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcedureType  $procedureType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcedureType $procedureType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcedureType  $procedureType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->typeValidation->validateProcedureType($request);
        $type = $this->procedureType->update($request, $id);
        return response()->json($type, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcedureType  $procedureType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->procedureType->destroy($id);
        return response()->json("Procedure type is deleted", 204);
    }
}

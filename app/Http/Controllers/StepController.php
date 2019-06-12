<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

use App\Repositories\Contracts\IStep;
use App\Validators\StepValidation;

/**
 * The Step controller will be used to manipulate or view Step data
 */
class StepController extends Controller
{
    /** @var App\Repositories\Step */
    protected $step;
    /** @var App\Validators\StepValidation */
    protected $stepValidation;

    public function __construct(IStep $step, StepValidation $stepValidation) {
        $this->middleware('auth:api',['except'=>['index', 'showProcedure']]);
        $this->middleware('admin:Editor|Admin',['except' => ['index','showProcedure']]);
        $this->step = $step;
        $this->stepValidation = $stepValidation;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view()
    {
        return view('step.index');
    }

    /**
     * Display a listing of the resource.If the user is a guest
     * the guest steps will be returned
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleId = 3;
        if(auth('api')->user() != null){
            $roleId = auth('api')->user()->RoleId;
        }
        return response()->json($this->step->getAllRoleSteps($roleId ), 200);
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSteps(){
        return response()->json($this->step->getAllSteps(), 200);
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
        $this->stepValidation->validateStep($request);
        $step = $this->step->create($request);
        return response()->json($step, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->step->getStep($id), 200);
    }

    /**
     * Display all steps from a procedure
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function showProcedure($procedureId)
    {
        return response()->json($this->step->getStepsFromProcedure($procedureId), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->stepValidation->validateStep($request);
        $step = $this->step->update($request, $id);
        return response()->json($step, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->step->destroy($id);
        return response()->json("Step is deleted", 204);
    }

    /**
     * Moves a step 1 step up in the list
     */
    public function moveItemUpInList($id){
        $this->step->moveItemUpInList($id);
        return response()->json("Item is moved", 200);
    }

    /**
     * Moves a step 1 step down in the list
     */
    public function moveItemDownInList($id){
        $this->step->moveItemDownInList($id);
        return response()->json("Item is moved", 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\StepList;
use Illuminate\Http\Request;

use App\Repositories\Contracts\IStepList;
use App\Validators\StepListValidation;

/**
 * The StepList controller will be used to manipulate or view StepList data
 */
class StepListController extends Controller
{

    /** @var App\Repositories\StepList */
    protected $steplist;
    /** @var App\Validators\StepListValidation */
    protected $steplistValidation;

    public function __construct(IStepList $steplist, StepListValidation $steplistValidation) {
        $this->middleware('auth:api',['except'=>['index', 'show']]);
        $this->middleware('admin:Editor|Admin',['except' => ['index','show']]);
        $this->steplist = $steplist;
        $this->steplistValidation = $steplistValidation;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view()
    {
        return view('steplist.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->steplist->getAllStepLists(), 200);
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
        $this->steplistValidation->validateStepList($request);
        $steplist = $this->steplist->create($request);
        return response()->json($steplist, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StepList  $stepList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->steplist->getStepList($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StepList  $stepList
     * @return \Illuminate\Http\Response
     */
    public function edit(StepList $stepList)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StepList  $stepList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
         $this->steplistValidation->validateUpdateStepList($request);
        $steplist = $this->steplist->update($request, $id);
        return response()->json($steplist, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StepList  $stepList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->steplist->destroy($id);
        return response()->json("Steplist is deleted", 204);
    }

    /**
     * Moves a step 1 step up in the list
     */
    public function moveItemUpInList($id){
        $this->steplist->moveItemUpInList($id);
        return response()->json("Item is moved", 200);
    }

    /**
     * Moves a step 1 step down in the list
     */
    public function moveItemDownInList($id){
        $this->steplist->moveItemDownInList($id);
        return response()->json("Item is moved", 200);
    }







}

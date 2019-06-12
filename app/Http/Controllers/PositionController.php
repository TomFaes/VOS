<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\IPosition;
use App\Validators\PositionValidation;
/**
 * The Position controller will be used to manipulate or view Position data
 */
class PositionController extends Controller
{
     /** @var App\Repositories\Position */
     protected $position;
     /** @var App\Validators\TypeAccountValidation */
     protected $PositionValidation;

     public function __construct(IPosition $position, PositionValidation $positionValidation)
     {
        $this->middleware('auth:api');
        $this->middleware('admin:Admin');
        $this->position = $position;
        $this->positionValidation = $positionValidation;
     }

     /**
      * Will be loading a test page to see how all methods work
      */
     public function view()
    {
        return view('position.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->position->getAllPositions(), 200);
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
        $this->positionValidation->validatePosition($request);
        $position = $this->position->create($request);
        return response()->json($position, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->position->getPosition($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->positionValidation->validatePosition($request);
        $position = $this->position->update($request, $id);
        return response()->json($position, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->position->destroy($id);
        return response()->json("Position is deleted", 204);
    }
}

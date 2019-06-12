<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

use App\Repositories\Contracts\IRole;
use App\Validators\RoleValidation;
/**
 * The Role controller will be used to manipulate or view Role data
 */
class RoleController extends Controller
{
    /** @var App\Repositories\role */
    protected $role;
    /** @var App\Validators\RoleValidation */
    protected $roleValidation;

    public function __construct(IRole $role, RoleValidation $roleValidation) {
        $this->middleware('auth:api');
        $this->middleware('admin:Admin',['except' => ['index']]);
        $this->role = $role;
        $this->roleValidation = $roleValidation;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view()
    {
        return view('role.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->role->getAllRoles(), 200);
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
        $this->roleValidation->validateRole($request);
        $role = $this->role->create($request);
        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->role->getRole($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
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
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->roleValidation->validateRole($request);
        $role = $this->role->update($request, $id);
        return response()->json($role, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->destroy($id);
        return response()->json("Role is deleted", 204);
    }
}

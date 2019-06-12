<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Validators\UserValidation;
use App\Repositories\Contracts\IUser;

/**
 * The User controller will be used to manipulate or view User data
 */
class UserController extends Controller
{
    /** @var App\Validators\$userValidation */
    protected $userValidation;
    /** @var App\Repositories\Contracts\IUser */
    protected $user;

    public function __construct(UserValidation $userValidation, IUser $user){
        $this->middleware('auth:api');
        $this->middleware('admin:Admin',['except' => ['getAuthenticatedUser', 'index']]);

        $this->userValidation = $userValidation;
        $this->user = $user;
    }

    /**
     * Will be loading a test page to see how all methods work
     */
    public function view()
    {
        return view('user.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->user->getAllUsers(), 200);
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
        $this->userValidation->validateUser($request);
        $user = $this->user->create($request);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->user->getUser($id), 200);
    }

    /**
     * Display the authenticated User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAuthenticatedUser(){
        $userid = auth('api')->user()->Id;
        return response()->json($this->user->getUser($userid), 200);
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
        $this->userValidation->validateUser($request, $id);
        $user = $this->user->update($request, $id);
        return response()->json($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->destroy($id);
        return response()->json("User is deleted", 204);
    }
}

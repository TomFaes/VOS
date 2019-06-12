<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\ITypeAccount;
use App\Validators\TypeAccountValidation;

/**
 * The TypeAccount controller will be used to manipulate or view TypeAccount data
 */
class TypeAccountController extends Controller
{

     /** @var App\Repositories\TypeAccount */
     protected $typeAccount;
     /** @var App\Validators\TypeAccountValidation */
     protected $typeAccountValidation;

     public function __construct(ITypeAccount $typeAccount, TypeAccountValidation $typeAccountValidation)
     {
        $this->middleware('auth:api');
        $this->middleware('admin:Admin');
        $this->typeAccount = $typeAccount;
        $this->typeAccountValidation = $typeAccountValidation;
     }

     /**
     * Will be loading a test page to see how all methods work
     */
     public function view()
    {
        return view('typeAccount.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->typeAccount->getAllTypeAccounts(), 200);
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
        $this->typeAccountValidation->validateAccountType($request);
        $typeAccount = $this->typeAccount->create($request);
        return response()->json($typeAccount, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeAccount  $typeAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->typeAccount->getTypeAccount($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeAccount  $typeAccount
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
     * @param  \App\TypeAccount  $typeAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->typeAccountValidation->validateAccountType($request);
        $typeAccount = $this->typeAccount->update($request, $id);
        return response()->json($typeAccount, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeAccount  $typeAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->typeAccount->destroy($id);
        return response()->json("Account type is deleted", 204);
    }
}

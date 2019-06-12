<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\IOrganisation;
use App\Validators\OrganisationValidation;

/**
 * The Organisation controller will be used to manipulate or view Orgisation data
 */
class OrganisationController extends Controller
{
     /** @var App\Repositories\Organisation */
     protected $organisation;
     /** @var App\Validators\OrganisationValidation */
     protected $organisationValidation;

     public function __construct(IOrganisation $organisation, OrganisationValidation $organisationValidation)
     {
        $this->middleware('auth:api',['except'=>['index', 'show']]);
        $this->middleware('admin:Editor|Admin',['except' => ['index','show']]);

        $this->organisation = $organisation;
        $this->organisationValidation = $organisationValidation;
     }

    /**
     * Will be loading a test page to see how all methods work
     */
     public function view()
    {
        return view('organisation.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->organisation->getAllOrganisations(), 200);
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
        $this->organisationValidation->validateOrganisation($request);
        $organisation = $this->organisation->create($request);
        return response()->json($organisation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->organisation->getOrganisation($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organisation  $organisation
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
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->organisationValidation->validateOrganisation($request, $id);
        $organisation = $this->organisation->update($request, $id);
        return response()->json($organisation, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->organisation->destroy($id);
        return response()->json("Organisation is deleted", 204);
    }
}

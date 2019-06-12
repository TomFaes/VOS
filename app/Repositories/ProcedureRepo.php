<?php

namespace App\Repositories;

use App\Models\Procedure;
use App\Repositories\Contracts\IProcedure;
use Illuminate\Http\Request;

use App\Services\ImageHandler;

/**
 * Description of ProcedureType
 *
 */
class ProcedureRepo extends Repository implements IProcedure {

    /** @var App\Services\ImageHandler */
    protected $imageHandler;

    public function __construct()
    {
        $this->imageHandler = new ImageHandler();
    }

    public function getAllProcedures()
    {
        return Procedure::with(['role', 'procedureType'])->OrderBy('Code')->get();
    }

    public function getAllRoleProcedures($roleId = 3)
    {
        return Procedure::with(['role', 'procedureType'])->where('RoleId', $roleId)->OrderBy('Code')->get();
    }

    public function getProcedure($id)
    {
        $procedure =  Procedure::with(['role', 'procedureType', 'steps'])->find($id);
        return $procedure;
    }

    public function getProcedureFromType($typeId, $roleId = 3)
    {
        $procedure =  Procedure::with(['role', 'procedureType'])->where('RoleId', $roleId)->where('ProcedureTypeId', $typeId)->get();
        return $procedure;
    }

    protected function setProcedure(Procedure $procedure, $request)
    {
        $request->input('Code') != "" ? $procedure->Code = $request->input('Code') : "";
        $request->input('Title') != "" ? $procedure->Title = $request->input('Title') : "";
        $request->input('Description') != "" ? $procedure->Description = $request->input('Description') : "";
        $request->input('Heading') != "" ? $procedure->Heading = $request->input('Heading') : "";
        $request->input('ProcedureTypeId') != "" ? $procedure->ProcedureTypeId = $request->input('ProcedureTypeId') : "";
        $request->input('RoleId') != "" ? $procedure->RoleId = $request->input('RoleId') : "";
        return $procedure;
    }

    public function create(Request $request)
    {
        $procedure = new Procedure();
        $procedure = $this->setProcedure($procedure, $request);

        if($request->file('Image') != "")
        {
            $procedure->Image = $this->imageHandler->upload('procedure', $request->file('Image'));
        }else{
            $procedure->Image = "noImage.jpg";
        }
        $procedure->save();
        return $procedure;
    }

    public function update(Request $request, $id)
    {
        $procedure = $this->getProcedure($id);
        $procedure = $this->setProcedure($procedure, $request);
        if($request->file('Image') != ""){
            $oldfile = "";
            if($procedure->Image != 'noImage.jpg'){
                $oldfile = $request->file('Image');
            }
            $procedure->Image = $this->imageHandler->upload('procedure', $request->file('Image'), $oldfile);
        }
        $procedure->save();
        return $procedure;
    }

    public function destroy($id)
    {
        $procedure = $this->getProcedure($id);
        if($procedure->Image != 'noImage.jpg'){
            $this->imageHandler->delete('procedure', $procedure->Image);
        }
        $procedure->delete();
    }

}

<?php

namespace App\Repositories;

use App\Models\ProcedureType;
use App\Repositories\Contracts\IProcedureType;
use Illuminate\Http\Request;

use App\Services\ImageHandler;

/**
 * Description of ProcedureType
 *
 */
class ProcedureTypeRepo extends Repository implements IProcedureType {

    /** @var App\Services\ImageHandler */
    protected $imageHandler;

    public function __construct()
    {
        $this->imageHandler = new ImageHandler();
    }


    public function getAllProcedureTypes()
    {
        return ProcedureType::OrderBy('Name')->get();
    }

    public function getProcedureType($id)
    {
        $type =  ProcedureType::find($id);
        return $type;
    }

    protected function setType(ProcedureType $type, $request)
    {
        $request->input('Name') != "" ? $type->Name = $request->input('Name') : "";
        return $type;
    }

    public function create(Request $request)
    {
        $type = new ProcedureType();
        $type = $this->setType($type, $request);

        if($request->file('Image') != "")
        {
            $type->Image = $this->imageHandler->upload('procedure-types', $request->file('Image'));
        }else{
            $type->Image = "noImage.jpg";
        }
        $type->save();
        return $type;
    }

    public function update(Request $request, $id)
    {
        $type = $this->getProcedureType($id);
        $type = $this->setType($type, $request);
        if($request->file('Image') != ""){
            $oldfile = "";
            if($type->Image != 'noImage.jpg'){
                $oldfile = $request->file('Image');
            }
            $type->Image = $this->imageHandler->upload('procedure-types', $request->file('Image'), $oldfile);
        }
        $type->save();
        return $type;
    }

    public function destroy($id)
    {
        $type = $this->getProcedureType($id);
        if($type->Image != 'noImage.jpg'){
            $this->imageHandler->delete('procedure-types', $type->Image);
        }
        $type->delete();
    }

}

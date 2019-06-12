<?php

namespace App\Repositories;

use App\Models\Step;
use App\Repositories\Contracts\IStep;
use Illuminate\Http\Request;

/**
 * Description of Step
 *
 */
class StepRepo extends Repository implements IStep {

    public function getAllSteps()
    {
        return Step::with(['contactSms', 'contactPhone', 'procedure'])->OrderBy('ProcedureId')->OrderBy('Order')->get();
    }

    public function getAllRoleSteps($roleId = 3){
         $steps =Step::with(['contactSms', 'contactPhone', 'procedure'])->whereHas('procedure', function($query) use($roleId) {
            $query->where('RoleId', $roleId);
        })->get();
        return $steps;
    }

    public function getStep($id)
    {
        $step =  Step::with(['contactSms', 'contactPhone','procedure', 'steplist'])->find($id);
        return $step;
    }

    public function getStepsFromProcedure($procedureId)
    {
        $step =  Step::with(['contactSms', 'contactPhone','procedure', 'steplist'])->where('ProcedureId', $procedureId)->OrderBy('Order')->get();
        return $step;
    }

    protected function CalculateHighestOrderNumber($procedureId){
        $step = Step::where('ProcedureId', $procedureId)->OrderBY('Order', 'desc')->first();
        if($step == null){
            return 1;
        }
        return ($step->Order + 1);
    }

    protected function setStep(Step $step, $request)
    {
        $request->input('Type') != "" ? $step->Type = $request->input('Type') : "";
        $request->input('Title') != "" ? $step->Title = $request->input('Title') : "";
        $request->input('ContactIdSms') != "" ? $step->ContactIdSms = $request->input('ContactIdSms') : "";
        $request->input('ContactIdPhoneNumber') != "" ? $step->ContactIdPhoneNumber = $request->input('ContactIdPhoneNumber') : "";

        if($request->input('ProcedureId') != ""){
            $step->ProcedureId = $request->input('ProcedureId');
        }
        return $step;
    }

    public function create(Request $request)
    {
        $step = new Step();
        $step = $this->setStep($step, $request);
        $step->Order = $this->CalculateHighestOrderNumber($step->ProcedureId);
        $step->save();
        return $step;
    }

    public function update(Request $request, $id)
    {
        $step = $this->getStep($id);
        $step = $this->setStep($step, $request);
        $step->save();
        return $step;
    }

    public function destroy($id)
    {
        $step = $this->getStep($id);
        $step->delete();
        return "Step is deleted";
    }

    /**
     * Get the previous item in the list.
     */
    protected function getPreviousListItem($procedureId, $order){
        $order -= 1;
        $step = Step::where('ProcedureId', $procedureId)->where('Order', $order)->OrderBY('Order', 'desc')->first();
        if($step != ""){
            return $step;
        }else{
            if($order > 1){
                return $this->getPreviousListItem($procedureId, $order);
            }
            return false;
        }
    }
    /**
     * Move an item one place up in the list
     */
    public function moveItemUpInList($id){
        $step = $this->getStep($id);
        $previousListItem = $this->getPreviousListItem($step->ProcedureId, $step->Order);

        if($previousListItem != false){
            $order = $previousListItem->Order;
            $step->Order = $order;
            $step->save();
            $previousListItem->Order = $order + 1;
            $previousListItem->save();
            return $step;
        }
        return "Er is geen lagere waarde";
    }
    /**
     * Get the next item in the list.
     */
    protected function getNextListItem($procedureId, $order){
        $highestOrder = $this->CalculateHighestOrderNumber($procedureId);
        $order += 1;
        $step = Step::where('ProcedureId', $procedureId)->where('Order', $order)->OrderBY('Order', 'desc')->first();

        if($step != ""){
            return $step;
        }else{
            if($order <= $highestOrder){
                return $this->getNextListItem($procedureId, $order);
            }
            return false;
        }
    }
    /**
     * Move an item one place down in the list
     */
    public function moveItemDownInList($id){
        $step = $this->getStep($id);
        $nextListItem = $this->getNextListItem($step->ProcedureId, $step->Order);
        $order = $step->Order;

        if($nextListItem != false){
            $step->Order = $step->Order + 1;
            $step->save();
            $nextListItem->Order = $order;
            $nextListItem->save();
            return $step;
        }
        return "Er is geen hogere waarde";
    }
}

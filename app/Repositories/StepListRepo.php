<?php

namespace App\Repositories;

use App\Repositories\Contracts\IStepList;
use Illuminate\Http\Request;
use App\Models\StepList;

/**
 * Description of Step
 *
 */
class StepListRepo extends Repository implements IStepList {

    public function getAllStepLists()
    {
        return StepList::with(['step'])->OrderBy('StepId')->OrderBy('Order')->get();
    }

    public function getStepList($id)
    {
        $steplist =  StepList::with(['step'])->find($id);
        return $steplist;
    }

    protected function CalculateHighestOrderNumber($stepId){
        $steplist = StepList::where('StepId', $stepId)->OrderBY('Order', 'desc')->first();
        if($steplist == null){
            return 1;
        }
        return ($steplist->Order + 1);
    }

    protected function setStepList(StepList $steplist, $request){
        $request->input('Title') != "" ? $steplist->Title = $request->input('Title') : "";
        if($request->input('StepId') != ""){
             $request->input('StepId') != "" ? $steplist->StepId = $request->input('StepId') : "";
        }
        return $steplist;
    }

    public function create(Request $request)
    {
        $steplist = new StepList();
        $steplist = $this->setStepList($steplist, $request);
        $steplist->Order = $this->CalculateHighestOrderNumber($steplist->StepId);
        $steplist->save();
        return $steplist;
    }

    public function update(Request $request, $id)
    {
        $steplist = $this->getStepList($id);
        $steplist = $this->setStepList($steplist, $request);
        $steplist->save();
        return $steplist;
    }

    public function destroy($id)
    {
        $steplist = $this->getStepList($id);
        $steplist->Order = 0;
        $steplist->save();
        $steplist->delete();
        return "Steplist is deleted";
    }

    /**
     * Get the previous item in the list.
     */
    protected function getPreviousListItem($stepId, $order){
        $order -= 1;
        $steplist = StepList::where('StepId', $stepId)->where('Order', $order)->OrderBY('Order', 'desc')->first();
        if($steplist != ""){
            return $steplist;
        }else{
            if($order > 1){

                return $this->getPreviousListItem($stepId, $order);
            }
            return false;
        }
    }
    /**
     * Move an item one place up in the list
     */
    public function moveItemUpInList($id){
        $steplist = $this->getStepList($id);
        $previousListItem = $this->getPreviousListItem($steplist->StepId, $steplist->Order);

        if($previousListItem != false){
            $order = $previousListItem->Order;
            $steplist->Order = $order;
            $steplist->save();
            $previousListItem->Order = $order + 1;
            $previousListItem->save();
            return $steplist;
        }
        return "Er is geen lagere waarde";
    }
    /**
     * Get the next item in the list.
     */
    protected function getNextListItem($stepId, $order){
        $highestOrder = $this->CalculateHighestOrderNumber($stepId);
        $order += 1;
        $steplist = StepList::where('StepId', $stepId)->where('Order', $order)->OrderBY('Order', 'desc')->first();

        if($steplist != ""){
            return $steplist;
        }else{
            if($order <= $highestOrder){
                return $this->getNextListItem($stepId, $order);
            }
            return false;
        }
    }
    /**
     * Move an item one place down in the list
     */
    public function moveItemDownInList($id){
        $steplist = $this->getStepList($id);
        $nextListItem = $this->getNextListItem($steplist->StepId, $steplist->Order);
        $order = $steplist->Order;

        if($nextListItem != false){
            $steplist->Order = $steplist->Order + 1;
            $steplist->save();
            $nextListItem->Order = $order;
            $nextListItem->save();
            return $steplist;
        }
        return "Er is geen hogere waarde";
    }
}

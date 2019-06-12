<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Contracts\IPosition;
use Illuminate\Http\Request;

/**
 * Description of Function
 *
 */
class PositionRepo extends Repository implements IPosition {

    public function getAllPositions()
    {
        return Position::OrderBy('Name')->get();
    }

    public function getPosition($id)
    {
        $position =  Position::find($id);
        return $position;
    }

    protected function setPosition(Position $position, $request)
    {
        $request->input('Name') != "" ? $position->Name = $request->input('Name') : "";
        return $position;
    }

    public function create(Request $request)
    {
        $position = new Position();
        $position = $this->setPosition($position, $request);
        $position->save();
        return $position;
    }

    public function update(Request $request, $id)
    {
        $position = $this->getPosition($id);
        $position = $this->setPosition($position, $request);
        $position->save();
        return $position;
    }

    public function destroy($id)
    {
        $position = $this->getPosition($id);
        $position->delete();
        return "Position is deleted";
    }
}

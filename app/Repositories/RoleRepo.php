<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Contracts\IRole;
use Illuminate\Http\Request;

/**
 * Description of Role
 *
 */
class RoleRepo extends Repository implements IRole {

    public function getAllRoles()
    {
        return Role::OrderBy('Name')->get();
    }

    public function getRole($id)
    {
        $type =  Role::find($id);
        return $type;
    }

    protected function setRole(Role $role, $request)
    {
        $request->input('Name') != "" ? $role->Name = $request->input('Name') : "";
        $request->input('Title') != "" ? $role->Title = $request->input('Title') : "";
        return $role;
    }

    public function create(Request $request)
    {
        $role = new Role();
        $role = $this->setRole($role, $request);
        $role->save();
        return $role;
    }

    public function update(Request $request, $id)
    {
        $role = $this->getRole($id);
        $role = $this->setRole($role, $request);
        $role->save();
        return $role;
    }

    public function destroy($id)
    {
        $role = $this->getRole($id);
        $role->delete();
    }
}

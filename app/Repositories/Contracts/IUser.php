<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IUser {
    public function getAllUsers();
    public function getUser($id);
    public function existingUser($user);

    public function create(Request $request);
    public function createGoogleAccount($userdata);
    public function update(Request $request, $id);
    public function destroy($id);


}

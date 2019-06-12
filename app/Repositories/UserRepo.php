<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\IUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
/**
 * Description of UserRepo
 */
class UserRepo extends Repository implements IUser {

    public function getAllUsers(){
        return User::with(['role', 'typeAccount', 'Position'])->OrderBy('FirstName', 'ASC')->OrderBy('Name' , 'ASC')->get();
    }

    public function getUser($id){
        return User::with(['role', 'typeAccount', 'Position'])->OrderBy('FirstName', 'Name')->find($id);
    }

    protected function setUser(User $user, $request){
        $request->input('FirstName') != "" ? $user->FirstName = $request->input('FirstName') : "";
        $request->input('Name') != "" ? $user->Name = $request->input('Name') : "";
        $request->input('Email') != "" ? $user->Email = $request->input('Email') : "";
        $request->input('Mobile') != "" ? $user->Mobile = $request->input('Mobile') : "";
        $request->input('PhoneWork') != "" ? $user->PhoneWork = $request->input('PhoneWork') : "";
        $request->input('PhoneHome') != "" ? $user->PhoneHome = $request->input('PhoneHome') : "";
        $request->input('Street') != "" ? $user->Street = $request->input('Street') : "";
        $request->input('PostalCode') != "" ? $user->Postalcode = $request->input('PostalCode') : "";
        $request->input('City') != "" ? $user->City = $request->input('City') : "";
        return $user;
    }

    public function create(Request $request){
        $user = new User();
        $user = $this->setUser($user, $request);
        //give default role Gast
        if($request->input('RoleId') ==  ""){
            $user->RoleId = 3;
        }else{
            $user->RoleId = $request->input('RoleId');
        }
        //give default type account User
        if($request->input('TypeAccountId') ==  ""){
            $user->TypeAccountId = 2;
        }else{
            $user->TypeAccountId = $request->input('TypeAccountId');
        }
        //give default position
        if($request->input('PositionId') ==  ""){
            $user->PositionId = 4;
        }else{
            $user->PositionId = $request->input('PositionId');
        }

        if( $user->FirstName !=  "" AND $user->Name !=  ""){
            $user->UserName = $user->FirstName."".$user->Name;
        }

        if($request->input('password') != ""){
            $user->password = bcrypt($request->input('password'));
        }else{
          //generate random password
          $user->Password = Hash::make(str_random(16));
        }
        $user->save();
        return $user;
    }

    public function update( Request $request, $id){
        $user = $this->getUser($id);
        $user = $this->setUser($user, $request);
        $request->input('TypeAccountId') != "" ? $user->TypeAccountId = $request->input('TypeAccountId') : "";
        $request->input('RoleId') != "" ? $user->RoleId = $request->input('RoleId') : "";
        $request->input('PositionId') != "" ? $user->PositionId = $request->input('PositionId') : "";

        if( $user->FirstName !=  "" AND $user->Name !=  ""){
            $user->UserName = $user->FirstName."".$user->Name;
        }
        $user->save();
        return $user;
    }

    public function destroy($id){
        $user = $this->getUser($id);
        $user->delete();
        return "User is deleted";
    }

    public function createGoogleAccount($userdata){
        $user = new User();
        $user->FirstName = $userdata['given_name'];
        $user->Name = $userdata['family_name'];
        $user->UserName = $user->FirstName."".$user->Name;
        $user->GoogleId = $userdata['id'];
        $user->Email = $userdata['email'];
        $user->Password = Hash::make(str_random(16));
        $user->RoleId = 2;
        $user->PositionId = 4;
        $user->TypeAccountId = 2;
        $user->save();
        return $user;
    }

    //check if User already exists. set google id
    public function existingUser($user){
        $userdata = User::where('email',$user['email'])->first();
        if($userdata) {
            if($userdata->GoogleId == ""){
                $userdata->GoogleId = $user['id'];
                $userdata->save();
            }
        }
        return $userdata;
    }




}

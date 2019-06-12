<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IUser;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * This controller will be used to handle the google authentication.
 *
 * Because this program is hosted on 000webhost we have to config the
 * parameters in the config directory in the service file.
 */
class AuthGoogleController extends Controller
{
    /** @var App\Repositories\Contracts\IUser */
    protected $user;

    public function __construct(IUser $user){
        $this->user = $user;
    }

    /**
     * Creates the link needed to go to the google login page
     */
    public function redirect()
    {
        $loginPage = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json(['ProviderLoginPage' => $loginPage], 200);
    }

    /**
     * When logged in through the google login page, the callback function
     * is activated. A check is done to see if the user excist in the database and
     * a token is sent back. If the user is unknown a user is created
     */
    public function callback()
    {
        try {
            //get google user info
            $googleUser = Socialite::driver('google')->stateless()->user();

            //if user exist login else create user and login
            $existUser = $this->user->existingUser($googleUser->user);
            if($existUser) {
                Auth::loginUsingId($existUser->Id);
            }
            else {
                $user = $this->user->createGoogleAccount($googleUser->user);
                Auth::loginUsingId($user->Id);
            }

            $token = Auth::user()->createToken('VosLoginApi')->accessToken;
            return response()->json(['token' => $token], 200);
        }
        catch (Exception $e) {
            return 'error';
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::guest()){
            return view('auth.login');
        }
        return redirect()->route('home');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userGoogle = Socialite::driver('google')->user();
        //dd($userGoogle);
        if(!isset($userGoogle->user['domain'])){
            return redirect()->route('index')->withErrors([
                'message' => '⚠ La cuenta no pertenece a CAFASUR'
            ]);
        }

        if($userGoogle->user['domain'] != 'cafasur.com.co'){
            return redirect()->route('index')->withErrors([
                'message' => '⚠ La cuenta no pertenece a CAFASUR'
            ]);
        }

        $user = User::where([
            ['email', '=', $userGoogle->email],
        ])->first();

        if($user != null){
            if($user->id_account_google == null){
                $user->id_account_google = $userGoogle->id;
                $user->avatar = $userGoogle->avatar;
                $user->first_name = $userGoogle->user['name']['givenName'];
                $user->last_name = $userGoogle->user['name']['familyName'];
                try{
                    $user->saveOrFail();
                }catch (Exception  $e){
                    Log::error($e->getMessage());
                    return redirect()->route('index')->withErrors([
                        'message' => '⚠ lo sentimos estamos presentado problemas, intenta más tarde'
                    ]);
                }
            }
             auth()->login($user);
             return redirect()->
             route('home');
        }else{
            return redirect()->route('index')->withErrors([
                'message' => '⚠ La cuenta no esta registrada'
            ]);
        }
    }
}

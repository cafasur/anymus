<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index(){
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());

        return view('apps.profile', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request){

        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string'
        ]);

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        try{
            $user->save();
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('index')->withErrors([
                'status' => 'danger',
                'message' => 'lo sentimos estamos presentado problemas al guardar los cambios, intenta más tarde'
            ]);
        }

        return redirect()->route('profile')->with([
            'status' => 'success',
            'message' => 'Cambios guardados'
        ]);
    }
}

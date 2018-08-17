<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUser;
use App\Unit;
use App\User;
use App\UserState;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('apps.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all();
        $userStatus = UserState::all();
        return view('apps.users.create',[
            'units' => $units,
            'userStatus' => $userStatus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $rules = Collection::make([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'unit' => 'required|numeric|exists:units,id',
            'status' => 'required|numeric|exists:user_status,id',
        ]);

        if(!empty($request->input('password'))){
            $rules->put('password', 'required|confirmed|max:191');
        }

        $this->validate($request, $rules->toArray());

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->unit_id = $request->input('unit');
        $user->status_id = $request->input('status');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }

        try {
            $user->saveOrFail();
            return redirect()->route('users.create')->with([
                'status' => 'success',
                'message' => 'Usuario creado correctamente'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('users.create')->with([
                'status' => 'danger',
                'message' => 'Error al intentar crear el usuario'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $units = Unit::where('id', '<>', $user->unit_id)->get();
        $userStatus = UserState::where('id', '<>', $user->status_id)->get();
        return view('apps.users.edit',[
            'user' => $user,
            'units' => $units,
            'userStatus' => $userStatus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EditUser $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(EditUser $request, User $user)
    {
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->unit_id = $request->input('unit');
        $user->status_id = $request->input('status');

        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }

        try{
            $user->saveOrFail();
            return redirect()->route('users.edit', $user->id)->with([
                'status' => 'success',
                'message' => 'Los datos se guardaron correctamente'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('users.edit', $user->id)->with([
                'status' => 'danger',
                'message' => 'Error al intentar guardar los cambios'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

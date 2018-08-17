<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('apps.roles.index',[
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apps.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string|max:191'
        ]);
        try{
            Role::create(['name' => $request->input('name')]);
            return redirect()->route('roles.create')->with([
                'status' => 'success',
                'message' => 'Rol creado correctamente'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('roles.create')->with([
                'status' => 'danger',
                'message' => 'Error al intentar crear el rol'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Role::findById($id);
        if($rol === null){
            return response('No se encontro el rol',404);
        }
        return view('apps.roles.edit',[
            'rol' => $rol
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol = Role::findById($id);
        if($rol === null){
            return response('No se encontro el rol',404);
        }
        $this->validate($request, [
           'name' => 'required|string|max:191'
        ]);

        $rol->name = $request->input('name');

        try{
            $rol->saveOrFail();
            return redirect()->route('roles.edit', $rol->id)->with([
                'status' => 'success',
                'message' => 'Los datos se guardaron correctamente'
            ]);
        }catch (\Exception $e){
            Log::error($e);
            return redirect()->route('roles.edit', $rol->id)->with([
                'status' => 'danger',
                'message' => 'Error al intentar guardar los cambios'
            ]);
        }
    }

    /**
     * Shows the form for assigning roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign_role(){
        $users = User::all();
        $users->load('status');
        $users->load('roles');
        $roles = Role::all();
        return view('apps.roles.assign_role', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * Save the role assigned to the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function save_assign_role(Request $request){
        $this->validate($request, [
           'idUser' => 'required|numeric|exists:users,id',
           'rol' => 'required|string|max:191|exists:roles,name'
        ]);
        $user = User::find($request->input('idUser'));
        try{
            $user->assignRole($request->input('rol'));
            return response()->json([
                'message' => 'Rol asignado correctamente'
            ], 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Error al intentar asignar el rol'
            ],500);
        }

    }

    /**
     * Change role to the user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function change_role(Request $request){
        $this->validate($request, [
            'idUser' => 'required|numeric|exists:users,id',
            'rol' => 'required|string|max:191|exists:roles,name'
        ]);
        $user = User::find($request->input('idUser'));
        $roleCurrent = $user->getRoleNames();
        try{
            $user->removeRole($roleCurrent->first());
            $user->assignRole($request->input('rol'));
            return response()->json([
                'message' => 'Rol cambiado correctamente'
            ], 200);
        }catch (\Exception $e){
            Log::error($e);
            return response()->json([
                'message' => 'Error al intentar cambiar de rol'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}

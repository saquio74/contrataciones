<?php

namespace App\Http\Controllers;
use App\permission;
use Illuminate\Http\Request;
use DB;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permission::all();
        return response()->json($permissions,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'permissions_id' => 'required',
            'roles_id'       => 'required'
        ]);
        DB::table('permissionsrole')->insert([
            'permissions_id'=> $request->permissions_id,
            'roles_id'=> $request->roles_id,
        ]);

        return response()->json(['ingresado correctamente'],204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRolPermissions($id)
    {
        $permisos = DB::table('permissions')
                        ->join('permissionsrole','permissionsrole.permissions_id','=','permissions.id')
                        ->where('permissionsrole.roles_id','=',$id)
                        ->get();
        return response()->json($permisos,200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

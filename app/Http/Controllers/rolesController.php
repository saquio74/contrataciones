<?php

namespace App\Http\Controllers;
use App\rol;
use Illuminate\Http\Request;
use DB;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = rol::all();
        return response()->json($roles,200); 
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $datos)
    {
        $this->validate($datos,[
            'name'          => 'required',
            'description'   => 'required'
        ]);
        rol::create($datos->all());

        return response()->json(['creado correcamente'],204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = rol::find($id);
        return response()->json($rol, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRolesUser($id){
        $roles = DB::table('roles')
                    ->join('permissionsrole','permissionsrole.roles_id','roles.id')
                    ->join('permissions','permissions.id','permissionsrole.permissions_id')
                    ->where('roles.id','=',$id)
                    ->get();
    }
    public function edit($id)
    {
        //
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

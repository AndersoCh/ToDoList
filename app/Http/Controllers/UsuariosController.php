<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; 

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();

        return response()->json($usuarios);
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
        $request->validate([
            'item.nombre' => 'required|string|max:255',
            'item.email' => 'required|email|unique:users,email',
            'item.password' => 'required|string|min:6',
        ]);

        $newUser = new Usuario; // Cambiar Nota a User
        $newUser->nombre = $request->item['nombre'];
        $newUser->email = $request->item['email'];
        $newUser->password = bcrypt($request->item['password']); // Asegúrate de encriptar la contraseña

        $newUser->save();

        return response()->json($newUser, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user = Usuario::find($id);
        if ($user) {
            return response()->json($user, 200);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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
         // Validar la solicitud
         $request->validate([
            'item.nombre' => 'sometimes|required|string|max:255',
            'item.email' => 'sometimes|required|email|unique:users,email,' . $id,
            'item.password' => 'sometimes|required|string|min:6',
        ]);

        $user = Usuario::find($id);
        if ($user) {
            // Actualizar solo los campos presentes en la solicitud
            $user->nombre = $request->item['nombre'] ?? $user->nombre;
            $user->email = $request->item['email'] ?? $user->email;
            if ($request->item['password'] ?? false) {
                $user->password = bcrypt($request->item['password']); // Asegúrate de encriptar la contraseña
            }

            $user->save();

            return response()->json($user, 200);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Usuario::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado con éxito'], 200);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    
    }
}

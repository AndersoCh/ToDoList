<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        
        $this->middleware('auth:api'); 
    }
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'fecha_creacion');
        $sortOrder = $request->get('sort_order', 'asc');

        if (!in_array($sortBy, ['fecha_creacion', 'fecha_vencimiento'])) {
            $sortBy = 'fecha_creacion';  // Valor predeterminado si el parámetro no es válido
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';  // Valor predeterminado si el parámetro no es válido
        }

        $notes = Nota::orderBy($sortBy, $sortOrder)->get();

        // Devolver las notas en formato JSON
        return response()->json($notes);

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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_creacion' => 'required|date',
            'fecha_vencimiento' => 'nullable|date',
            'usuario_id' => 'required|exists:users,id',
            'completed' => 'boolean',
        ]);
    
        $newNota = new Nota();
        $newNota->titulo = $request->titulo; // Cambiado aquí
        $newNota->descripcion = $request->descripcion; // Cambiado aquí
        $newNota->fecha_creacion = $request->fecha_creacion; // Cambiado aquí
        $newNota->fecha_vencimiento = $request->fecha_vencimiento ?? null;
        $newNota->usuario_id = $request->usuario_id; // Cambiado aquí
        $newNota->completed = $request->completed ?? false;
    
        $newNota->save();
    
        return response()->json($newNota, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = Nota::find($id);
        if ($nota) {
            return response()->json($nota, 200); // HTTP 200 OK
        }
        return response()->json(['message' => 'Nota no encontrada'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'fecha_creacion' => 'sometimes|required|date',
            'fecha_vencimiento' => 'nullable|date',
            'usuario_id' => 'sometimes|required|exists:users,id',
            'completed' => 'sometimes|boolean',
        ]);
    
        $existingNote = Nota::find($id);
        if ($existingNote) {
            $existingNote->titulo = $request->titulo ?? $existingNote->titulo;
            $existingNote->descripcion = $request->descripcion ?? $existingNote->descripcion;
            $existingNote->fecha_creacion = $request->fecha_creacion ?? $existingNote->fecha_creacion;
            $existingNote->fecha_vencimiento = $request->fecha_vencimiento ?? $existingNote->fecha_vencimiento;
            $existingNote->usuario_id = $request->usuario_id ?? $existingNote->usuario_id;
            $existingNote->completed = $request->completed ?? $existingNote->completed;
    
            $existingNote->save();
    
            return response()->json($existingNote, 200);
        }
        return response()->json(['message' => 'Nota no encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nota = Nota::find($id);
        if ($nota) {
            $nota->delete();
            return response()->json(['message' => 'Nota eliminada con éxito'], 200); // HTTP 200 OK
        }
        return response()->json(['message' => 'Nota no encontrada'], 404);
    }
}

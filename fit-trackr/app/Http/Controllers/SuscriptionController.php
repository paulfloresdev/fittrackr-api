<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suscription;

class SuscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suscriptions = Suscription::all();

        if($suscriptions->isEmpty()){
            return response()->json([
                'message' => 'No se encontraron los recursos solicitados.',
            ], 404);
        }

        return response()->json([
            'message' => 'Consulta realizada exitosamente.',
            'data' => $suscriptions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:256',
            'monthly_price' => 'required|numeric',
            'annual_price' => 'required|numeric',
        ]);

        $suscription = Suscription::create([
            'name' => $request->name,
            'description' => $request->description,
            'monthly_price' => $request->monthly_price,
            'annual_price' => $request->annual_price,
        ]);

        return response()->json([
            'message' => 'Recurso almacenado exitosamente.',
            'data' => $suscription
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suscription = Suscription::find($id);

        if($suscription == null){
            return response()->json([
                'message' => 'No se encontró el recurso solicitado.',
            ], 404);
        }

        return response()->json([
            'message' => 'Consulta realizada exitosamente.',
            'data' => $suscription
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:1|max:64',
            'description' => 'required|string|min:1|max:256',
            'monthly_price' => 'required|numeric',
            'annual_price' => 'required|numeric',
        ]);

        $suscription = Suscription::find($id);

        if($suscription == null){
            return response()->json([
                'message' => 'No se encontró el recurso solicitado.',
            ], 404);
        }

        $suscription->update([
            'name' => $request->name,
            'description' => $request->description,
            'monthly_price' => $request->monthly_price,
            'annual_price' => $request->annual_price,
        ]);

        return response()->json([
            'message' => 'Recurso actualizado exitosamente.',
            'data' => $suscription
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suscription = Suscription::find($id);

        if($suscription == null){
            return response()->json([
                'message' => 'No se encontró el recurso solicitado.',
            ], 404);
        }

        $suscription->delete();

        return response()->json([
            'message' => 'Recurso eliminado exitosamente.'
        ], 200);
    }
}

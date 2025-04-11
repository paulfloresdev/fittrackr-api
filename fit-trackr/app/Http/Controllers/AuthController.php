<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    // 🔹 REGISTRAR USUARIO
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:48',
            'lastname1' => 'required|string|max:32',
            'lastname2' => 'required|string|max:32',
            'phone' => 'required|string|size:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'lastname1' => $request->lastname1,
            'lastname2' => $request->lastname2,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        $user->load('role');

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente.',
            'data' => [
                'token' => $token,
                'user' => $user
            ], 
        ], 201);
    }

    // 🔹 INICIAR SESIÓN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->with('role')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Correo y/o contraseña incorrectos.',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario logueado exitosamente.',
            'data' => [
                'token' => $token,
                'user' => $user
            ], 
        ], 200);
    }

    // 🔹 ACTUALIZAR DATOS DE USUARIO
    public function updateData(Request $request, string $id){
        $request->validate([
            'name' => 'required|string|max:48',
            'lastname1' => 'required|string|max:32',
            'lastname2' => 'required|string|max:32',
            'phone' => 'required|string|size:10',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = User::with('role')->find($id);

        if($user == null){
            return response()->json([
                'message' => 'Usuario no encontrado.'
            ],404);
        }

        $user->name = $request->name;
        $user->lastname1 = $request->lastname1;
        $user->lastname2 = $request->lastname2;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        return response()->json([
            'message' => 'Datos de usuario actualizados correctamente.',
            'data' => $user
        ],200);
    }

    // 🔹 ACTUALIZAR CONTRASEÑA
    public function updatePassword(Request $request, string $id){
        $request->validate([
            'password' => 'required|string|min:8'
        ]);

        $user = User::with('role')->find($id);

        if($user == null){
            return response()->json([
                'message' => 'Usuario no encontrado.'
            ],404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Contraseña de usuario actualizada correctamente.',
            'data' => $user
        ],200);
    }

    // 🔹 CERRAR SESIÓN
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada exitosamente.'],200);
    }

    // 🔹 OBTENER USUARIO AUTENTICADO
    public function me(Request $request)
    {
        return response()->json($request->user(),200);
    }
}
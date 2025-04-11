<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;


class VerificationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */

    public function sendMail(){

    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);
        
        $verification = Verification::where('user_id', $request->user_id)->first();
        $code = rand(100000, 999999); 
        
        Mail::to('paulflores.dev@gmail.com')->send(new VerificationMail($code));

        if($verification == null){
            Verification::create([
                'code' => $code,
                'user_id' => $request->user_id
            ]);
        }

        $verification->update([
            'code' => $code
        ]);

        return response()->json([
            'message' => 'Código de verificación generado exitosamente.'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function validate(Request $request)
    {
        $validated = $request->validate([
            'code'  => 'required|string|size:6',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $verification = Verification::where('code', $request->code)->where('user_id', $request->user_id)->first();

        if($verification == null){
            return response()->json([
                'message' => 'Código de verificación inválido.',
            ], 404);
        }

        $verification->delete();

        return response()->json([
            'message' => 'Código de verificación validado exitosamente.',
        ], 200);
    }

}

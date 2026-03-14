<?php

namespace App\Http\Controllers;

use App\Models\DelioUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DelioAuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="api/delio/login",
     *     operationId="loginDelioUser",
     *     tags={"Delio"},
     *     summary="Realiza login de um usuario Delio",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="ana.delio@example.com"),
     *             @OA\Property(property="password", type="string", example="secret123")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Login realizado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Login realizado com sucesso!"),
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Ana Souza"),
     *                 @OA\Property(property="email", type="string", example="ana.delio@example.com")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais invalidas",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Credenciais invalidas.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validacao"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = DelioUser::where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Credenciais invalidas.',
            ], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'user' => $user,
        ], 200);
    }
}

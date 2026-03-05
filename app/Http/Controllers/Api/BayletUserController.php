<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BayletUser;

class BayletUserController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/baylet/users",
     *     operationId="getBayletUsers",
     *     tags={"Baylet"},
     *     summary="Lista todos os usuários com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="users", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Ana Souza"),
     *                     @OA\Property(property="email", type="string", example="ana@example.com"),
     *                     @OA\Property(property="role", type="string", example="ADMIN"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=10),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=1)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $users = BayletUser::paginate(10);

        return response()->json([
            'users' => $users->items(),
            'current_page' => $users->currentPage(),
            'total' => $users->total(),
            'per_page' => $users->perPage(),
            'last_page' => $users->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/baylet/users/{id}",
     *     operationId="getBayletUser",
     *     tags={"Baylet"},
     *     summary="Busca um usuário pelo ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do usuário",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Usuário encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Ana Souza"),
     *                 @OA\Property(property="email", type="string", example="ana@example.com"),
     *                 @OA\Property(property="role", type="string", example="ADMIN")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $user = BayletUser::find($id);
        if (! $user) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'user' => $user,
        ], 200);
    }
}

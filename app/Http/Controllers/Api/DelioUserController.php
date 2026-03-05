<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DelioUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DelioUserController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Delio",
        *     description="Gerenciamento de usuários"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/delio/users",
     *     operationId="getDelioUsers",
     *     tags={"Delio"},
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
     *                     @OA\Property(property="name", type="string", example="Lucas Pereira"),
     *                     @OA\Property(property="email", type="string", example="lucas.delio@example.com"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=15),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=2)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $users = DelioUser::paginate(10);

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
     *     path="api/delio/users/{id}",
     *     operationId="getDelioUser",
     *     tags={"Delio"},
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
     *                 @OA\Property(property="name", type="string", example="Lucas Pereira"),
     *                 @OA\Property(property="email", type="string", example="lucas.delio@example.com"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z")
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
        $user = DelioUser::find($id);

        if (! $user) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'user' => $user,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/delio/users",
     *     operationId="createDelioUser",
     *     tags={"Delio"},
    *     summary="Cria um novo usuário",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="Ana Souza"),
     *             @OA\Property(property="email", type="string", example="ana.delio@example.com"),
     *             @OA\Property(property="password", type="string", example="password")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Usuário criado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Ana Souza"),
     *                 @OA\Property(property="email", type="string", example="ana.delio@example.com")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:delio_users,email',
            'password' => 'required|string|min:6|max:255',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = DelioUser::create($data);

        return response()->json([
            'user' => $user,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/delio/users/{id}",
     *     operationId="updateDelioUser",
     *     tags={"Delio"},
    *     summary="Atualiza um usuário",
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
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Ana Souza Santos"),
     *             @OA\Property(property="email", type="string", example="ana.santos.delio@example.com"),
     *             @OA\Property(property="password", type="string", example="newpassword")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Usuário atualizado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Ana Souza Santos"),
     *                 @OA\Property(property="email", type="string", example="ana.santos.delio@example.com")
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
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $user = DelioUser::find($id);

        if (! $user) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('delio_users', 'email')->ignore($user->id),
            ],
            'password' => 'sometimes|string|min:6|max:255',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'user' => $user,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/delio/users/{id}",
     *     operationId="deleteDelioUser",
     *     tags={"Delio"},
    *     summary="Remove um usuário",
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
     *         description="Usuário deletado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
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
    public function destroy(int $id)
    {
        $user = DelioUser::find($id);

        if (! $user) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

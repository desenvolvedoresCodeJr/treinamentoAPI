<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RichardCharacterController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Richard",
     *     description="Gerenciamento de personagens"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/richard/characters",
     *     operationId="getRichardCharacters",
     *     tags={"Richard"},
     *     summary="Lista personagens com paginação",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de personagens",
     *         @OA\JsonContent(
     *             @OA\Property(property="characters", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Diluc"),
     *                     @OA\Property(property="element", type="string", example="Pyro"),
     *                     @OA\Property(property="region", type="string", example="Mondstadt"),
     *                     @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *                     @OA\Property(property="rarity", type="boolean", example=true),
     *                     @OA\Property(property="icon", type="string", example="https://example.com/diluc.png")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=20),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=2)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $characters = DB::table('richard_characters')->paginate(10);

        return response()->json([
            'characters' => $characters->items(),
            'current_page' => $characters->currentPage(),
            'total' => $characters->total(),
            'per_page' => $characters->perPage(),
            'last_page' => $characters->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/richard/characters/{id}",
     *     operationId="getRichardCharacter",
     *     tags={"Richard"},
     *     summary="Busca personagem por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Personagem encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="character", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Diluc"),
     *                 @OA\Property(property="element", type="string", example="Pyro"),
     *                 @OA\Property(property="region", type="string", example="Mondstadt"),
     *                 @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *                 @OA\Property(property="rarity", type="boolean", example=true),
     *                 @OA\Property(property="icon", type="string", example="https://example.com/diluc.png")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Personagem não encontrado",
     *         @OA\JsonContent(@OA\Property(property="error", type="string", example="not found!"))
     *     )
     * )
     */
    public function show(int $id)
    {
        $character = DB::table('richard_characters')->where('id', $id)->first();

        if (! $character) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'character' => $character,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/richard/characters",
     *     operationId="createRichardCharacter",
     *     tags={"Richard"},
     *     summary="Cria um personagem",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","element","region","weapon_type","rarity","icon"},
     *             @OA\Property(property="name", type="string", example="Diluc"),
     *             @OA\Property(property="element", type="string", example="Pyro"),
     *             @OA\Property(property="region", type="string", example="Mondstadt"),
     *             @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *             @OA\Property(property="rarity", type="boolean", example=true),
     *             @OA\Property(property="icon", type="string", example="https://example.com/diluc.png")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Personagem criado",
     *         @OA\JsonContent(
     *             @OA\Property(property="character", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Diluc")
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'element' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'weapon_type' => 'required|string|max:255',
            'rarity' => 'required|boolean',
            'icon' => 'required|string|max:255',
        ]);

        $id = DB::table('richard_characters')->insertGetId([
            ...$data,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $character = DB::table('richard_characters')->where('id', $id)->first();

        return response()->json([
            'character' => $character,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/richard/characters/{id}",
     *     operationId="updateRichardCharacter",
     *     tags={"Richard"},
     *     summary="Atualiza um personagem",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Diluc"),
     *             @OA\Property(property="element", type="string", example="Pyro"),
     *             @OA\Property(property="region", type="string", example="Mondstadt"),
     *             @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *             @OA\Property(property="rarity", type="boolean", example=true),
     *             @OA\Property(property="icon", type="string", example="https://example.com/diluc.png")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Personagem atualizado"),
     *     @OA\Response(response=404, description="Personagem não encontrado")
     * )
     */
    public function update(Request $request, int $id)
    {
        $character = DB::table('richard_characters')->where('id', $id)->first();

        if (! $character) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'element' => 'sometimes|string|max:255',
            'region' => 'sometimes|string|max:255',
            'weapon_type' => 'sometimes|string|max:255',
            'rarity' => 'sometimes|boolean',
            'icon' => 'sometimes|string|max:255',
        ]);

        DB::table('richard_characters')->where('id', $id)->update([
            ...$data,
            'updated_at' => now(),
        ]);

        $updated = DB::table('richard_characters')->where('id', $id)->first();

        return response()->json([
            'character' => $updated,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/richard/characters/{id}",
     *     operationId="deleteRichardCharacter",
     *     tags={"Richard"},
     *     summary="Remove um personagem",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Personagem deletado"),
     *     @OA\Response(response=404, description="Personagem não encontrado")
     * )
     */
    public function destroy(int $id)
    {
        $deleted = DB::table('richard_characters')->where('id', $id)->delete();

        if (! $deleted) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

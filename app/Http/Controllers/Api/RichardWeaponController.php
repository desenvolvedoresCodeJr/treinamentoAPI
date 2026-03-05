<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RichardWeaponController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/richard/weapons",
     *     operationId="getRichardWeapons",
     *     tags={"Richard"},
     *     summary="Lista armas com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de armas",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="weapons", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Wolf's Gravestone"),
     *                     @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *                     @OA\Property(property="weapon_bonus", type="string", example="ATK%"),
     *                     @OA\Property(property="rarity", type="boolean", example=true),
     *                     @OA\Property(property="icon", type="string", example="https://example.com/weapon.png")
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
        $weapons = DB::table('richard_weapons')->paginate(10);

        return response()->json([
            'weapons' => $weapons->items(),
            'current_page' => $weapons->currentPage(),
            'total' => $weapons->total(),
            'per_page' => $weapons->perPage(),
            'last_page' => $weapons->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/richard/weapons/{id}",
     *     operationId="getRichardWeapon",
     *     tags={"Richard"},
     *     summary="Busca arma por ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Arma encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="weapon", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Wolf's Gravestone"),
     *                 @OA\Property(property="weapon_type", type="string", example="Claymore"),
     *                 @OA\Property(property="weapon_bonus", type="string", example="ATK%"),
     *                 @OA\Property(property="rarity", type="boolean", example=true),
     *                 @OA\Property(property="icon", type="string", example="https://example.com/weapon.png")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Arma não encontrada",
     *
     *         @OA\JsonContent(@OA\Property(property="error", type="string", example="not found!"))
     *     )
     * )
     */
    public function show(int $id)
    {
        $weapon = DB::table('richard_weapons')->where('id', $id)->first();

        if (! $weapon) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'weapon' => $weapon,
        ], 200);
    }
}

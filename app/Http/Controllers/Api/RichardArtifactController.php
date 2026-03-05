<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RichardArtifactController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/richard/artifacts",
     *     operationId="getRichardArtifacts",
     *     tags={"Richard"},
     *     summary="Lista artefatos com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de artefatos",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="artifacts", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Crimson Witch of Flames"),
     *                     @OA\Property(property="set_bonus_2", type="string", example="Pyro DMG Bonus +15%"),
     *                     @OA\Property(property="set_bonus_4", type="string", example="Increases Overloaded and Burning DMG"),
     *                     @OA\Property(property="main_stats", type="string", example="ATK%, Pyro DMG, CRIT"),
     *                     @OA\Property(property="type", type="string", example="DPS"),
     *                     @OA\Property(property="icon", type="string", example="https://example.com/artifact.png")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=12),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=2)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $artifacts = DB::table('richard_artifacts')->paginate(10);

        return response()->json([
            'artifacts' => $artifacts->items(),
            'current_page' => $artifacts->currentPage(),
            'total' => $artifacts->total(),
            'per_page' => $artifacts->perPage(),
            'last_page' => $artifacts->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/richard/artifacts/{id}",
     *     operationId="getRichardArtifact",
     *     tags={"Richard"},
     *     summary="Busca artefato por ID",
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
     *         description="Artefato encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="artifact", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Crimson Witch of Flames"),
     *                 @OA\Property(property="set_bonus_2", type="string", example="Pyro DMG Bonus +15%"),
     *                 @OA\Property(property="set_bonus_4", type="string", example="Increases Overloaded and Burning DMG"),
     *                 @OA\Property(property="main_stats", type="string", example="ATK%, Pyro DMG, CRIT"),
     *                 @OA\Property(property="type", type="string", example="DPS"),
     *                 @OA\Property(property="icon", type="string", example="https://example.com/artifact.png")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Artefato não encontrado",
     *
     *         @OA\JsonContent(@OA\Property(property="error", type="string", example="not found!"))
     *     )
     * )
     */
    public function show(int $id)
    {
        $artifact = DB::table('richard_artifacts')->where('id', $id)->first();

        if (! $artifact) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'artifact' => $artifact,
        ], 200);
    }
}

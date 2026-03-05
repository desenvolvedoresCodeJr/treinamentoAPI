<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RichardBuildController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/richard/builds",
     *     operationId="getRichardBuilds",
     *     tags={"Richard"},
     *     summary="Lista builds com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de builds",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="builds", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="character_id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Build DPS Pyro"),
     *                     @OA\Property(property="banner_url", type="string", example="https://example.com/banner.png"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=8),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=1)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $builds = DB::table('richard_builds')->paginate(10);

        return response()->json([
            'builds' => $builds->items(),
            'current_page' => $builds->currentPage(),
            'total' => $builds->total(),
            'per_page' => $builds->perPage(),
            'last_page' => $builds->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/richard/builds/{id}",
     *     operationId="getRichardBuild",
     *     tags={"Richard"},
     *     summary="Busca build por ID",
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
     *         description="Build encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="build", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="character_id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Build DPS Pyro"),
     *                 @OA\Property(property="banner_url", type="string", example="https://example.com/banner.png")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Build não encontrada",
     *
     *         @OA\JsonContent(@OA\Property(property="error", type="string", example="not found!"))
     *     )
     * )
     */
    public function show(int $id)
    {
        $build = DB::table('richard_builds')->where('id', $id)->first();

        if (! $build) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'build' => $build,
        ], 200);
    }
}

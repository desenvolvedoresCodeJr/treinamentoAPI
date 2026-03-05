<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DelioRating;

class DelioRatingController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/delio/ratings",
     *     operationId="getDelioRatings",
     *     tags={"Delio"},
     *     summary="Lista todas as avaliações do Delio com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de avaliações com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="ratings", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="usuario_id", type="integer", example=3),
     *                     @OA\Property(property="album_id", type="integer", example=1),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.5),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=40),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=4)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $ratings = DelioRating::paginate(10);

        return response()->json([
            'ratings' => $ratings->items(),
            'current_page' => $ratings->currentPage(),
            'total' => $ratings->total(),
            'per_page' => $ratings->perPage(),
            'last_page' => $ratings->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/ratings/{id}",
     *     operationId="getDelioRating",
     *     tags={"Delio"},
     *     summary="Busca uma avaliação do Delio pelo ID",
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
     *         description="Avaliação encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="rating", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="usuario_id", type="integer", example=3),
     *                 @OA\Property(property="album_id", type="integer", example=1),
     *                 @OA\Property(property="nota", type="number", format="float", example=4.5)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Avaliação não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $rating = DelioRating::find($id);

        if (! $rating) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'rating' => $rating,
        ], 200);
    }
}

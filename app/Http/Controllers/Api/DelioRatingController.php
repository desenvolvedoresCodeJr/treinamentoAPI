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
     *     summary="Lista todas as avaliacoes com paginacao",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de avaliacoes com paginacao",
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
     *     summary="Busca uma avaliacao pelo ID",
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
     *         description="Avaliacao encontrada",
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
     *         description="Avaliacao nao encontrada",
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

    /**
     * @OA\Get(
     *     path="api/delio/ratings/album/{albumId}",
     *     operationId="getDelioRatingsByAlbum",
     *     tags={"Delio"},
     *     summary="Retorna as avaliacoes de um album",
     *
     *     @OA\Parameter(
     *         name="albumId",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Avaliacoes retornadas com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="ratings", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="usuario_id", type="integer", example=3),
     *                     @OA\Property(property="album_id", type="integer", example=1),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.5)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Avaliacoes retornadas com sucesso!")
     *         )
     *     )
     * )
     */
    public function getRatingsByAlbum(int $albumId)
    {
        $ratings = DelioRating::where('album_id', $albumId)->get();

        return response()->json([
            'ratings' => $ratings,
            'message' => $ratings->isEmpty()
                ? 'Nenhuma avaliacao encontrada para este album.'
                : 'Avaliacoes retornadas com sucesso!',
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/ratings/user/{userId}",
     *     operationId="getDelioRatingsByUser",
     *     tags={"Delio"},
     *     summary="Retorna as avaliacoes de um usuario",
     *
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Avaliacoes retornadas com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="ratings", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="usuario_id", type="integer", example=3),
     *                     @OA\Property(property="album_id", type="integer", example=1),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.5)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Avaliacoes retornadas com sucesso!")
     *         )
     *     )
     * )
     */
    public function getRatingsByUser(int $userId)
    {
        $ratings = DelioRating::where('usuario_id', $userId)->get();

        return response()->json([
            'ratings' => $ratings,
            'message' => $ratings->isEmpty()
                ? 'Nenhuma avaliacao encontrada para este usuario.'
                : 'Avaliacoes retornadas com sucesso!',
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/ratings/album/{albumId}/user/{userId}",
     *     operationId="getDelioRatingsByAlbumAndUser",
     *     tags={"Delio"},
     *     summary="Retorna as avaliacoes de um album feitas por um usuario",
     *
     *     @OA\Parameter(
     *         name="albumId",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Avaliacoes retornadas com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="ratings", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="usuario_id", type="integer", example=3),
     *                     @OA\Property(property="album_id", type="integer", example=1),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.5)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Avaliacoes retornadas com sucesso!")
     *         )
     *     )
     * )
     */
    public function getRatingsByAlbumAndUser(int $albumId, int $userId)
    {
        $ratings = DelioRating::query()
            ->where('album_id', $albumId)
            ->where('usuario_id', $userId)
            ->get();

        return response()->json([
            'ratings' => $ratings,
            'message' => $ratings->isEmpty()
                ? 'Nenhuma avaliacao encontrada para este album e usuario.'
                : 'Avaliacoes retornadas com sucesso!',
        ], 200);
    }
}

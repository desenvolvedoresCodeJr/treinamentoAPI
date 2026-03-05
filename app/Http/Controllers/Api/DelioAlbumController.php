<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DelioAlbum;

class DelioAlbumController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/delio/albums",
     *     operationId="getDelioAlbums",
     *     tags={"Delio"},
     *     summary="Lista todos os albums do Delio com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de albums com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="albums", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Thriller"),
     *                     @OA\Property(property="imagem", type="string", example="https://dummyimage.com/600x600/111827/f9fafb.png&text=Thriller"),
     *                     @OA\Property(property="artista", type="string", example="Michael Jackson"),
     *                     @OA\Property(property="genero", type="string", example="Pop"),
     *                     @OA\Property(property="duracao_em_segundos", type="integer", example=2580),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.9),
     *                     @OA\Property(property="is_in_carrossel", type="boolean", example=true)
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
        $albums = DelioAlbum::paginate(10);

        return response()->json([
            'albums' => $albums->items(),
            'current_page' => $albums->currentPage(),
            'total' => $albums->total(),
            'per_page' => $albums->perPage(),
            'last_page' => $albums->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/albums/{id}",
     *     operationId="getDelioAlbum",
     *     tags={"Delio"},
     *     summary="Busca um album do Delio pelo ID",
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
     *         description="Album encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="album", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Thriller"),
     *                 @OA\Property(property="imagem", type="string", example="https://dummyimage.com/600x600/111827/f9fafb.png&text=Thriller"),
     *                 @OA\Property(property="artista", type="string", example="Michael Jackson"),
     *                 @OA\Property(property="genero", type="string", example="Pop"),
     *                 @OA\Property(property="duracao_em_segundos", type="integer", example=2580),
     *                 @OA\Property(property="nota", type="number", format="float", example=4.9),
     *                 @OA\Property(property="is_in_carrossel", type="boolean", example=true)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Album não encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $album = DelioAlbum::find($id);

        if (! $album) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'album' => $album,
        ], 200);
    }
}

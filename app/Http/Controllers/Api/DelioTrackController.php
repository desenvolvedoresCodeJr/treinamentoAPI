<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DelioTrack;
use Illuminate\Http\Request;

class DelioTrackController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Delio",
        *     description="Gerenciamento de recursos"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/delio/tracks",
     *     operationId="getDelioTracks",
     *     tags={"Delio"},
     *     summary="Lista todas as tracks com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tracks com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="tracks", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="album_id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Billie Jean"),
     *                     @OA\Property(property="duracao_em_segundos", type="integer", example=294),
     *                     @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet."),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-03-05T10:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=24),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=3)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $tracks = DelioTrack::paginate(10);

        return response()->json([
            'tracks' => $tracks->items(),
            'current_page' => $tracks->currentPage(),
            'total' => $tracks->total(),
            'per_page' => $tracks->perPage(),
            'last_page' => $tracks->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/tracks/{id}",
     *     operationId="getDelioTrack",
     *     tags={"Delio"},
     *     summary="Busca uma track pelo ID",
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
     *         description="Track encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="track", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="album_id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Billie Jean"),
     *                 @OA\Property(property="duracao_em_segundos", type="integer", example=294),
     *                 @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet.")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Track não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $track = DelioTrack::find($id);

        if (! $track) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'track' => $track,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/delio/tracks",
     *     operationId="createDelioTrack",
     *     tags={"Delio"},
     *     summary="Cria uma nova track",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"album_id","titulo","duracao_em_segundos","letra"},
     *             @OA\Property(property="album_id", type="integer", example=1),
     *             @OA\Property(property="titulo", type="string", example="Beat It"),
     *             @OA\Property(property="duracao_em_segundos", type="integer", example=258),
     *             @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Track criada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="track", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="album_id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Beat It"),
     *                 @OA\Property(property="duracao_em_segundos", type="integer", example=258),
     *                 @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.")
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => 'required|integer|exists:delio_albums,id',
            'titulo' => 'required|string|max:255',
            'duracao_em_segundos' => 'required|integer|min:1',
            'letra' => 'required|string',
        ]);

        $track = DelioTrack::create($data);

        return response()->json([
            'track' => $track,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/delio/tracks/{id}",
     *     operationId="updateDelioTrack",
     *     tags={"Delio"},
     *     summary="Atualiza uma track",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="album_id", type="integer", example=1),
     *             @OA\Property(property="titulo", type="string", example="Billie Jean (Remastered)"),
     *             @OA\Property(property="duracao_em_segundos", type="integer", example=296),
     *             @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Track atualizada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="track", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="album_id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Billie Jean (Remastered)"),
     *                 @OA\Property(property="duracao_em_segundos", type="integer", example=296),
     *                 @OA\Property(property="letra", type="string", example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Track não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $track = DelioTrack::find($id);

        if (! $track) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'album_id' => 'sometimes|integer|exists:delio_albums,id',
            'titulo' => 'sometimes|string|max:255',
            'duracao_em_segundos' => 'sometimes|integer|min:1',
            'letra' => 'sometimes|string',
        ]);

        $track->update($data);

        return response()->json([
            'track' => $track,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/delio/tracks/{id}",
     *     operationId="deleteDelioTrack",
     *     tags={"Delio"},
     *     summary="Remove uma track",
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
     *         description="Track deletada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Track não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $track = DelioTrack::find($id);

        if (! $track) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $track->delete();

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

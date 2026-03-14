<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DelioAlbum;
use Illuminate\Http\Request;

class DelioAlbumController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/delio/albums",
     *     operationId="getDelioAlbums",
     *     tags={"Delio"},
     *     summary="Lista todos os albums com paginacao",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de albums com paginacao",
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
     *     summary="Busca um album pelo ID",
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
     *         description="Album nao encontrado",
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

    /**
     * @OA\Post(
     *     path="api/delio/albums",
     *     operationId="createDelioAlbum",
     *     tags={"Delio"},
     *     summary="Cria um novo album",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"titulo","imagem","artista","genero","duracao_em_segundos","nota","is_in_carrossel"},
     *             @OA\Property(property="titulo", type="string", example="Hybrid Theory"),
     *             @OA\Property(property="imagem", type="string", example="https://example.com/hybrid-theory.jpg"),
     *             @OA\Property(property="artista", type="string", example="Linkin Park"),
     *             @OA\Property(property="genero", type="string", example="Nu Metal"),
     *             @OA\Property(property="duracao_em_segundos", type="integer", example=2237),
     *             @OA\Property(property="nota", type="number", format="float", example=4.8),
     *             @OA\Property(property="is_in_carrossel", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Album criado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="album", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="titulo", type="string", example="Hybrid Theory"),
     *                 @OA\Property(property="imagem", type="string", example="https://example.com/hybrid-theory.jpg"),
     *                 @OA\Property(property="artista", type="string", example="Linkin Park"),
     *                 @OA\Property(property="genero", type="string", example="Nu Metal"),
     *                 @OA\Property(property="duracao_em_segundos", type="integer", example=2237),
     *                 @OA\Property(property="nota", type="number", format="float", example=4.8),
     *                 @OA\Property(property="is_in_carrossel", type="boolean", example=true)
     *             ),
     *             @OA\Property(property="message", type="string", example="Album criado com sucesso!")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validacao"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'imagem' => 'required|string|max:2048',
            'artista' => 'required|string|max:255',
            'genero' => 'required|string|max:255',
            'duracao_em_segundos' => 'required|integer|min:1',
            'nota' => 'required|numeric|min:0|max:5',
            'is_in_carrossel' => 'required|boolean',
        ]);

        $album = DelioAlbum::create($data);

        return response()->json([
            'album' => $album,
            'message' => 'Album criado com sucesso!',
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="api/delio/albums/latest",
     *     operationId="getLatestDelioAlbums",
     *     tags={"Delio"},
     *     summary="Retorna os albums mais recentes",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Albums mais recentes retornados com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="albums", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="New Album"),
     *                     @OA\Property(property="nota", type="number", format="float", example=4.7),
     *                     @OA\Property(property="is_in_carrossel", type="boolean", example=true)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Albums mais recentes retornados com sucesso!")
     *         )
     *     )
     * )
     */
    public function latest()
    {
        $albums = DelioAlbum::query()
            ->latest()
            ->get();

        return response()->json([
            'albums' => $albums,
            'message' => 'Albums mais recentes retornados com sucesso!',
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/albums/top-rated",
     *     operationId="getTopRatedDelioAlbums",
     *     tags={"Delio"},
     *     summary="Retorna os albums mais bem avaliados",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Albums mais bem avaliados retornados com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="albums", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Mid Album"),
     *                     @OA\Property(property="nota", type="number", format="float", example=5.0)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Albums mais bem avaliados retornados com sucesso!")
     *         )
     *     )
     * )
     */
    public function topRated()
    {
        $albums = DelioAlbum::query()
            ->orderByDesc('nota')
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'albums' => $albums,
            'message' => 'Albums mais bem avaliados retornados com sucesso!',
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/albums/carousel",
     *     operationId="getCarouselDelioAlbums",
     *     tags={"Delio"},
     *     summary="Retorna os albums do carrossel",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Albums do carrossel retornados com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="albums", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Mid Album"),
     *                     @OA\Property(property="is_in_carrossel", type="boolean", example=true)
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Albums do carrossel retornados com sucesso!")
     *         )
     *     )
     * )
     */
    public function carousel()
    {
        $albums = DelioAlbum::query()
            ->where('is_in_carrossel', true)
            ->latest()
            ->get();

        return response()->json([
            'albums' => $albums,
            'message' => 'Albums do carrossel retornados com sucesso!',
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/delio/albums/all",
     *     operationId="getAllDelioAlbums",
     *     tags={"Delio"},
     *     summary="Lista todos os albums sem paginacao",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Todos os albums retornados com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="albums", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="titulo", type="string", example="Thriller"),
     *                     @OA\Property(property="artista", type="string", example="Michael Jackson")
     *                 )
     *             ),
     *             @OA\Property(property="message", type="string", example="Albums retornados com sucesso!")
     *         )
     *     )
     * )
     */
    public function showByUser()
    {
        $albums = DelioAlbum::all();

        return response()->json([
            'albums' => $albums->values(),
            'message' => 'Albums retornados com sucesso!',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BayletPublication;
use Illuminate\Http\Request;

class BayletPublicationController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Baylet",
     *     description="Gerenciamento de publicações"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/baylet/publications",
     *     operationId="getBayletPublications",
     *     tags={"Baylet"},
     *     summary="Lista todas as publicações com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de publicações com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="publications", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Relógio Social Clássico"),
     *                     @OA\Property(property="description", type="string", example="Relógio elegante para ocasiões formais"),
     *                     @OA\Property(property="price", type="number", format="float", example=399.90),
     *                     @OA\Property(property="category_id", type="integer", example=1),
     *                     @OA\Property(property="created_by", type="integer", example=1),
     *                     @OA\Property(property="status", type="string", example="ACTIVE"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z")
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
        $publications = BayletPublication::paginate(10);

        return response()->json([
            'publications' => $publications->items(),
            'current_page' => $publications->currentPage(),
            'total' => $publications->total(),
            'per_page' => $publications->perPage(),
            'last_page' => $publications->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/baylet/publications/{id}",
     *     operationId="getBayletPublication",
     *     tags={"Baylet"},
     *     summary="Busca uma publicação pelo ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da publicação",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publicação encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="publication", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Relógio Social Clássico"),
     *                 @OA\Property(property="description", type="string", example="Relógio elegante para ocasiões formais"),
     *                 @OA\Property(property="price", type="number", format="float", example=399.90),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="created_by", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="ACTIVE"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Publicação não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $publication = BayletPublication::find($id);
        if (! $publication) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'publication' => $publication,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/baylet/publications",
     *     operationId="createBayletPublication",
     *     tags={"Baylet"},
     *     summary="Cria uma nova publicação",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name","description","price","category_id","created_by","status"},
     *             @OA\Property(property="name", type="string", example="Relógio Social Clássico"),
     *             @OA\Property(property="description", type="string", example="Relógio elegante para ocasiões formais"),
     *             @OA\Property(property="price", type="number", format="float", example=399.90),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="created_by", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="ACTIVE")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Publicação criada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="publication", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Relógio Social Clássico"),
     *                 @OA\Property(property="description", type="string", example="Relógio elegante para ocasiões formais"),
     *                 @OA\Property(property="price", type="number", format="float", example=399.90),
     *                 @OA\Property(property="category_id", type="integer", example=1),
     *                 @OA\Property(property="created_by", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="ACTIVE")
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:bt_categories,id',
            'created_by' => 'required|integer|exists:bt_users,id',
            'status' => 'required|string|max:50',
        ]);

        $publication = BayletPublication::create($data);

        return response()->json([
            'publication' => $publication,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/baylet/publications/{id}",
     *     operationId="updateBayletPublication",
     *     tags={"Baylet"},
     *     summary="Atualiza uma publicação",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da publicação",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Relógio Esportivo"),
     *             @OA\Property(property="description", type="string", example="Modelo resistente à água"),
     *             @OA\Property(property="price", type="number", format="float", example=499.90),
     *             @OA\Property(property="category_id", type="integer", example=2),
     *             @OA\Property(property="created_by", type="integer", example=1),
     *             @OA\Property(property="status", type="string", example="INACTIVE")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publicação atualizada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="publication", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Relógio Esportivo"),
     *                 @OA\Property(property="description", type="string", example="Modelo resistente à água"),
     *                 @OA\Property(property="price", type="number", format="float", example=499.90),
     *                 @OA\Property(property="category_id", type="integer", example=2),
     *                 @OA\Property(property="created_by", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="INACTIVE")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Publicação não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $publication = BayletPublication::find($id);
        if (! $publication) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|integer|exists:bt_categories,id',
            'created_by' => 'sometimes|integer|exists:bt_users,id',
            'status' => 'sometimes|string|max:50',
        ]);

        $publication->update($data);

        return response()->json([
            'publication' => $publication,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/baylet/publications/{id}",
     *     operationId="deleteBayletPublication",
     *     tags={"Baylet"},
     *     summary="Remove uma publicação",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da publicação",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Publicação deletada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Publicação não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $publication = BayletPublication::find($id);
        if (! $publication) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $publication->delete();

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

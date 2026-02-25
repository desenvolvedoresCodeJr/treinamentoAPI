<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BalduttiCategory;
use Illuminate\Http\Request;

class BalduttiCategoryController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Baldutti",
     *     description="Gerenciamento de categorias Baldutti"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/baldutti/categories",
     *     operationId="getBalduttiCategories",
     *     tags={"Baldutti"},
     *     summary="Lista todas as categorias com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de categorias com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="categories", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Fone Bluetooth"),
     *                     @OA\Property(property="description", type="string", example="Fone sem fio com cancelamento de ruído"),
     *                     @OA\Property(property="price", type="number", format="float", example=299.90),
     *                     @OA\Property(property="type", type="string", example="ELETRONICO"),
     *                     @OA\Property(property="image", type="string", example="https://exemplo.com/fone.jpg"),
     *                     @OA\Property(property="isFeatured", type="boolean", example=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=30),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=3)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $categories = BalduttiCategory::paginate(10);

        return response()->json([
            'categories' => $categories->items(),
            'current_page' => $categories->currentPage(),
            'total' => $categories->total(),
            'per_page' => $categories->perPage(),
            'last_page' => $categories->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/baldutti/categories/{id}",
     *     operationId="getBalduttiCategory",
     *     tags={"Baldutti"},
     *     summary="Busca uma categoria pelo ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categoria encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="category", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Fone Bluetooth"),
     *                 @OA\Property(property="description", type="string", example="Fone sem fio com cancelamento de ruído"),
     *                 @OA\Property(property="price", type="number", format="float", example=299.90),
     *                 @OA\Property(property="type", type="string", example="ELETRONICO"),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/fone.jpg"),
     *                 @OA\Property(property="isFeatured", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $category = BalduttiCategory::find($id);
        if (! $category) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'category' => $category,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/baldutti/categories",
     *     operationId="createBalduttiCategory",
     *     tags={"Baldutti"},
     *     summary="Cria uma nova categoria",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"title","description","price","type","image","isFeatured"},
     *             @OA\Property(property="title", type="string", example="Fone Bluetooth"),
     *             @OA\Property(property="description", type="string", example="Fone sem fio com cancelamento de ruído"),
     *             @OA\Property(property="price", type="number", format="float", example=299.90),
     *             @OA\Property(property="type", type="string", example="ELETRONICO"),
     *             @OA\Property(property="image", type="string", example="https://exemplo.com/fone.jpg"),
     *             @OA\Property(property="isFeatured", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Categoria criada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="category", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Fone Bluetooth"),
     *                 @OA\Property(property="description", type="string", example="Fone sem fio com cancelamento de ruído"),
     *                 @OA\Property(property="price", type="number", format="float", example=299.90),
     *                 @OA\Property(property="type", type="string", example="ELETRONICO"),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/fone.jpg"),
     *                 @OA\Property(property="isFeatured", type="boolean", example=true)
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:100',
            'image' => 'required|string',
            'isFeatured' => 'required|boolean',
        ]);

        $category = BalduttiCategory::create($data);

        return response()->json([
            'category' => $category,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/baldutti/categories/{id}",
     *     operationId="updateBalduttiCategory",
     *     tags={"Baldutti"},
     *     summary="Atualiza uma categoria existente",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Fone Bluetooth Pro"),
     *             @OA\Property(property="description", type="string", example="Nova versão com bateria estendida"),
     *             @OA\Property(property="price", type="number", format="float", example=399.90),
     *             @OA\Property(property="type", type="string", example="ELETRONICO"),
     *             @OA\Property(property="image", type="string", example="https://exemplo.com/fone-pro.jpg"),
     *             @OA\Property(property="isFeatured", type="boolean", example=false)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categoria atualizada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="category", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Fone Bluetooth Pro"),
     *                 @OA\Property(property="description", type="string", example="Nova versão com bateria estendida"),
     *                 @OA\Property(property="price", type="number", format="float", example=399.90),
     *                 @OA\Property(property="type", type="string", example="ELETRONICO"),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/fone-pro.jpg"),
     *                 @OA\Property(property="isFeatured", type="boolean", example=false)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $category = BalduttiCategory::find($id);
        if (! $category) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'type' => 'sometimes|string|max:100',
            'image' => 'sometimes|string',
            'isFeatured' => 'sometimes|boolean',
        ]);

        $category->update($data);

        return response()->json([
            'category' => $category,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/baldutti/categories/{id}",
     *     operationId="deleteBalduttiCategory",
     *     tags={"Baldutti"},
     *     summary="Remove uma categoria",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Categoria deletada com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $category = BalduttiCategory::find($id);
        if (! $category) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

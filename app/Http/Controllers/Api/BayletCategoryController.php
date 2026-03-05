<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BayletCategory;

class BayletCategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/baylet/categories",
     *     operationId="getBayletCategories",
     *     tags={"Baylet"},
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
     *                     @OA\Property(property="name", type="string", example="SOCIAL"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T10:00:00.000000Z")
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=3),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=1)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $categories = BayletCategory::paginate(10);

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
     *     path="api/baylet/categories/{id}",
     *     operationId="getBayletCategory",
     *     tags={"Baylet"},
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
     *                 @OA\Property(property="name", type="string", example="SOCIAL")
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
        $category = BayletCategory::find($id);
        if (! $category) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'category' => $category,
        ], 200);
    }
}

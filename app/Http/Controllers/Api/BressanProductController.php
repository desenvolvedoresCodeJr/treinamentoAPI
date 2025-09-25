<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BressanProduct;
use Illuminate\Http\Request;

class BressanProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="api/bressan/products",
     *     operationId="getBressanProducts",
     *     tags={"Bressan"},
     *     summary="Lista todos os produtos com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos com paginação",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="products", type="array",
     *
     *                 @OA\Items(
     *
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="Produto Bressan"),
     *                     @OA\Property(property="price", type="number", format="float", example=29.99),
     *                     @OA\Property(property="image", type="string", example="https://exemplo.com/imagem.jpg"),
     *                     @OA\Property(property="type", type="string", example="eletrônicos"),
     *                     @OA\Property(property="is_highlighted", type="boolean", example=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *                 )
     *             ),
     *             @OA\Property(property="current_page", type="integer", example=1),
     *             @OA\Property(property="total", type="integer", example=50),
     *             @OA\Property(property="per_page", type="integer", example=10),
     *             @OA\Property(property="last_page", type="integer", example=5)
     *         )
     *     )
     * )
     */
    public function index()
    {
        $products = BressanProduct::paginate(10);

        return response()->json([
            'products' => $products->items(),
            'current_page' => $products->currentPage(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
            'last_page' => $products->lastPage(),
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="api/bressan/products/{id}",
     *     operationId="getBressanProduct",
     *     tags={"Bressan"},
     *     summary="Busca um produto específico pelo ID",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Produto encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Produto Bressan"),
     *                 @OA\Property(property="price", type="number", format="float", example=29.99),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/imagem.jpg"),
     *                 @OA\Property(property="type", type="string", example="eletrônicos"),
     *                 @OA\Property(property="is_highlighted", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $product = BressanProduct::find($id);
        if (! $product) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        return response()->json([
            'product' => $product,
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="api/bressan/products",
     *     operationId="createBressanProduct",
     *     tags={"Bressan"},
     *     summary="Cria um novo produto",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name","price","image","type"},
     *
     *             @OA\Property(property="name", type="string", example="Produto Bressan"),
     *             @OA\Property(property="price", type="number", format="float", example=29.99),
     *             @OA\Property(property="image", type="string", example="https://exemplo.com/imagem.jpg"),
     *             @OA\Property(property="type", type="string", example="eletrônicos"),
     *             @OA\Property(property="is_highlighted", type="boolean", example=true),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Produto criado com sucesso",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Produto Bressan"),
     *                 @OA\Property(property="price", type="number", format="float", example=29.99),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/imagem.jpg"),
     *                 @OA\Property(property="type", type="string", example="eletrônicos"),
     *                 @OA\Property(property="is_highlighted", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string',
            'type' => 'required|string',
            'is_highlighted' => 'boolean',
        ]);
        $product = BressanProduct::create($data);

        return response()->json([
            'product' => $product,
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="api/bressan/products/{id}",
     *     operationId="updateBressanProduct",
     *     tags={"Bressan"},
     *     summary="Atualiza as informações de um produto existente",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="name", type="string", example="Produto Bressan Atualizado"),
     *             @OA\Property(property="price", type="number", format="float", example=39.99),
     *             @OA\Property(property="image", type="string", example="https://exemplo.com/nova-imagem.jpg"),
     *             @OA\Property(property="type", type="string", example="casa e jardim"),
     *             @OA\Property(property="is_highlighted", type="boolean", example=false),
     *         ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Produto Bressan Atualizado"),
     *                 @OA\Property(property="price", type="number", format="float", example=39.99),
     *                 @OA\Property(property="image", type="string", example="https://exemplo.com/nova-imagem.jpg"),
     *                 @OA\Property(property="type", type="string", example="casa e jardim"),
     *                 @OA\Property(property="is_highlighted", type="boolean", example=false),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2024-08-21T00:00:00.000000Z"),
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $product = BressanProduct::find($id);
        if (! $product) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $data = $request->validate([
            'name' => 'string',
            'price' => 'numeric',
            'image' => 'string',
            'type' => 'string',
            'is_highlighted' => 'boolean',
        ]);

        $product->update($data);

        return response()->json([
            'product' => $product,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/bressan/products/{id}",
     *     operationId="deleteBressanProduct",
     *     tags={"Bressan"},
     *     summary="Remove um produto existente",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Produto deletado com sucesso",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $product = BressanProduct::find($id);
        if (! $product) {
            return response()->json([
                'error' => 'not found!',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Deletado com sucesso',
        ], 200);
    }
}

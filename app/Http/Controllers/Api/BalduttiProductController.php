<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BalduttiProduct;
use Illuminate\Http\Request;

class BalduttiProductController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Baldutti",
     *     description="Gerenciamento de produtos Baldutti"
     * )
     */

    /**
     * @OA\Get(
     *     path="api/baldutti/products",
     *     operationId="getBalduttiProducts",
     *     tags={"Baldutti"},
     *     summary="Lista todos os produtos com paginação",
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos com paginação",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="products", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
    *                     @OA\Property(property="title", type="string", example="Shape Maple Profissional 8.0"),
    *                     @OA\Property(property="description", type="string", example="Shape de maple com alta resistência para street."),
     *                     @OA\Property(property="price", type="number", format="float", example=299.90),
    *                     @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="shape"),
    *                     @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/shape-maple-8-0.jpg"),
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
        $products = BalduttiProduct::paginate(10);

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
     *     path="api/baldutti/products/{id}",
     *     operationId="getBalduttiProduct",
     *     tags={"Baldutti"},
     *     summary="Busca um produto pelo ID",
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
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="title", type="string", example="Rodas 53mm 99A"),
    *                 @OA\Property(property="description", type="string", example="Jogo de rodas para street com ótima durabilidade."),
     *                 @OA\Property(property="price", type="number", format="float", example=299.90),
    *                 @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="rodas"),
    *                 @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/rodas-53mm-99a.jpg"),
     *                 @OA\Property(property="isFeatured", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2026-02-25T12:00:00.000000Z")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function show(int $id)
    {
        $product = BalduttiProduct::find($id);
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
     *     path="api/baldutti/products",
     *     operationId="createBalduttiProduct",
     *     tags={"Baldutti"},
     *     summary="Cria um novo produto",
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"title","description","price","type","image","isFeatured"},
    *             @OA\Property(property="title", type="string", example="Skate Montado Iniciante"),
    *             @OA\Property(property="description", type="string", example="Skate montado ideal para quem está começando."),
     *             @OA\Property(property="price", type="number", format="float", example=299.90),
    *             @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="skateMontado"),
    *             @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/skate-montado-iniciante.jpg"),
     *             @OA\Property(property="isFeatured", type="boolean", example=true)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Produto criado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="title", type="string", example="Skate Montado Iniciante"),
    *                 @OA\Property(property="description", type="string", example="Skate montado ideal para quem está começando."),
     *                 @OA\Property(property="price", type="number", format="float", example=299.90),
    *                 @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="skateMontado"),
    *                 @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/skate-montado-iniciante.jpg"),
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

        $product = BalduttiProduct::create($data);

        return response()->json([
            'product' => $product,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="api/baldutti/products/{id}",
     *     operationId="updateBalduttiProduct",
     *     tags={"Baldutti"},
     *     summary="Atualiza um produto existente",
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
    *             @OA\Property(property="title", type="string", example="Truck Profissional 139mm"),
    *             @OA\Property(property="description", type="string", example="Truck leve e resistente para manobras técnicas."),
     *             @OA\Property(property="price", type="number", format="float", example=399.90),
    *             @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="truck"),
    *             @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/truck-139mm.jpg"),
     *             @OA\Property(property="isFeatured", type="boolean", example=false)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="product", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
    *                 @OA\Property(property="title", type="string", example="Truck Profissional 139mm"),
    *                 @OA\Property(property="description", type="string", example="Truck leve e resistente para manobras técnicas."),
     *                 @OA\Property(property="price", type="number", format="float", example=399.90),
    *                 @OA\Property(property="type", type="string", description="Categoria do produto. Exemplos: shape, rodas, skateMontado, truck, lixa, rolamento.", example="truck"),
    *                 @OA\Property(property="image", type="string", example="https://exemplo.com/imagens/truck-139mm.jpg"),
     *                 @OA\Property(property="isFeatured", type="boolean", example=false)
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id)
    {
        $product = BalduttiProduct::find($id);
        if (! $product) {
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

        $product->update($data);

        return response()->json([
            'product' => $product,
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="api/baldutti/products/{id}",
     *     operationId="deleteBalduttiProduct",
     *     tags={"Baldutti"},
     *     summary="Remove um produto",
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
     *             @OA\Property(property="message", type="string", example="Deletado com sucesso")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado",
     *
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="not found!")
     *         )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $product = BalduttiProduct::find($id);
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

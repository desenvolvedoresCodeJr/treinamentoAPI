<?php

namespace App\Http\Controllers\Api;

use App\Models\RomuloProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
/**
 * @OA\Tag(
 *     name="Romulo",
 *     description="Gerenciamento de produtos"
 * )
 */
class RomuloProductController extends Controller
{

    /**
 * @OA\Get(
 *     path="/api/products",
 *     summary="Lista todos os produtos com paginação",
 *     tags={"Romulo"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de produtos paginada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="data", type="array", 
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="category", type="string", example="Eletrônicos"),
 *                     @OA\Property(property="title", type="string", example="Smartphone X"),
 *                     @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *                     @OA\Property(property="price", type="number", format="float", example=1999.99),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-01T12:00:00Z"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-02T15:30:00Z")
 *                 )
 *             ),
 *             @OA\Property(property="status", type="integer", example=200)
 *         )
 *     )
 * )
 */
    public function index()
    {
        try {
            return response()->json([
                'data' => RomuloProduct::paginate(6),
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
 * @OA\Post(
 *     path="/api/products",
 *     summary="Cria um novo produto",
 *     tags={"Romulo"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"category", "title", "image", "price"},
 *             @OA\Property(property="category", type="string", example="Eletrônicos"),
 *             @OA\Property(property="title", type="string", example="Smartphone X"),
 *             @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *             @OA\Property(property="price", type="number", format="float", example=1999.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Produto criado com sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="category", type="string", example="Eletrônicos"),
 *             @OA\Property(property="title", type="string", example="Smartphone X"),
 *             @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *             @OA\Property(property="price", type="number", format="float", example=1999.99),
 *             @OA\Property(property="message", type="string", example="Produto criado com sucesso")
 *         )
 *     )
 * )
 */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'category' => 'required|string|max:255',
                'title' => 'required|string|max:255',
                'image' => 'required',
                'price' => 'required|numeric|min:0'
            ]);

            $product = RomuloProduct::create($validated);

            return response()->json([
                'product' => $product,
                'message' => "Produto criado com sucesso"
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Erro ao criar produto: " . $e->getMessage()
            ], 500);
        }
    }
/**
 * @OA\Put(
 *     path="/api/products/{id}",
 *     summary="Atualiza um produto",
 *     tags={"Romulo"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do produto",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="category", type="string", example="Eletrônicos"),
 *             @OA\Property(property="title", type="string", example="Smartphone X"),
 *             @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *             @OA\Property(property="price", type="number", format="float", example=1999.99)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto atualizado com sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="category", type="string", example="Eletrônicos"),
 *             @OA\Property(property="title", type="string", example="Smartphone X"),
 *             @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *             @OA\Property(property="price", type="number", format="float", example=1999.99),
 *             @OA\Property(property="message", type="string", example="Produto atualizado com sucesso")
 *         )
 *     )
 * )
 */
    public function update(Request $request, int $id)
    {
        try {
            $product = RomuloProduct::findOrFail($id);

            $validated = $request->validate([
                'category' => 'sometimes|string|max:255',
                'title' => 'sometimes|string|max:255',
                'image' => 'sometimes',
                'price' => 'sometimes|numeric|min:0'
            ]);

            $product->update($validated);

            return response()->json([
                'product' => $product,
                'message' => "Produto atualizado com sucesso"
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Erro ao atualizar produto: " . $e->getMessage()
            ], 500);
        }
    }
/**
 * @OA\Delete(
 *     path="/api/products/{id}",
 *     summary="Deleta um produto",
 *     tags={"Romulo"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do produto",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto deletado com sucesso",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Produto deletado com sucesso")
 *         )
 *     )
 * )
 */
    public function delete(int $id)
    {
        try {
            $deleted = RomuloProduct::destroy($id);

            if (!$deleted) {
                return response()->json([
                    'message' => "Produto não encontrado"
                ], 404);
            }

            return response()->json([
                'message' => "Produto deletado com sucesso"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Erro ao deletar produto: " . $e->getMessage()
            ], 500);
        }
    }

    /**
 * @OA\Get(
 *     path="/api/products/{id}",
 *     summary="Busca um produto pelo ID",
 *     tags={"Romulo"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID do produto",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Produto encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="category", type="string", example="Eletrônicos"),
 *             @OA\Property(property="title", type="string", example="Smartphone X"),
 *             @OA\Property(property="image", type="string", format="url", example="https://example.com/image.jpg"),
 *             @OA\Property(property="price", type="number", format="float", example=1999.99),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2024-03-01T12:00:00Z"),
 *             @OA\Property(property="updated_at", type="string", format="date-time", example="2024-03-02T15:30:00Z")
 *         )
 *     )
 * )
 */
    public function show(int $id)
    {
        try {
            $product = RomuloProduct::findOrFail($id);

            return response()->json([
                'product' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Produto não encontrado"
            ], 404);
        }
    }
}

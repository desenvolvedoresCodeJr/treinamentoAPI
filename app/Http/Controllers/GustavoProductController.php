<?php

namespace App\Http\Controllers;

use App\Models\Gustavo\GustavoProduct;
use Illuminate\Http\Request;

class GustavoProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/gustavo/products",
     *     summary="List all GustavoProduct",
     *     tags={"Gustavo"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(GustavoProduct::all());
    }

    /**
     * @OA\Post(
     *     path="/api/gustavo/products",
     *     summary="Create a new GustavoProduct",
     *     tags={"Gustavo"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = GustavoProduct::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/gustavo/products/{id}",
     *     summary="Get a specific GustavoProduct",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = GustavoProduct::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/gustavo/products/{id}",
     *     summary="Update a specific GustavoProduct",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = GustavoProduct::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/gustavo/products/{id}",
     *     summary="Delete a specific GustavoProduct",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = GustavoProduct::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
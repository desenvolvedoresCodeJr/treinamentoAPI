<?php

namespace App\Http\Controllers;

use App\Models\Gustavo\GustavoCategory;
use Illuminate\Http\Request;

class GustavoCategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/gustavo/categories",
     *     summary="List all GustavoCategory",
     *     tags={"Gustavo"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(GustavoCategory::all());
    }

    /**
     * @OA\Post(
     *     path="/api/gustavo/categories",
     *     summary="Create a new GustavoCategory",
     *     tags={"Gustavo"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = GustavoCategory::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/gustavo/categories/{id}",
     *     summary="Get a specific GustavoCategory",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = GustavoCategory::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/gustavo/categories/{id}",
     *     summary="Update a specific GustavoCategory",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = GustavoCategory::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/gustavo/categories/{id}",
     *     summary="Delete a specific GustavoCategory",
     *     tags={"Gustavo"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = GustavoCategory::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
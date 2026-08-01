<?php

namespace App\Http\Controllers\Bruno;

use App\Http\Requests\Bruno\StoreBrunoProductRequest;
use App\Http\Requests\Bruno\UpdateBrunoProductRequest;
use App\Models\Bruno\BrunoProduct;

class BrunoProductController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/bruno/products",
     *     tags={"Bruno"},
     *     summary="List all BrunoProducts",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Bruno\BrunoProduct::all();
    }

    /**
     * @OA\Post(
     *     path="/api/bruno/products",
     *     tags={"Bruno"},
     *     summary="Create a new BrunoProduct",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Bruno\StoreBrunoProductRequest $request)
    {
        return \App\Models\Bruno\BrunoProduct::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/bruno/products/{id}",
     *     tags={"Bruno"},
     *     summary="Get BrunoProduct by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Bruno\BrunoProduct::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/bruno/products/{id}",
     *     tags={"Bruno"},
     *     summary="Update a BrunoProduct",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="price", type="string"),
     *             @OA\Property(property="image_url", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Bruno\UpdateBrunoProductRequest $request, $id)
    {
        $item = \App\Models\Bruno\BrunoProduct::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/bruno/products/{id}",
     *     tags={"Bruno"},
     *     summary="Delete a BrunoProduct",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Bruno\BrunoProduct::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

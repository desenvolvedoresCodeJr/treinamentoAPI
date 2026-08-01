<?php

namespace App\Http\Controllers\Bruno;

use App\Http\Requests\Bruno\StoreBrunoCartItemRequest;
use App\Http\Requests\Bruno\UpdateBrunoCartItemRequest;
use App\Models\Bruno\BrunoCartItem;

class BrunoCartItemController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/bruno/cart-items",
     *     tags={"Bruno"},
     *     summary="List all BrunoCartItems",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Bruno\BrunoCartItem::all();
    }

    /**
     * @OA\Post(
     *     path="/api/bruno/cart-items",
     *     tags={"Bruno"},
     *     summary="Create a new BrunoCartItem",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="string"),
     *             @OA\Property(property="product_id", type="string"),
     *             @OA\Property(property="quantity", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Bruno\StoreBrunoCartItemRequest $request)
    {
        return \App\Models\Bruno\BrunoCartItem::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/bruno/cart-items/{id}",
     *     tags={"Bruno"},
     *     summary="Get BrunoCartItem by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Bruno\BrunoCartItem::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/bruno/cart-items/{id}",
     *     tags={"Bruno"},
     *     summary="Update a BrunoCartItem",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="string"),
     *             @OA\Property(property="product_id", type="string"),
     *             @OA\Property(property="quantity", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Bruno\UpdateBrunoCartItemRequest $request, $id)
    {
        $item = \App\Models\Bruno\BrunoCartItem::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/bruno/cart-items/{id}",
     *     tags={"Bruno"},
     *     summary="Delete a BrunoCartItem",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Bruno\BrunoCartItem::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

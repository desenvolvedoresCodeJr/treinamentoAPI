<?php

namespace App\Http\Controllers\Bruno;

use App\Http\Requests\Bruno\StoreBrunoProductRequest;
use App\Http\Requests\Bruno\UpdateBrunoProductRequest;
use App\Models\Bruno\BrunoProduct;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->all();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('bruno_products', 'public');
            $data['image_url'] = Storage::url($path);
        }
        return \App\Models\Bruno\BrunoProduct::create($data);
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
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($item->image_url) {
                $oldPath = str_replace('/storage/', '', $item->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('bruno_products', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $item->update($data);
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

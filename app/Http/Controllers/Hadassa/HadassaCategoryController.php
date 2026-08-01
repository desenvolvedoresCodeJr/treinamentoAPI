<?php

namespace App\Http\Controllers\Hadassa;

use App\Http\Requests\Hadassa\StoreHadassaCategoryRequest;
use App\Http\Requests\Hadassa\UpdateHadassaCategoryRequest;
use App\Models\Hadassa\HadassaCategory;

class HadassaCategoryController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/hadassa/categories",
     *     tags={"Hadassa"},
     *     summary="List all HadassaCategorys",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Hadassa\HadassaCategory::all();
    }

    /**
     * @OA\Post(
     *     path="/api/hadassa/categories",
     *     tags={"Hadassa"},
     *     summary="Create a new HadassaCategory",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="categoria", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Hadassa\StoreHadassaCategoryRequest $request)
    {
        return \App\Models\Hadassa\HadassaCategory::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa"},
     *     summary="Get HadassaCategory by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Hadassa\HadassaCategory::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa"},
     *     summary="Update a HadassaCategory",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="categoria", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Hadassa\UpdateHadassaCategoryRequest $request, $id)
    {
        $item = \App\Models\Hadassa\HadassaCategory::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa"},
     *     summary="Delete a HadassaCategory",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Hadassa\HadassaCategory::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

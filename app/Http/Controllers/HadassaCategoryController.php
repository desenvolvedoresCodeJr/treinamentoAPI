<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHadassaCategoryRequest;
use App\Http\Requests\UpdateHadassaCategoryRequest;
use App\Models\HadassaCategory;

class HadassaCategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/hadassa/categories",
     *     tags={"Hadassa Categories"},
     *     summary="List all HadassaCategorys",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\HadassaCategory::all();
    }

    /**
     * @OA\Post(
     *     path="/api/hadassa/categories",
     *     tags={"Hadassa Categories"},
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
    public function store(\App\Http\Requests\StoreHadassaCategoryRequest $request)
    {
        return \App\Models\HadassaCategory::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa Categories"},
     *     summary="Get HadassaCategory by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\HadassaCategory::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa Categories"},
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
    public function update(\App\Http\Requests\UpdateHadassaCategoryRequest $request, $id)
    {
        $item = \App\Models\HadassaCategory::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/hadassa/categories/{id}",
     *     tags={"Hadassa Categories"},
     *     summary="Delete a HadassaCategory",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\HadassaCategory::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

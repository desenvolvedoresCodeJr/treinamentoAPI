<?php

namespace App\Http\Controllers\Hadassa;

use App\Http\Requests\Hadassa\StoreHadassaPostRequest;
use App\Http\Requests\Hadassa\UpdateHadassaPostRequest;
use App\Models\Hadassa\HadassaPost;

class HadassaPostController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/hadassa/posts",
     *     tags={"Hadassa"},
     *     summary="List all HadassaPosts",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Hadassa\HadassaPost::all();
    }

    /**
     * @OA\Post(
     *     path="/api/hadassa/posts",
     *     tags={"Hadassa"},
     *     summary="Create a new HadassaPost",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titulo", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="id_categoria", type="string"),
     *             @OA\Property(property="imagem", type="string"),
     *             @OA\Property(property="author_id", type="string"),
     *             @OA\Property(property="data", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Hadassa\StoreHadassaPostRequest $request)
    {
        return \App\Models\Hadassa\HadassaPost::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa"},
     *     summary="Get HadassaPost by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Hadassa\HadassaPost::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa"},
     *     summary="Update a HadassaPost",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titulo", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="id_categoria", type="string"),
     *             @OA\Property(property="imagem", type="string"),
     *             @OA\Property(property="author_id", type="string"),
     *             @OA\Property(property="data", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Hadassa\UpdateHadassaPostRequest $request, $id)
    {
        $item = \App\Models\Hadassa\HadassaPost::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa"},
     *     summary="Delete a HadassaPost",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Hadassa\HadassaPost::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

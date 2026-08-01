<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHadassaPostRequest;
use App\Http\Requests\UpdateHadassaPostRequest;
use App\Models\HadassaPost;

class HadassaPostController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/hadassa/posts",
     *     tags={"Hadassa Posts"},
     *     summary="List all HadassaPosts",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\HadassaPost::all();
    }

    /**
     * @OA\Post(
     *     path="/api/hadassa/posts",
     *     tags={"Hadassa Posts"},
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
    public function store(\App\Http\Requests\StoreHadassaPostRequest $request)
    {
        return \App\Models\HadassaPost::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa Posts"},
     *     summary="Get HadassaPost by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\HadassaPost::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa Posts"},
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
    public function update(\App\Http\Requests\UpdateHadassaPostRequest $request, $id)
    {
        $item = \App\Models\HadassaPost::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/hadassa/posts/{id}",
     *     tags={"Hadassa Posts"},
     *     summary="Delete a HadassaPost",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\HadassaPost::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

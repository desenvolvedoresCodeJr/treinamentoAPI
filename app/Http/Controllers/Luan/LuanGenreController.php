<?php

namespace App\Http\Controllers\Luan;

use App\Http\Requests\Luan\StoreLuanGenreRequest;
use App\Http\Requests\Luan\UpdateLuanGenreRequest;
use App\Models\Luan\LuanGenre;

class LuanGenreController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/genres",
     *     tags={"Luan"},
     *     summary="List all LuanGenres",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Luan\LuanGenre::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/genres",
     *     tags={"Luan"},
     *     summary="Create a new LuanGenre",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="genero", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Luan\StoreLuanGenreRequest $request)
    {
        return \App\Models\Luan\LuanGenre::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan"},
     *     summary="Get LuanGenre by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Luan\LuanGenre::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan"},
     *     summary="Update a LuanGenre",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="genero", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Luan\UpdateLuanGenreRequest $request, $id)
    {
        $item = \App\Models\Luan\LuanGenre::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan"},
     *     summary="Delete a LuanGenre",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Luan\LuanGenre::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

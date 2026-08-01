<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLuanGenreRequest;
use App\Http\Requests\UpdateLuanGenreRequest;
use App\Models\LuanGenre;

class LuanGenreController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/genres",
     *     tags={"Luan Genres"},
     *     summary="List all LuanGenres",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\LuanGenre::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/genres",
     *     tags={"Luan Genres"},
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
    public function store(\App\Http\Requests\StoreLuanGenreRequest $request)
    {
        return \App\Models\LuanGenre::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan Genres"},
     *     summary="Get LuanGenre by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\LuanGenre::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan Genres"},
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
    public function update(\App\Http\Requests\UpdateLuanGenreRequest $request, $id)
    {
        $item = \App\Models\LuanGenre::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/genres/{id}",
     *     tags={"Luan Genres"},
     *     summary="Delete a LuanGenre",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\LuanGenre::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

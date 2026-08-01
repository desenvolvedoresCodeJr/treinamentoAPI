<?php

namespace App\Http\Controllers\Luan;

use App\Http\Requests\Luan\StoreLuanGameRequest;
use App\Http\Requests\Luan\UpdateLuanGameRequest;
use App\Models\Luan\LuanGame;

class LuanGameController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/games",
     *     tags={"Luan"},
     *     summary="List all LuanGames",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Luan\LuanGame::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/games",
     *     tags={"Luan"},
     *     summary="Create a new LuanGame",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titulo", type="string"),
     *             @OA\Property(property="genero_id", type="string"),
     *             @OA\Property(property="plataforma_id", type="string"),
     *             @OA\Property(property="ano_lancamento", type="string"),
     *             @OA\Property(property="capa", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Luan\StoreLuanGameRequest $request)
    {
        return \App\Models\Luan\LuanGame::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan"},
     *     summary="Get LuanGame by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Luan\LuanGame::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan"},
     *     summary="Update a LuanGame",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="titulo", type="string"),
     *             @OA\Property(property="genero_id", type="string"),
     *             @OA\Property(property="plataforma_id", type="string"),
     *             @OA\Property(property="ano_lancamento", type="string"),
     *             @OA\Property(property="capa", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Luan\UpdateLuanGameRequest $request, $id)
    {
        $item = \App\Models\Luan\LuanGame::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan"},
     *     summary="Delete a LuanGame",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Luan\LuanGame::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

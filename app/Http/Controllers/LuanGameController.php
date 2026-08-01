<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLuanGameRequest;
use App\Http\Requests\UpdateLuanGameRequest;
use App\Models\LuanGame;

class LuanGameController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/games",
     *     tags={"Luan Games"},
     *     summary="List all LuanGames",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\LuanGame::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/games",
     *     tags={"Luan Games"},
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
    public function store(\App\Http\Requests\StoreLuanGameRequest $request)
    {
        return \App\Models\LuanGame::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan Games"},
     *     summary="Get LuanGame by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\LuanGame::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan Games"},
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
    public function update(\App\Http\Requests\UpdateLuanGameRequest $request, $id)
    {
        $item = \App\Models\LuanGame::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/games/{id}",
     *     tags={"Luan Games"},
     *     summary="Delete a LuanGame",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\LuanGame::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

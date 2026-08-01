<?php

namespace App\Http\Controllers\Luan;

use App\Http\Requests\Luan\StoreLuanPlatformRequest;
use App\Http\Requests\Luan\UpdateLuanPlatformRequest;
use App\Models\Luan\LuanPlatform;

class LuanPlatformController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/platforms",
     *     tags={"Luan"},
     *     summary="List all LuanPlatforms",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Luan\LuanPlatform::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/platforms",
     *     tags={"Luan"},
     *     summary="Create a new LuanPlatform",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="icone", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Luan\StoreLuanPlatformRequest $request)
    {
        return \App\Models\Luan\LuanPlatform::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/platforms/{id}",
     *     tags={"Luan"},
     *     summary="Get LuanPlatform by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Luan\LuanPlatform::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/platforms/{id}",
     *     tags={"Luan"},
     *     summary="Update a LuanPlatform",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="icone", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Luan\UpdateLuanPlatformRequest $request, $id)
    {
        $item = \App\Models\Luan\LuanPlatform::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/platforms/{id}",
     *     tags={"Luan"},
     *     summary="Delete a LuanPlatform",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Luan\LuanPlatform::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

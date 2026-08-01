<?php

namespace App\Http\Controllers\Luan;

use App\Http\Requests\Luan\StoreLuanReviewRequest;
use App\Http\Requests\Luan\UpdateLuanReviewRequest;
use App\Models\Luan\LuanReview;

class LuanReviewController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/reviews",
     *     tags={"Luan"},
     *     summary="List all LuanReviews",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\Luan\LuanReview::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/reviews",
     *     tags={"Luan"},
     *     summary="Create a new LuanReview",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="string"),
     *             @OA\Property(property="jogo_id", type="string"),
     *             @OA\Property(property="nota", type="string"),
     *             @OA\Property(property="comentario", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(\App\Http\Requests\Luan\StoreLuanReviewRequest $request)
    {
        return \App\Models\Luan\LuanReview::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan"},
     *     summary="Get LuanReview by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\Luan\LuanReview::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan"},
     *     summary="Update a LuanReview",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="usuario_id", type="string"),
     *             @OA\Property(property="jogo_id", type="string"),
     *             @OA\Property(property="nota", type="string"),
     *             @OA\Property(property="comentario", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(\App\Http\Requests\Luan\UpdateLuanReviewRequest $request, $id)
    {
        $item = \App\Models\Luan\LuanReview::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan"},
     *     summary="Delete a LuanReview",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\Luan\LuanReview::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

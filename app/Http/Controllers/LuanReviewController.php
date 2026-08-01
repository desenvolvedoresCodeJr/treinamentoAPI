<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLuanReviewRequest;
use App\Http\Requests\UpdateLuanReviewRequest;
use App\Models\LuanReview;

class LuanReviewController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/luan/reviews",
     *     tags={"Luan Reviews"},
     *     summary="List all LuanReviews",
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return \App\Models\LuanReview::all();
    }

    /**
     * @OA\Post(
     *     path="/api/luan/reviews",
     *     tags={"Luan Reviews"},
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
    public function store(\App\Http\Requests\StoreLuanReviewRequest $request)
    {
        return \App\Models\LuanReview::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan Reviews"},
     *     summary="Get LuanReview by ID",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return \App\Models\LuanReview::findOrFail($id);
    }

    /**
     * @OA\Put(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan Reviews"},
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
    public function update(\App\Http\Requests\UpdateLuanReviewRequest $request, $id)
    {
        $item = \App\Models\LuanReview::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * @OA\Delete(
     *     path="/api/luan/reviews/{id}",
     *     tags={"Luan Reviews"},
     *     summary="Delete a LuanReview",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = \App\Models\LuanReview::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }

}

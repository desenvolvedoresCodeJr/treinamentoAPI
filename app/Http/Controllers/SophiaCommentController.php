<?php

namespace App\Http\Controllers;

use App\Models\Sophia\SophiaComment;
use Illuminate\Http\Request;

class SophiaCommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sophia/comments",
     *     summary="List all SophiaComment",
     *     tags={"Sophia"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(SophiaComment::all());
    }

    /**
     * @OA\Post(
     *     path="/api/sophia/comments",
     *     summary="Create a new SophiaComment",
     *     tags={"Sophia"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = SophiaComment::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/sophia/comments/{id}",
     *     summary="Get a specific SophiaComment",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = SophiaComment::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/sophia/comments/{id}",
     *     summary="Update a specific SophiaComment",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = SophiaComment::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/sophia/comments/{id}",
     *     summary="Delete a specific SophiaComment",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = SophiaComment::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Sophia\SophiaPost;
use Illuminate\Http\Request;

class SophiaPostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sophia/posts",
     *     summary="List all SophiaPost",
     *     tags={"Sophia"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(SophiaPost::all());
    }

    /**
     * @OA\Post(
     *     path="/api/sophia/posts",
     *     summary="Create a new SophiaPost",
     *     tags={"Sophia"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = SophiaPost::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/sophia/posts/{id}",
     *     summary="Get a specific SophiaPost",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = SophiaPost::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/sophia/posts/{id}",
     *     summary="Update a specific SophiaPost",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = SophiaPost::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/sophia/posts/{id}",
     *     summary="Delete a specific SophiaPost",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = SophiaPost::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Sophia\SophiaCharacter;
use Illuminate\Http\Request;

class SophiaCharacterController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/sophia/characters",
     *     summary="List all SophiaCharacter",
     *     tags={"Sophia"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(SophiaCharacter::all());
    }

    /**
     * @OA\Post(
     *     path="/api/sophia/characters",
     *     summary="Create a new SophiaCharacter",
     *     tags={"Sophia"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = SophiaCharacter::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/sophia/characters/{id}",
     *     summary="Get a specific SophiaCharacter",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = SophiaCharacter::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/sophia/characters/{id}",
     *     summary="Update a specific SophiaCharacter",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = SophiaCharacter::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/sophia/characters/{id}",
     *     summary="Delete a specific SophiaCharacter",
     *     tags={"Sophia"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = SophiaCharacter::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
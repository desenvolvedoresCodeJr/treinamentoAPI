<?php

namespace App\Http\Controllers;

use App\Models\Laura\LauraEvent;
use Illuminate\Http\Request;

class LauraEventController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/laura/events",
     *     summary="List all LauraEvent",
     *     tags={"Laura"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        return response()->json(LauraEvent::all());
    }

    /**
     * @OA\Post(
     *     path="/api/laura/events",
     *     summary="Create a new LauraEvent",
     *     tags={"Laura"},
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $item = LauraEvent::create($request->all());
        return response()->json($item, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/laura/events/{id}",
     *     summary="Get a specific LauraEvent",
     *     tags={"Laura"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $item = LauraEvent::findOrFail($id);
        return response()->json($item);
    }

    /**
     * @OA\Put(
     *     path="/api/laura/events/{id}",
     *     summary="Update a specific LauraEvent",
     *     tags={"Laura"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent()),
     *     @OA\Response(response=200, description="Updated"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $item = LauraEvent::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    /**
     * @OA\Delete(
     *     path="/api/laura/events/{id}",
     *     summary="Delete a specific LauraEvent",
     *     tags={"Laura"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $item = LauraEvent::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
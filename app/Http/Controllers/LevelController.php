<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('order')->get();
        return response()->json($levels);
    }

    public function show($id)
    {
        $level = Level::findOrFail($id);
        return response()->json($level);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menambah level'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|unique:levels',
            'description' => 'required|string'
        ]);

        $level = Level::create($request->all());
        return response()->json($level, 201);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa mengubah level'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'required|integer|unique:levels,order,' . $id,
            'description' => 'required|string'
        ]);

        $level = Level::findOrFail($id);
        $level->update($request->all());
        return response()->json($level);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menghapus level'], 403);
        }

        $level = Level::findOrFail($id);
        $level->delete();
        return response()->json(null, 204);
    }

    public function getMateri($id, Request $request)
    {
        $level = Level::findOrFail($id);
        $query = $level->materis();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $materis = $query->get();
        return response()->json($materis);
    }
}

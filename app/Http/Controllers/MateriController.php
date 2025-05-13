<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menambah materi'], 403);
        }

        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:visual,auditory,kinesthetic',
            'content' => 'required|string',
            'media_url' => 'nullable|string'
        ]);

        $materi = Materi::create($request->all());
        return response()->json($materi, 201);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa mengubah materi'], 403);
        }

        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:visual,auditory,kinesthetic',
            'content' => 'required|string',
            'media_url' => 'nullable|string'
        ]);

        $materi = Materi::findOrFail($id);
        $materi->update($request->all());
        return response()->json($materi);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menghapus materi'], 403);
        }

        $materi = Materi::findOrFail($id);
        $materi->delete();
        return response()->json(null, 204);
    }
}

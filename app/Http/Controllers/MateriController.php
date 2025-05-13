<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($id)
    {
        $materi = Materi::findOrFail($id);
        return response()->json($materi);
    }

    public function store(Request $request)
    {
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
        $materi = Materi::findOrFail($id);
        $materi->delete();
        return response()->json(null, 204);
    }
}

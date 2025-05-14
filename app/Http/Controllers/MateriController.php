<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MateriController extends Controller
{
    public function show($id)
    {
        try {
            $materi = Materi::findOrFail($id);
            return response()->json($materi, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menambah materi'], 403);
        }
        try {
            $validated = $request->validate([
                'level_id' => 'required|exists:levels,id',
                'title' => 'required|string|max:255',
                'type' => 'required|in:visual,auditory,kinesthetic',
                'content' => 'required|string',
                'media_url' => 'nullable|string'
            ]);
            $materi = Materi::create($validated);
            return response()->json($materi, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa mengubah materi'], 403);
        }
        try {
            $validated = $request->validate([
                'level_id' => 'required|exists:levels,id',
                'title' => 'required|string|max:255',
                'type' => 'required|in:visual,auditory,kinesthetic',
                'content' => 'required|string',
                'media_url' => 'nullable|string'
            ]);
            $materi = Materi::findOrFail($id);
            $materi->update($validated);
            return response()->json($materi, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menghapus materi'], 403);
        }
        try {
            $materi = Materi::findOrFail($id);
            $materi->delete();
            return response()->json(['message' => 'Materi berhasil dihapus'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MateriController extends Controller
{
    public function show($id, Request $request)
    {
        try {
            $user = $request->user();
            $materi = \App\Models\Materi::findOrFail($id);
            $level = $materi->level;
            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Materi ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }
            // Tambahkan status
            if ($level->order < $user->current_level) {
                $materi->status = 'unlocked';
                $materi->keterangan = 'Sudah dibuka';
            } elseif ($level->order == $user->current_level) {
                $materi->status = 'ongoing';
                $materi->keterangan = 'Sedang dikerjakan';
            } else {
                $materi->status = 'locked';
                $materi->keterangan = 'Belum bisa dibuka';
            }
            return response()->json($materi, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
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

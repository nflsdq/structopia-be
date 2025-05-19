<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\UserMateriCompletion;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LevelController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $user = $request->user();
        $levels = Level::orderBy('order')->paginate($perPage);
        $levels->getCollection()->transform(function ($level) use ($user) {
            if ($level->order < $user->current_level) {
                $level->status = 'unlocked';
                $level->keterangan = 'Sudah dibuka';
            } elseif ($level->order == $user->current_level) {
                $level->status = 'ongoing';
                $level->keterangan = 'Sedang dikerjakan';
            } else {
                $level->status = 'locked';
                $level->keterangan = 'Belum bisa dibuka';
            }
            return $level;
        });
        return response()->json($levels, 200);
    }

    public function show($id, Request $request)
    {
        $user = $request->user();
        try {
            $level = Level::findOrFail($id);
            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Level masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }

            $existingProgress = Progress::where('user_id', $user->id)
                ->where('level_id', $level->id)
                ->first();

            if (!$existingProgress || $existingProgress->status !== 'completed') {
                Progress::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'level_id' => $level->id
                    ],
                    ['status' => 'in-progress']
                );
            }

            if ($level->order < $user->current_level) {
                $level->status = 'unlocked';
                $level->keterangan = 'Sudah dibuka';
            } elseif ($level->order == $user->current_level) {
                $level->status = 'ongoing';
                $level->keterangan = 'Sedang dikerjakan';
            } else {
                $level->status = 'locked';
                $level->keterangan = 'Belum bisa dibuka';
            }
            return response()->json($level, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menambah level'], 403);
        }
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'order' => 'required|integer|unique:levels',
                'description' => 'required|string'
            ]);
            $level = Level::create($validated);
            return response()->json($level, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa mengubah level'], 403);
        }
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'order' => 'required|integer|unique:levels,order,' . $id,
                'description' => 'required|string'
            ]);
            $level = Level::findOrFail($id);
            $level->update($validated);
            return response()->json($level, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Hanya admin yang bisa menghapus level'], 403);
        }
        try {
            $level = Level::findOrFail($id);
            $level->delete();
            return response()->json(['message' => 'Level berhasil dihapus'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function getMateri($id, Request $request)
    {
        $user = $request->user();
        try {
            $level = Level::findOrFail($id);
            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Materi level ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }

            $existingProgress = Progress::where('user_id', $user->id)
                ->where('level_id', $level->id)
                ->first();

            if (!$existingProgress || $existingProgress->status !== 'completed') {
                Progress::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'level_id' => $level->id
                    ],
                    ['status' => 'in-progress']
                );
            }

            $query = $level->materis();
            if ($request->has('type')) {
                $query->where('type', $request->type);
            }
            $perPage = $request->query('per_page', 10);
            $materis = $query->paginate($perPage);

            $materis->getCollection()->transform(function ($materiItem) use ($user) {
                $materiItem->is_completed = UserMateriCompletion::where('user_id', $user->id)
                    ->where('materi_id', $materiItem->id)
                    ->exists();
                return $materiItem;
            });

            return response()->json($materis, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Level tidak ditemukan'], 404);
        }
    }
}

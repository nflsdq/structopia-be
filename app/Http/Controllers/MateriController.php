<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\UserMateriCompletion;
use App\Http\Controllers\BadgeController;
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
            $materi = Materi::with('level')->findOrFail($id);
            $level = $materi->level;

            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Materi ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }

            $isCompleted = UserMateriCompletion::where('user_id', $user->id)
                ->where('materi_id', $materi->id)
                ->exists();

            $materi_response = $materi->toArray();
            $materi_response['xp_value'] = $materi->xp_value;
            $materi_response['is_completed'] = $isCompleted;

            if ($level->order < $user->current_level || $isCompleted) {
                $materi_response['status'] = 'unlocked';
                $materi_response['keterangan'] = 'Sudah dibuka';
            } elseif ($level->order == $user->current_level) {
                $materi_response['status'] = 'ongoing';
                $materi_response['keterangan'] = 'Sedang dikerjakan';
            } else {
                $materi_response['status'] = 'locked';
                $materi_response['keterangan'] = 'Belum bisa dibuka';
            }

            return response()->json($materi_response, 200);
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
                'media_url' => 'nullable|string',
                'meta' => 'nullable|array'
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
                'media_url' => 'nullable|string',
                'meta' => 'nullable|array'
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

    public function markAsCompleted($id, Request $request)
    {
        try {
            $user = $request->user();
            $materi = Materi::findOrFail($id);
            $level = $materi->level;

            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Materi ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }

            $existingCompletion = UserMateriCompletion::where('user_id', $user->id)
                ->where('materi_id', $materi->id)
                ->first();

            if (!$existingCompletion) {
                UserMateriCompletion::create([
                    'user_id' => $user->id,
                    'materi_id' => $materi->id,
                    'completed_at' => now(),
                ]);

                $user->xp += $materi->xp_value ?? 0;
                $user->save();

                // Cek dan berikan badge otomatis
                $badgeController = new BadgeController();
                $newBadges = $badgeController->checkAndAssignAutomaticBadges($user);

                return response()->json([
                    'message' => 'Materi berhasil ditandai selesai.',
                    'xp_gained' => $materi->xp_value ?? 0,
                    'new_badges' => $newBadges
                ], 200);
            }

            return response()->json(['message' => 'Materi sudah selesai sebelumnya.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server: ' . $e->getMessage()], 500);
        }
    }
}

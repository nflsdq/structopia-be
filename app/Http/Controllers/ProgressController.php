<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->query('per_page', 10);
        $progress = Progress::with('level')
            ->where('user_id', $user->id)
            ->paginate($perPage);
        return response()->json($progress, 200);
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'level_id' => 'required|exists:levels,id',
                'status' => 'required|in:completed,in-progress'
            ]);
            $user = Auth::user();
            $progress = Progress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'level_id' => $validated['level_id']
                ],
                ['status' => $validated['status']]
            );
            return response()->json($progress, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function getUnlockedLevels()
    {
        $user = Auth::user();
        $completedLevels = Progress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->pluck('level_id');
        $unlockedLevels = Level::where(function ($query) use ($completedLevels) {
            $query->whereIn('id', $completedLevels)
                ->orWhere('order', 1); // Level 1 is always unlocked
        })->orderBy('order')->get();
        return response()->json($unlockedLevels, 200);
    }
}

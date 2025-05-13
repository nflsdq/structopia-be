<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $progress = Progress::with('level')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($progress);
    }

    public function update(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'status' => 'required|in:completed,in-progress'
        ]);

        $user = Auth::user();
        $progress = Progress::updateOrCreate(
            [
                'user_id' => $user->id,
                'level_id' => $request->level_id
            ],
            ['status' => $request->status]
        );

        return response()->json($progress);
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

        return response()->json($unlockedLevels);
    }
}

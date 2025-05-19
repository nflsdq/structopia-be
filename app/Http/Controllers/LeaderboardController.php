<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $topUsers = User::where('role', 'student')
            ->orderBy('xp', 'desc')
            ->paginate($perPage);

        // Add rank to each user
        $rank = $topUsers->firstItem();
        $topUsers->getCollection()->transform(function ($user) use (&$rank) {
            $user->rank = $rank++;
            return $user;
        });

        return response()->json($topUsers, 200);
    }
}

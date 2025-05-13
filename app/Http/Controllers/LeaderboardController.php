<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topUsers = User::where('role', 'student')
            ->orderBy('xp', 'desc')
            ->take(10)
            ->get(['id', 'name', 'xp', 'current_level']);

        return response()->json($topUsers);
    }
}

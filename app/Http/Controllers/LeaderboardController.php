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
        return response()->json($topUsers, 200);
    }
}

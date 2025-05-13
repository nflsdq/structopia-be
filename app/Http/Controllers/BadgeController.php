<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return response()->json($badges);
    }

    public function getUserBadges()
    {
        $user = Auth::user();
        $badges = $user->badges;
        return response()->json($badges);
    }

    public function assignBadge(Request $request)
    {
        $request->validate([
            'badge_id' => 'required|exists:badges,id'
        ]);

        $user = Auth::user();
        $userBadge = UserBadge::create([
            'user_id' => $user->id,
            'badge_id' => $request->badge_id
        ]);

        return response()->json($userBadge, 201);
    }
}

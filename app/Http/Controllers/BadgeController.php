<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\UserBadge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BadgeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $badges = Badge::paginate($perPage);
        return response()->json($badges, 200);
    }

    public function getUserBadges(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->query('per_page', 10);
        $badges = $user->badges()->paginate($perPage);
        return response()->json($badges, 200);
    }

    public function assignBadge(Request $request)
    {
        try {
            $validated = $request->validate([
                'badge_id' => 'required|exists:badges,id'
            ]);
            $user = Auth::user();
            $userBadge = UserBadge::create([
                'user_id' => $user->id,
                'badge_id' => $validated['badge_id']
            ]);
            return response()->json($userBadge, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}

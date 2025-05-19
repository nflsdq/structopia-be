<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\User;
use App\Models\Progress;
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
            $existingUserBadge = UserBadge::where('user_id', $user->id)
                ->where('badge_id', $validated['badge_id'])
                ->first();
            if ($existingUserBadge) {
                return response()->json(['message' => 'Pengguna sudah memiliki badge ini.'], 409);
            }

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

    /**
     * Check and assign badges automatically to a user based on their XP or level.
     *
     * @param User $user
     * @return array List of newly assigned badges (nama atau objek badge)
     */
    public function checkAndAssignAutomaticBadges(User $user): array
    {
        $newlyAssignedBadgesInfo = [];
        $userXp = $user->xp ?? 0;
        $userCurrentLevelOrder = $user->current_level ?? 0;

        $currentUserBadgeIds = $user->badges()->pluck('badges.id')->toArray();
        $potentialBadges = Badge::whereNotIn('id', $currentUserBadgeIds)->get();

        foreach ($potentialBadges as $badge) {
            $canBeAssigned = false;

            // Kondisi 1: Badge berdasarkan XP murni (jika xp_required ada dan level_required null)
            if (!is_null($badge->xp_required) && is_null($badge->level_required) && $userXp >= $badge->xp_required) {
                $canBeAssigned = true;
            }

            // Kondisi 2: Badge berdasarkan PENYELESAIAN level 
            // (jika level_required ada dan xp_required null)
            if (!$canBeAssigned && !is_null($badge->level_required) && is_null($badge->xp_required)) {
                // Verifikasi apakah level yang disyaratkan telah diselesaikan oleh pengguna
                $levelOrderRequired = $badge->level_required;
                $progress = Progress::where('user_id', $user->id)
                    ->whereHas('level', function ($query) use ($levelOrderRequired) {
                        $query->where('order', $levelOrderRequired);
                    })
                    ->where('status', 'completed')
                    ->first();
                if ($progress) {
                    $canBeAssigned = true;
                }
            }

            // Kondisi 3: Badge dengan syarat XP DAN Level (keduanya tidak null)
            // Ini bisa diartikan sebagai "capai XP X DAN capai level Y" ATAU "capai XP X DAN selesaikan level Y"
            // Untuk saat ini, kita artikan sebagai "capai XP X DAN capai level Y (order)"
            // Jika Anda ingin "selesaikan level Y", maka perlu query ke tabel Progress seperti di Kondisi 2.
            if (!$canBeAssigned && !is_null($badge->xp_required) && !is_null($badge->level_required)) {
                if ($userXp >= $badge->xp_required && $userCurrentLevelOrder >= $badge->level_required) {
                    // Jika badge ini juga memerlukan *penyelesaian* level, tambahkan cek ke tabel Progress di sini
                    // Contoh: (anggap Anda mau syarat XP DAN penyelesaian level)
                    // $levelOrderRequired = $badge->level_required;
                    // $progressCompleted = Progress::where('user_id', $user->id)
                    //                              ->whereHas('level', function ($q) use ($levelOrderRequired) {
                    //                                  $q->where('order', $levelOrderRequired);
                    //                              })
                    //                              ->where('status', 'completed')
                    //                              ->exists();
                    // if ($progressCompleted) { $canBeAssigned = true; }
                    $canBeAssigned = true; // Untuk sekarang, hanya capai level & XP
                }
            }

            if ($canBeAssigned) {
                UserBadge::create([
                    'user_id' => $user->id,
                    'badge_id' => $badge->id
                ]);
                $newlyAssignedBadgesInfo[] = ['id' => $badge->id, 'name' => $badge->name, 'icon' => $badge->icon];
            }
        }

        return $newlyAssignedBadgesInfo;
    }

    public function triggerAutomaticBadgeCheck(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Pengguna tidak terautentikasi'], 401);
        }

        $assignedBadges = $this->checkAndAssignAutomaticBadges($user);

        if (count($assignedBadges) > 0) {
            return response()->json([
                'message' => 'Pemeriksaan badge otomatis selesai.',
                'new_badges_assigned' => $assignedBadges
            ], 200);
        } else {
            return response()->json(['message' => 'Tidak ada badge baru yang diberikan.'], 200);
        }
    }
}

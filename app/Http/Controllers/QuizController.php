<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizHistory;
use App\Models\Progress;
use App\Models\Level;
use App\Models\Materi;
use App\Models\UserMateriCompletion;
use App\Http\Controllers\BadgeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuizController extends Controller
{
    public function getLevelQuiz($levelId, Request $request)
    {
        try {
            $user = $request->user();
            $level = Level::findOrFail($levelId);
            if ($level->order > $user->current_level) {
                return response()->json([
                    'message' => 'Quiz level ini masih terkunci. Selesaikan level sebelumnya terlebih dahulu.'
                ], 403);
            }

            // Cek apakah user sudah pernah lulus quiz ini sebelumnya
            $existingAttempt = QuizHistory::where('user_id', $user->id)
                ->where('level_id', $levelId)
                ->where('passed', true)
                ->first();
            if ($existingAttempt) {
                return response()->json([
                    'message' => 'Anda sudah menyelesaikan dan lulus kuis ini sebelumnya. Kuis tidak dapat diakses lagi.'
                ], 403);
            }

            $materis = Materi::where('level_id', $levelId)->get();
            $materisByType = $materis->groupBy('type');
            $canAccessQuiz = false;

            if ($materis->isEmpty()) {
                $canAccessQuiz = true;
            }

            foreach ($materisByType as $type => $groupMateris) {
                if ($groupMateris->isEmpty()) {
                    continue;
                }
                $completedCountInType = 0;
                foreach ($groupMateris as $m) {
                    if (UserMateriCompletion::where('user_id', $user->id)->where('materi_id', $m->id)->exists()) {
                        $completedCountInType++;
                    }
                }

                if ($completedCountInType === $groupMateris->count()) {
                    $canAccessQuiz = true;
                    break;
                }
            }

            if (!$canAccessQuiz && !$materis->isEmpty()) {
                return response()->json([
                    'message' => 'Anda harus menyelesaikan semua materi dari salah satu tipe (visual, auditory, atau kinesthetic) di level ini sebelum mengakses quiz.'
                ], 403);
            }

            $quizzes = Quiz::where('level_id', $levelId)->get();
            return response()->json($quizzes, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function submit(Request $request)
    {
        try {
            $validated = $request->validate([
                'level_id' => 'required|exists:levels,id',
                'answers' => 'required|array'
            ]);
            $user = Auth::user();
            $quizzes = Quiz::where('level_id', $validated['level_id'])->get();
            $score = 0;
            foreach ($quizzes as $quiz) {
                if (
                    isset($validated['answers'][$quiz->id]) &&
                    $validated['answers'][$quiz->id] === $quiz->correct_answer
                ) {
                    $score++;
                }
            }
            $totalQuestions = $quizzes->count();
            $passed = $totalQuestions > 0 ? ($score / $totalQuestions) >= 0.7 : false;
            $quizHistory = QuizHistory::create([
                'user_id' => $user->id,
                'level_id' => $validated['level_id'],
                'score' => $score,
                'passed' => $passed
            ]);
            if ($passed) {
                $user->xp += $score * 25;
                // Jangan simpan user dulu, kita cek level berikutnya

                Progress::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'level_id' => $validated['level_id']
                    ],
                    ['status' => 'completed']
                );

                // Logika untuk membuka level berikutnya
                $currentLevelId = $validated['level_id'];
                $currentLevel = Level::find($currentLevelId);

                if ($currentLevel) {
                    $nextLevel = Level::where('order', '>', $currentLevel->order)
                        ->orderBy('order', 'asc')
                        ->first();

                    if ($nextLevel && $user->current_level == $currentLevel->order) {
                        // Hanya update current_level jika user berada di level yang baru saja diselesaikan
                        // dan ada level berikutnya
                        $user->current_level = $nextLevel->order;
                    }
                }
                $user->save(); // Simpan user setelah semua perubahan XP dan current_level

                // Cek dan berikan badge otomatis setelah semua pembaruan user
                $badgeController = new BadgeController();
                $newBadges = $badgeController->checkAndAssignAutomaticBadges($user);
            }
            return response()->json([
                'score' => $score,
                'total_questions' => $totalQuestions,
                'passed' => $passed,
                'xp_gained' => $passed ? $score * 25 : 0,
                'new_badges' => ($passed && isset($newBadges)) ? $newBadges : [] // Kirim jika passed
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function history(Request $request)
    {
        try {
            $user = Auth::user();
            $perPage = $request->query('per_page', 10);
            $history = QuizHistory::with('level')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
            return response()->json($history, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}

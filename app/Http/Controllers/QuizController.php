<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizHistory;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuizController extends Controller
{
    public function getLevelQuiz($levelId)
    {
        try {
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
                $user->xp += 100;
                $user->save();
                Progress::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'level_id' => $validated['level_id']
                    ],
                    ['status' => 'completed']
                );
            }
            return response()->json([
                'score' => $score,
                'total_questions' => $totalQuestions,
                'passed' => $passed,
                'xp_gained' => $passed ? 100 : 0
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
            $history = \App\Models\QuizHistory::with('level')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
            return response()->json($history, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizHistory;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function getLevelQuiz($levelId)
    {
        $quizzes = Quiz::where('level_id', $levelId)->get();
        return response()->json($quizzes);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'level_id' => 'required|exists:levels,id',
            'answers' => 'required|array'
        ]);

        $user = Auth::user();
        $quizzes = Quiz::where('level_id', $request->level_id)->get();

        $score = 0;
        foreach ($quizzes as $quiz) {
            if (
                isset($request->answers[$quiz->id]) &&
                $request->answers[$quiz->id] === $quiz->correct_answer
            ) {
                $score++;
            }
        }

        $totalQuestions = $quizzes->count();
        $passed = ($score / $totalQuestions) >= 0.7; // 70% minimum score to pass

        $quizHistory = QuizHistory::create([
            'user_id' => $user->id,
            'level_id' => $request->level_id,
            'score' => $score,
            'passed' => $passed
        ]);

        if ($passed) {
            $user->xp += 100; // Add XP for passing
            $user->save();

            // Update progress
            Progress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'level_id' => $request->level_id
                ],
                ['status' => 'completed']
            );
        }

        return response()->json([
            'score' => $score,
            'total_questions' => $totalQuestions,
            'passed' => $passed,
            'xp_gained' => $passed ? 100 : 0
        ]);
    }

    public function history()
    {
        $user = Auth::user();
        $history = QuizHistory::with('level')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($history);
    }
}

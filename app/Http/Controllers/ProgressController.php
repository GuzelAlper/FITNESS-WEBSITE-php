<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        return Progress::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'workout_id' => 'required|exists:workouts,id',
        'date' => 'required|date',
        'completed' => 'required|boolean',
    ]);

    $progress = Progress::create([
        'user_id' => $request->user()->id,
        'workout_id' => $validated['workout_id'],
        'date' => $validated['date'],
        'completed' => $validated['completed'],
    ]);

    return response()->json($progress, 201);
}
    public function show(Progress $progress)
    {
        return $progress;
    }

    public function destroy(Progress $progress)
    {
        $progress->delete();
        return response()->json(['message' => 'Silindi.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    // Listeleme
    public function index()
    {
        return Workout::all();
    }

    // Oluşturma
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer',
            'sets' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'author_id' => 'nullable|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        return Workout::create($validated);
    }

    // Tek gösterim
    public function show(Workout $workout)
    {
        return $workout;
    }

    // Güncelleme
    public function update(Request $request, Workout $workout)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer',
            'sets' => 'nullable|integer',
            'reps' => 'nullable|integer',
            'author_id' => 'nullable|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $workout->update($validated);

        return $workout;
    }

    // Silme
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return response()->json(['message' => 'Silindi.']);
    }

    // 🔥 HAREKET ADI SEÇİMİ İÇİN EKSTRA: ID + TITLE
public function list()
{
    return Workout::selectRaw('MIN(id) as id, title')
        ->groupBy('title')
        ->get();
}


}




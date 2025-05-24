<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    // ✅ KULLANICIYA ÖZEL PLANLARI GETİR
    public function index(Request $request)
    {
        return Plan::where('user_id', $request->user()->id)->get();
    }

    // ✅ PLAN OLUŞTUR (Kullanıcıyı doğrudan oturumdan al)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $plan = Plan::create([
            'title' => $validated['title'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'user_id' => $request->user()->id, // ✳️ Oturumdaki kullanıcı
        ]);

        return response()->json($plan, 201);
    }

    // ✅ PLAN SİL (Sadece kendi planını silebilsin)
    public function destroy($id, Request $request)
    {
        $plan = Plan::where('id', $id)
                    ->where('user_id', $request->user()->id)
                    ->first();

        if (!$plan) {
            return response()->json(['message' => 'Plan bulunamadı veya yetkisiz.'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Plan silindi.']);
    }
}
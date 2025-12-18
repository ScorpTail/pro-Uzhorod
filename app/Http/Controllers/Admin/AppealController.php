<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Appeal\Appeal;
use App\Http\Controllers\Controller;

class AppealController extends Controller
{
    public function index(Request $request)
    {
        $appeals = Appeal::get();

        return response()->json($appeals);
    }

    public function edit(Request $request, $id)
    {
        $appeal = Appeal::find($id);

        if (!$appeal) {
            return response()->json(['message' => __('admin.appeal_not_found')], 404);
        }

        return response()->json($appeal);
    }

    public function update(Request $request, $id)
    {
        $appeal = Appeal::find($id);

        if (!$appeal) {
            return response()->json(['message' => __('admin.appeal_not_found')], 404);
        }

        $validatedData = $request->validate([
            'status',
        ]);

        $validatedData['administrator_id'] = auth()->id();

        $appeal->update($validatedData);

        return response()->json(['message' => __('admin.appeal_updated_successfully'), 'appeal' => $appeal]);
    }

    public function destroy(Request $request, $id)
    {
        $appeal = Appeal::find($id);

        if (!$appeal) {
            return response()->json(['message' => __('admin.appeal_not_found')], 404);
        }

        $appeal->delete();

        return response()->json(['message' => __('admin.appeal_deleted_successfully')]);
    }
}

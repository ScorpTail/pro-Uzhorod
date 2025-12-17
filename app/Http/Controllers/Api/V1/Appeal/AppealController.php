<?php

namespace App\Http\Controllers\Api\V1\Appeal;

use Illuminate\Http\Request;
use App\Models\Appeal\Appeal;
use App\Http\Controllers\Controller;
use App\Enums\Appeal\AppealStatusEnum;

class AppealController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'user_id' => ['required'],
        ]);

        $appealData = $request->all();

        $appeal = Appeal::create([
            'title'            => $appealData['title'],
            'content'          => $appealData['content'],
            'status'           => AppealStatusEnum::NEW->value,
            'user_id'          => $appealData['user_id']
        ]);

        return response()->json(['message' => __('front.appeal_created_successfully'), 'appeal' => $appeal], 201);
    }
}

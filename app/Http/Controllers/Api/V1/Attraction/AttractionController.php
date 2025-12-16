<?php

namespace App\Http\Controllers\Api\V1\Attraction;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attraction\Attraction;

class AttractionController extends Controller
{
    public function index(Request $request)
    {
        $attractions = Attraction::where('status', StatusEnum::ACTIVE->value)->get();

        return response()->json([
            'attractions' => $attractions,
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $attraction = Attraction::where('id', $id)->where('status', StatusEnum::ACTIVE->value)->first();

        if (!$attraction) {
            return response()->json(['message' => __('front.attraction_not_found')], 404);
        }

        return response()->json([
            'attraction' => $attraction,
        ], 200);
    }
}

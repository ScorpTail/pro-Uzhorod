<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attraction\Attraction;

class AttractionController extends Controller
{
    public function index(Request $request)
    {
        $attractions = Attraction::get();

        return response()->json($attractions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => ['required', 'string', 'max:255'],
            'description'        => ['required', 'string'],
            'short_description'  => ['nullable', 'string', 'max:500'],
            'status'             => ['required', 'in:' . StatusEnum::getColumnLikeString('value')],
            'location'           => ['nullable', 'string', 'max:255'],
            'entry_fee'          => ['nullable', 'numeric'],
            'working_days'       => ['nullable', 'string', 'max:100'],
            'start_time'         => ['nullable', 'string', 'max:10'],
            'end_time'           => ['nullable', 'string', 'max:10'],
            'weekend_start_time' => ['nullable', 'string', 'max:10'],
            'weekend_end_time'   => ['nullable', 'string', 'max:10']
        ]);

        $attractionData = $request->all();

        $attraction = Attraction::create([
            'name'               => $attractionData['name'],
            'description'        => $attractionData['description'],
            'short_description'  => $attractionData['short_description'] ?? null,
            'status'             => $attractionData['status'],
            'location'           => $attractionData['location'] ?? null,
            'entry_fee'          => $attractionData['entry_fee'] ?? null,
            'working_days'       => $attractionData['working_days'] ?? null,
            'start_time'         => $attractionData['start_time'] ?? null,
            'end_time'           => $attractionData['end_time'] ?? null,
            'weekend_start_time' => $attractionData['weekend_start_time'] ?? null,
            'weekend_end_time'   => $attractionData['weekend_end_time'] ?? null
        ]);

        return response()->json(['message' => __('admin.attraction_created_successfully'), 'attraction' => $attraction], 201);
    }

    public function edit(Request $request, $id)
    {
        $attraction = Attraction::find($id);

        if (!$attraction) {
            return response()->json(['message' => __('admin.attraction_not_found')], 404);
        }

        return response()->json($attraction);
    }

    public function update(Request $request, $id)
    {
        $attraction = Attraction::find($id);

        if (!$attraction) {
            return response()->json(['message' => __('admin.attraction_not_found')], 404);
        }

        $validatedData = $request->validate([
            'name'               => ['sometimes', 'string', 'max:255'],
            'description'        => ['sometimes', 'string'],
            'short_description'  => ['sometimes', 'string', 'max:500'],
            'status'             => ['sometimes', 'in:' . StatusEnum::getColumnLikeString('value')],
            'location'           => ['sometimes', 'string', 'max:255'],
            'entry_fee'          => ['sometimes', 'numeric'],
            'working_days'       => ['sometimes', 'string', 'max:100'],
            'start_time'         => ['sometimes', 'string', 'max:10'],
            'end_time'           => ['sometimes', 'string', 'max:10'],
            'weekend_start_time' => ['sometimes', 'string', 'max:10'],
            'weekend_end_time'   => ['sometimes', 'string', 'max:10']
        ]);

        $attraction->update($validatedData);

        return response()->json(['message' => __('admin.attraction_updated_successfully'), 'attraction' => $attraction]);
    }

    public function destroy(Request $request, $id)
    {
        $attraction = Attraction::find($id);

        if (!$attraction) {
            return response()->json(['message' => __('admin.attraction_not_found')], 404);
        }

        $attraction->delete();

        return response()->json(['message' => __('admin.attraction_deleted_successfully')]);
    }
}

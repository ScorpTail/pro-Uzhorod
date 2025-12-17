<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::get();

        return response()->json($services);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => ['required', 'string', 'max:255'],
            'description'        => ['required', 'string'],
            'short_description'  => ['nullable', 'string', 'max:500'],
            'status'             => ['required', 'in:' . StatusEnum::getColumnLikeString('value')],
            'working_days'       => ['required', 'string', 'max:100'],
            'start_work'         => ['required', 'string', 'max:10'],
            'end_work'           => ['required', 'string', 'max:10'],
            'weekend_start_work' => ['nullable', 'string', 'max:10'],
            'weekend_end_work'   => ['nullable', 'string', 'max:10'],
            'location'           => ['nullable', 'string', 'max:255'],
            'phone'              => ['nullable', 'string', 'max:20'],
        ]);

        $serviceData = $request->all();

        $service = Service::create($serviceData);

        return response()->json(['message' => __('admin.service_created_successfully'), 'service' => $service], 201);
    }

    public function edit(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => __('admin.service_not_found')], 404);
        }

        return response()->json($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => __('admin.service_not_found')], 404);
        }

        $request->validate([
            'name'               => ['required', 'string', 'max:255'],
            'description'        => ['required', 'string'],
            'short_description'  => ['nullable', 'string', 'max:500'],
            'status'             => ['required', 'in:' . StatusEnum::getColumnLikeString('value')],
            'working_days'       => ['required', 'string', 'max:100'],
            'start_work'         => ['required', 'string', 'max:10'],
            'end_work'           => ['required', 'string', 'max:10'],
            'weekend_start_work' => ['nullable', 'string', 'max:10'],
            'weekend_end_work'   => ['nullable', 'string', 'max:10'],
            'location'           => ['nullable', 'string', 'max:255'],
            'phone'              => ['nullable', 'string', 'max:20'],
        ]);

        $serviceData = $request->all();

        $service->update($serviceData);

        return response()->json(['message' => __('admin.service_updated_successfully'), 'service' => $service]);
    }

    public function destroy(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => __('admin.service_not_found')], 404);
        }

        $service->delete();

        return response()->json(['message' => __('admin.service_deleted_successfully')]);
    }
}

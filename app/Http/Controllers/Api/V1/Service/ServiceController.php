<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;
use App\Services\BitMask\DayBitMask;

class ServiceController extends Controller
{
    public function __construct(
        protected DayBitMask $dayBitMask,
    ) {}

    public function index(Request $request)
    {
        $services = Service::where('status', StatusEnum::ACTIVE->value)->get();

        foreach ($services as $service) {
            foreach ($service->images as $file) {
                $service->setAttribute($file->image_type, $file->front_url);
            }

            $service->working_days = $this->dayBitMask->maskToDays($service->working_days);
        }

        return response()->json([
            'services' => $services,
        ]);
    }

    public function show(Request $request, $id)
    {
        $service = Service::where('id', $id)
            ->where('status', StatusEnum::ACTIVE->value)
            ->first();

        if (!$service) {
            return response()->json([
                'message' => __('front.service.not_found'),
            ], 404);
        }

        foreach ($service->images as $item) {
            $service->setAttribute($item->image_type, $item->front_url);

            $service->working_days = $this->dayBitMask->maskToDays($service->working_days);
        }

        return response()->json([
            'service' => $service,
        ]);
    }
}

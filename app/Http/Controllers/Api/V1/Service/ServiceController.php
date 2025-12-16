<?php

namespace App\Http\Controllers\Api\V1\Service;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('status', StatusEnum::ACTIVE->value)->get();

        return response()->json([
            'services' => $services,
        ]);
    }

    public function show(Request $request, $id)
    {
        $service = Service::where('id', $id)
            ->where('status', StatusEnum::ACTIVE->value)
            ->firstOrFail();

        return response()->json([
            'service' => $service,
        ]);
    }
}

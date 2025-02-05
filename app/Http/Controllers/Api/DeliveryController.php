<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function show($id)
    {
        $delivery = Delivery::query()->select([
            'id',
            'order_id',
            'status',
            'lat',
            'lng',
        ])
            ->where('id', $id)
            ->firstOrFail();

        return $delivery;
    }

    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'lng' => ['required', 'numeric'],
            'lat' => ['required', 'numeric'],
        ]);

        $delivery->forceFill([
           'lng' => $request->lng,
           'lat' => $request->lat
        ]);

//        event(new DeliveryLocationUpdated($delivery, $request->lat, $request->lng));

        return $delivery;
    }
}

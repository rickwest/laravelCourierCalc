<?php

namespace App\Http\Controllers;

use App\Fee;
use App\FeeScale;
use App\Helpers\ChoiceHelper;
use App\Mail\Quote;
use App\Services\GoogleDirectionsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function __construct() {
//        $this->middleware('auth');
    }

    public function create() {
        return view('quote.create', [
            'vehicleTypes' => ChoiceHelper::getVehicleTypeChoices(),
            'feeScales' => FeeScale::all()
        ]);
    }

    public function store(Request $request, GoogleDirectionsApi $googleDirectionsApi) {
        $this->validate($request, [
            'start' => 'required',
            'destination' => 'required',
            'feeScaleId' => 'required',
            'vehicleTypeId' => 'required'
        ]);

        $start = $request['start'];
        $destination = $request['destination'];
        $feeScaleId = $request['feeScaleId'];
        $vehicleTypeId = $request['vehicleTypeId'];

        list($route, $polyline) = $googleDirectionsApi->getRouteDetails($start, $destination);

        $miles = $googleDirectionsApi->convertMetersToMiles($route['distance']['value']);

        $fees = Fee::where('fee_scale_id', $feeScaleId)->where('vehicle_type_id', $vehicleTypeId)->get();

        if (!$fees) {
            //add flash message and redirect to show page;
        }

        $total = [
            'price' => 0,
            'driverCost' => 0
        ];
        foreach ($fees as $fee) {
            //for now we are only handling per mile fee scales
            switch ($fee['fee_type_id']) {
                case Fee::FEE_TYPE_PER_MILE:
                    $total['price'] += ($fee['price'] * $miles);
                    $total['driverCost'] += ($fee['cost'] * $miles);
                    break;
            }
        }

        if ($total['price'] !== 0) {
            $total['price'] = number_format($total['price'], 2);
            $total['margin'] = number_format(($total['price'] - $total['driverCost']) / $total['price'], 2);
            $total['marginPercent'] = number_format($total['margin'] * 100, 2);
        }

        Mail::to('test@test.com')->send(new Quote($total));

        return view('quote.result', [
            'start' => $start,
            'destination' => $destination,
            'total' => $total,
            'route' => $route,
            'distance' => $miles
        ]);
    }

    public function show() {
        return view('quote.show');
    }

    public function email(Request $request) {
        $emailAddress = 'test@test.com';
        $total = 10;
        Mail::to($emailAddress)->send(new Quote($total));
        return response()->json(['success' => 'email sent successfully']);
    }
}

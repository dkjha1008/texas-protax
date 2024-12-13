<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Inertia\Inertia;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DetailsController extends Controller
{

    public function getSuggestions(Request $request)
    {
        $query = $request->input('query');

        // Split the query into parts
        $searchTerms = explode(' ', $query);

        if (!$query) {
            return response()->json(['suggestions' => []]);
        }

        // Fetch matching addresses from the database
        $suggestions = Parcel::select(
            DB::raw("CONCAT(parcel_address, ', ', parcel_city, ' ', parcel_state, ' ', parcel_zip) AS formatted_address"),
            'parcel'
        )
            ->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->orWhere('street_number', 'LIKE', "%{$term}%")
                        ->orWhere('street_name', 'LIKE', "%{$term}%")
                        ->orWhere('street_prefix', 'LIKE', "%{$term}%")
                        ->orWhere('street_suffix', 'LIKE', "%{$term}%")
                        ->orWhere('parcel_city', 'LIKE', "%{$term}%")
                        ->orWhere('parcel_state', 'LIKE', "%{$term}%")
                        ->orWhere('parcel_zip', 'LIKE', "%{$term}%")
                        ->orWhere('parcel_address', 'LIKE', "%{$term}%");
                }
            })
            ->limit(10)
            ->pluck('formatted_address', 'parcel');

        return response()->json(['suggestions' => $suggestions]);
    }

    public function encryptData(Request $request)
    {
        try {

            $address = Crypt::encryptString($request->address);
            $parcel = Crypt::encryptString($request->parcel);

            return response()->json([
                'success' => true,
                'message' => 'Address processed successfully.',
                'data' => [
                    'address' => $address,
                    'parcel' => $parcel,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process the address.',
            ], 422);
        }
    }


    public function index(Request $request)
    {
        $decryptedAddress = Crypt::decryptString($request->address);
        $decryptedParcel = Crypt::decryptString($request->parcel);

        $fetchData = Parcel::where('parcel', $decryptedParcel)->first();

        $getSatelliteImage = $this->getSatelliteImage($decryptedAddress);

        // Assuming you have some business logic for calculating these values
        $averageReductionPercent = $fetchData->average_reduction_percent;
        $finalValue = $fetchData->final_value;
        $taxRate = $fetchData->tax_rate;

        // Return the data using Inertia to pass it to the frontend
        return Inertia::render('Description', [
            'satelliteImageUrl' => $getSatelliteImage,
            'averageReductionPercent' => $averageReductionPercent,
            'finalValue' => $finalValue,
            'taxRate' => number_format($taxRate, 1),
            'address' => $decryptedAddress,
        ]);
    }

    // public function getStreetViewImage($address)
    // {
    //     $apiKey = config('services.google.key');

    //     $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json";
    //     $geocodeParams = [
    //         'address' => $address,
    //         'key' => $apiKey,
    //     ];

    //     try {
    //         $response = file_get_contents($geocodeUrl . '?' . http_build_query($geocodeParams));
    //         $data = json_decode($response, true);


    //         if ($data['status'] == 'OK') {
    //             $lat = $data['results'][0]['geometry']['location']['lat'];
    //             $lng = $data['results'][0]['geometry']['location']['lng'];

    //             $streetViewUrl = "https://maps.googleapis.com/maps/api/streetview";
    //             $params = [
    //                 'size' => '600x400',
    //                 'location' => "{$lat},{$lng}",
    //                 'key' => $apiKey,
    //             ];

    //             $streetViewImageUrl = $streetViewUrl . '?' . http_build_query($params);

    //             return $streetViewImageUrl;
    //         } else {
    //             return response()->json(['error' => 'Address not found or invalid.'], 400);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }


    public function getSatelliteImage($address)
    {
        $apiKey = config('services.google.key');

        $url = "https://maps.googleapis.com/maps/api/staticmap";
        $params = [
            'center' => $address,
            'zoom' => 20,
            'size' => '600x400',
            'maptype' => 'satellite',
            'key' => $apiKey,
        ];

        try {

            $satelliteImageUrl =   $url . '?' . http_build_query($params);
            return $satelliteImageUrl;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
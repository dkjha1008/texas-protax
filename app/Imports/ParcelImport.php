<?php

// app/Imports/ParcelImport.php
namespace App\Imports;

use App\Models\Parcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ParcelImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new Parcel([
            'parcel' => $row['parcel'],
            'notice_value' => $row['noticevalue'],
            'final_value' => $row['finalvalue'],
            'neighborhood' => $row['neighborhood'],
            'average_reduction_percent' => $row['averagereductionpercent'],
            'parcel_address' => $row['parceladdress'],
            'county_id' => $row['countyid'],
            'potential_reduction' => $row['potentialreduction'],
            'potential_savings' => $row['potentialsavings'],
            'hash_code' => $this->generateUniqueHashCode(),
            'calculation' => $row['calculation'],
            'tax_rate' => rtrim($row['taxrate'], '%'),
            'parcel_city' => $row['parcelcity'],
            'parcel_state' => $row['parcelstate'],
            'parcel_zip' => $row['parcelzip'],
            'street_number' => $row['streetnumber'],
            'street_name' => $row['streetname'],
            'street_prefix' => $row['streetprefix'],
            'street_suffix' => $row['streetsuffix'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function generateUniqueHashCode()
    {
        $randomString = strtoupper(Str::random(10));

        $dateTime = now()->format('YmdHis');

        $hash = 'HC-' . $randomString . '-' . $dateTime;

        while (Parcel::where('hash_code', $hash)->exists()) {
            $randomString = strtoupper(Str::random(10));
            $hash = 'HC-' . $randomString . '-' . $dateTime;
        }

        return $hash;
    }
}
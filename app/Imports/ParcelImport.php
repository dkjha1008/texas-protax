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
            'marketing_neighborhood_parcel_id' => $row['marketingneighborhoodparcelid'],
            'parcel_number' => $row['parcelnumber'],
            'county_id' => $row['countyid'],
            'notice_value' => $row['noticevalue'],
            'final_value' => $row['finalvalue'],
            'neighborhood' => $row['neighborhood'],
            'average_reduction_percent' => $row['averagereductionpercent'],
            'parcel_address' => $row['parceladdress'],
            'potential_reduction' => $row['potentialreduction'],
            'potential_savings' => $row['potentialsavings'],
            'hash_code' => $row['hashcode'],
            'calculation_value' => $row['calculationvalue'],
            'tax_rate' => rtrim($row['taxrate'], '%'),
            'parcel_city' => $row['parcelcity'],
            'parcel_state' => $row['parcelstate'],
            'parcel_zip' => $row['parcelzip'],
            'street_number' => $row['streetnumber'],
            'street_name' => $row['streetname'],
            'street_prefix' => $row['streetprefix'] ?? null,
            'street_suffix' => $row['streetsuffix'] ?? null,
            'created_by' => $row['createdby'],
            'created_date' => $row['createddate'],
            'updated_by' => $row['updatedby'] ?? null,
            'updated_date' => $row['updateddate'] ?? null,
            'rowversion_time' => $row['rowversiontime'] ?? null,
        ]);
    }


    public function chunkSize(): int
    {
        return 1000;
    }
}

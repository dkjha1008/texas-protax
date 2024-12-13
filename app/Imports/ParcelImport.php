<?php

// app/Imports/ParcelImport.php
namespace App\Imports;

use App\Models\Parcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParcelImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        dd($row);
        return new Parcel([
            'Parcel' => $row['Parcel'],
            'NoticeValue' => $row['NoticeValue'],
            'FinalValue' => $row['FinalValue'],
            'Neighborhood' => $row['Neighborhood'],
            'AverageReductionPercent' => $row['AverageReductionPercent'],
            'ParcelAddress' => $row['ParcelAddress'],
            'CountyId' => $row['CountyId'],
            'PotentialReduction' => $row['PotentialReduction'],
            'PotentialSavings' => $row['PotentialSavings'],
            'HashCode' => $row['HashCode'],
            'Calculation' => $row['Calculation'],
            'TaxRate' => $row['TaxRate'],
            'ParcelCity' => $row['ParcelCity'],
            'ParcelState' => $row['ParcelState'],
            'ParcelZip' => $row['ParcelZip'],
            'StreetNumber' => $row['StreetNumber'],
            'StreetName' => $row['StreetName'],
            'StreetPrefix' => $row['StreetPrefix'],
            'StreetSuffix' => $row['StreetSuffix'],
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
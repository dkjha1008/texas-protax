<?php

// app/Console/Commands/ImportParcelData.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParcelImport;

class ImportParcelData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parcel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import parcel data from an Excel file into the database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $filePath = public_path('sample-file/sample-data.csv');

        if (!file_exists($filePath)) {
            $this->error("File not found at {$filePath}");
            return;
        }

        try {
            // Import the data using the ParcelImport class
            Excel::import(new ParcelImport, $filePath);

            $this->info("Parcel data imported successfully from {$filePath}");
        } catch (\Exception $e) {
            $this->error("Error importing file: " . $e->getMessage());
        }
    }
}
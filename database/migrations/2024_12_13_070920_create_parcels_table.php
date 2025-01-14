<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marketing_neighborhood_parcel_id');
            $table->string('parcel_number');
            $table->unsignedBigInteger('county_id');
            $table->decimal('notice_value', 15, 2);
            $table->decimal('final_value', 15, 2);
            $table->string('neighborhood');
            $table->decimal('average_reduction_percent', 5, 2);
            $table->text('parcel_address');
            $table->decimal('potential_reduction', 15, 2);
            $table->decimal('potential_savings', 15, 2);
            $table->string('hash_code')->unique();
            $table->string('calculation_value');
            $table->decimal('tax_rate', 5, 4);
            $table->string('parcel_city');
            $table->string('parcel_state');
            $table->string('parcel_zip');
            $table->string('street_number');
            $table->string('street_name');
            $table->string('street_prefix')->nullable();
            $table->string('street_suffix')->nullable();
            $table->string('created_by');
            $table->string('created_date')->useCurrent();
            $table->string('updated_by')->nullable();
            $table->string('updated_date')->nullable();
            $table->string('rowversion_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcels');
    }
};

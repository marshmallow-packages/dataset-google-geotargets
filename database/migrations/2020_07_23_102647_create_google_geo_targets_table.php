<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleGeoTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_geo_targets', function (Blueprint $table) {
            $table->id();
            $table->string('google_name');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('google_canonical_name');
            $table->string('canonical_name');
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('google_geo_target_type_id');
            $table->string('status_string');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('google_geo_target_type_id')->references('id')->on('google_geo_target_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_geo_targets');
    }
}

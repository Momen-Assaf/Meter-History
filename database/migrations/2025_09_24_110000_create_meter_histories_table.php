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
        Schema::create('meter_histories', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('community')->nullable();
            $table->string('english_name')->nullable();
            $table->string('comet_id_household_public')->nullable();
            $table->date('changed_date')->nullable();
            $table->bigInteger('meter_number')->nullable();
            $table->string('household_status')->nullable();
            $table->string('old_community_for_new_holder')->nullable();
            $table->string('new_community_for_new_holder')->nullable();
            $table->string('new_holder_name')->nullable();
            $table->string('comet_id_for_new_holder')->nullable();
            $table->string('old_household_for_new_holder')->nullable();
            $table->string('new_household_for_new_holder')->nullable();
            $table->bigInteger('old_meter_number_for_new_holder')->nullable();
            $table->bigInteger('new_meter_number_for_new_holder')->nullable();
            $table->string('status_for_new_holder')->nullable();
            $table->string('new_community_name')->nullable();
            $table->bigInteger('old_meter_number')->nullable();
            $table->bigInteger('new_meter_number')->nullable();
            $table->string('main_holder')->nullable();
            $table->string('comet_id_for_main_holder')->nullable();
            $table->bigInteger('meter_number_2')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['community']);
            $table->index(['meter_number']);
            $table->index(['changed_date']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_histories');
    }
};



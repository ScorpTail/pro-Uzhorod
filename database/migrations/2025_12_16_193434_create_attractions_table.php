<?php

use App\Enums\StatusEnum;
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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->char('status', 1)->default(StatusEnum::ACTIVE->value);
            $table->string('location')->nullable();
            $table->decimal('entry_fee', 8, 2)->nullable();
            $table->unsignedInteger('working_days')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->time('weekend_start_time')->nullable();
            $table->time('weekend_end_time')->nullable();
            $table->decimal('rating', 3, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};

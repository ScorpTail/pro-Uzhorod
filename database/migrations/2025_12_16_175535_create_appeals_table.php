<?php

use App\Enums\Appeal\AppealStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->char('status', 1)->default(AppealStatusEnum::NEW->value);
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->unsignedBigInteger('administrator_id')->index()->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appeals');
    }
};

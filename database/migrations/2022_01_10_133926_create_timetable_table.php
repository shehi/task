<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableTable extends Migration
{
    public function up(): void
    {
        Schema::create('timetable', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timetable');
    }
}

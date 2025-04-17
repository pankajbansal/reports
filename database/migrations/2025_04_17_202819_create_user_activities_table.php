<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->bigIncrements('user_activity_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('activity_name');
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->string('ip_address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
};


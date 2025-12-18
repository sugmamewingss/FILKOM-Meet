<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamp('invited_at')->useCurrent();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            
            // Ensure one invitation per user per event
            $table->unique(['event_id', 'user_id']);
            
            // Indexes
            $table->index(['user_id', 'status']);
            $table->index('event_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
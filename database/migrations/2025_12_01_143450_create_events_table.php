<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('judul_event');
            $table->text('deskripsi_event')->nullable();
            $table->string('jenis_event');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->integer('durasi')->nullable()->comment('dalam menit');
            $table->decimal('sks', 3, 1)->nullable();
            $table->string('lokasi');
            $table->enum('mode_event', ['offline', 'online', 'hybrid'])->default('offline');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->enum('visibility', ['private', 'invited_only', 'public'])->default('invited_only');
            $table->string('meeting_link')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index('created_by');
            $table->index('tanggal_mulai');
            $table->index('tanggal_selesai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
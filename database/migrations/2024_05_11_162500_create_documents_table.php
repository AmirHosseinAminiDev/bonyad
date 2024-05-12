<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('major')->nullable();
            $table->string('education_level')->nullable();
            $table->string('job_status')->nullable();
            $table->string('job')->nullable();
            $table->string('job_type')->nullable();
            $table->string('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('war_document')->nullable();
            $table->string('active_basij')->nullable();
            $table->string('marriage_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

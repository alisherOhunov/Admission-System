<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('application_period_id')->nullable()->constrained()->onDelete('cascade');

            // Personal Information
            $table->enum('level', ['undergraduate', 'graduate'])->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('native_language')->nullable();

            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->json('permanent_address')->nullable();
            $table->json('current_address')->nullable();

            // Academic Information
            $table->string('previous_institution')->nullable();
            $table->string('previous_gpa')->nullable();
            $table->string('degree_earned')->nullable();
            $table->date('graduation_date')->nullable();

            // English Proficiency
            $table->enum('english_test_type', ['IELTS', 'TOEFL', 'Duolingo', 'Other'])->nullable();
            $table->string('english_test_score')->nullable();
            $table->date('english_test_date')->nullable();

            // Program Choice
            $table->string('start_term')->nullable();
            $table->boolean('funding_interest')->default(false);
            $table->text('statement_of_purpose')->nullable();

            // Application Status
            $table->enum('status', ['draft', 'submitted', 'review', 'accepted', 'rejected'])->default('draft');
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};

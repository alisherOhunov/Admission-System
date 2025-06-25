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
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('application_period_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->enum('level', ['undergraduate', 'graduate']);
            $table->string('nationality');
            $table->string('passport_number');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('native_language');
            
            // Contact Information
            $table->string('email');
            $table->string('phone');
            $table->json('permanent_address');
            $table->json('current_address')->nullable();
            
            // Academic Information
            $table->string('previous_institution');
            $table->string('previous_gpa');
            $table->string('degree_earned');
            $table->date('graduation_date')->nullable();
            
            // English Proficiency
            $table->enum('english_test_type', ['IELTS', 'TOEFL', 'Duolingo', 'Other'])->nullable();
            $table->string('english_test_score')->nullable();
            $table->date('english_test_date')->nullable();
            
            // Program Choice
            $table->string('start_term');
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

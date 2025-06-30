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
            $table->foreignId('program_id')->nullable()->constrained();
            $table->foreignId('application_period_id')->nullable()->constrained();
            $table->foreignId('permanent_address_id')->nullable()->constrained('addresses');
            $table->foreignId('current_address_id')->nullable()->constrained('addresses');
            $table->string('level', 64)->nullable();
            $table->string('nationality', 128)->nullable();
            $table->string('passport_number', 64)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('native_language', 64)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('previous_institution', 255)->nullable();
            $table->string('previous_gpa', 64)->nullable();
            $table->string('degree_earned', 64)->nullable();
            $table->date('graduation_date')->nullable();
            $table->string('english_test_type', 64)->nullable();
            $table->string('english_test_score', 64)->nullable();
            $table->date('english_test_date')->nullable();
            $table->string('start_term', 255)->nullable();
            $table->boolean('funding_interest')->default(false);
            $table->text('statement_of_purpose')->nullable();
            $table->string('status', 64)->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
